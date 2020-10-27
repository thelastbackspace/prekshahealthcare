<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Cart;
use App\Discount;
use App\Beneficiary;

class BookingsController extends Controller
{
    public function test_index(){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=/TESTS/products');
        $test_response = json_decode($request->getBody(),true)['MASTERS']['TESTS'];
        //Compare all items with Cart
        $cart = array();
        $cart_guest = array();

        if (auth()->user()!=null)
        {
            foreach(Cart::where('user_id',auth()->user()->id)->get() as $cart_item){
                array_push($cart,$cart_item["product_id"]);
            }
        }
        else {
            foreach(Cart::where('user_id')->get() as $cart_item){
                array_push($cart,$cart_item["product_id"]);
            }
        }  
        
        // If present,show remove from cart
        return view('book_tests')->with(['tests'=>$test_response,'cart'=>$cart]);
    }

    public function profile_index(){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=/PROFILE/products');
        $profile_response = json_decode($request->getBody(),true)['MASTERS']['PROFILE'];
        $cart = array();

        foreach(Cart::where('user_id',auth()->user()->id)->get() as $cart_item){
            array_push($cart,$cart_item["product_id"]);
        }
        // If present,show remove from cart
        return view('book_profiles')->with(['profiles'=>$profile_response,'cart'=>$cart]);
    }
    public function offer_index(){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=/OFFER/products');
        $offer_response = json_decode($request->getBody(),true)['MASTERS']['OFFER'];

        //Compare all items with Cart
        $cart = array();

        foreach(Cart::where('user_id',auth()->user()->id)->get() as $cart_item){
            array_push($cart,$cart_item["product_id"]);
        }
        // If present,show remove from cart
        return view('book_offers')->with(['offers'=>$offer_response,'cart'=>$cart]);
    }

    public function offer_detail($code){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=/OFFER/products');
        $offer_response = json_decode($request->getBody(),true)['MASTERS']['OFFER'];
        for($i=0;$i<count($offer_response);$i++){
            if($offer_response[$i]['code']==$code)
                return view('details.offer_details')->with('offer',$offer_response[$i]);
        }
    }

    public function test_detail($code){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=/TESTS/products');
        $test_response = json_decode($request->getBody(),true)['MASTERS']['TESTS'];
        for($i=0;$i<count($test_response);$i++){
            if($test_response[$i]['code']==$code)
                return view('details.test_details')->with('test',$test_response[$i]);
        }
    }

    public function profile_detail($code){
        $client = new Client();   
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=/PROFILE/products');
        $profile_response = json_decode($request->getBody(),true)['MASTERS']['PROFILE'];
        for($i=0;$i<count($profile_response);$i++){
            if($profile_response[$i]['code']==$code)
                return view('details.profile_details')->with('profile',$profile_response[$i]);
        }
    }

    public function add_to_cart(Request $request,$type,$name,$code,$rate,$margin,$count){
        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $code;
        $cart->name = $name;
        $cart->type = $type;
        $cart->rate = $rate;
        $cart->margin = $margin;
        $cart->count = $count;
        $cart->save();

        return redirect()->back();
    }

    public function remove_from_cart(Request $request,$type,$code){
        $cart = Cart::where(['user_id'=>auth()->user()->id,'product_id'=>$code])->first();
        $cart->delete();

        return redirect()->back();
    }

    public function viewcart($id){
        $cart = Cart::where('user_id',auth()->user()->id)->get();
        $beneficiaries = Beneficiary::where('user_id',auth()->user()->id)->get();
        $discount_percent = Discount::where("id",1)->first()->percent_discount;;
        $subtotal = 0;
        $discount = 0;

        for($i=0;$i<count($cart);$i++){
            $subtotal += $cart[$i]["rate"];
            $discount += ($discount_percent*$cart[$i]["margin"]/100);
        }

        $subtotal *= count($beneficiaries);
        $discount *= count($beneficiaries);
        $discount = round($discount);

        return view('cart')->with(['cart'=>$cart,'beneficiaries'=>$beneficiaries,'subtotal'=>$subtotal,'discount'=>$discount]);
    }

    public function checkPinCode(){
        $client = new Client();   
        $request = $client->get('https://www.thyrocare.com/API_BETA/order.svc/asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=/'.auth()->user()->pincode.'/PincodeAvailability');
        $response = json_decode($request->getBody(),true);
        $client = new Client(); 
        if(session('date'))
            $request = $client->get('https://www.thyrocare.com/api_beta/ORDER.svc/'.auth()->user()->pincode.'/'.session('date').'/GetAppointmentSlots');
        else
            $request = $client->get('https://www.thyrocare.com/api_beta/ORDER.svc/'.auth()->user()->pincode.'/'.date('Y-m-d').'/GetAppointmentSlots');
        $slots_response = json_decode($request->getBody(),true);
        return view('timeslots')->with(['serving'=>$response["status"],'response'=>$response,'slots_response'=>$slots_response["LSlotDataRes"]]);

    }

    public function displayTimeSlots(Request $request){
        //return $request->input('date');
        $request->session()->put('date',$request->input('date'));
        return redirect('/gettimeslots');
    }

    public function finalPage($slot){
        $cart = Cart::where('user_id',auth()->user()->id)->get();
        $beneficiaries = Beneficiary::where('user_id',auth()->user()->id)->get();
        $discount_percent = Discount::where("id",1)->first()->percent_discount;;

        $subtotal = 0;
        $discount = 0;

        for($i=0;$i<count($cart);$i++){
            $subtotal += $cart[$i]["rate"];
            $discount += ($discount_percent*$cart[$i]["margin"]/100);
        }

        $subtotal *= count($beneficiaries);
        $discount *= count($beneficiaries);
        $discount = round($discount);

        return view('final_page')->with(['cart'=>$cart,'beneficiaries'=>$beneficiaries,'subtotal'=>$subtotal,'discount'=>$discount,'slot'=>$slot]);
    }

    // public function myOrders(){
    //     $orders = Order::where('user_id',auth()->user()->id);
    //     $myOrders = array();
    //     foreach($orders as $order){
    //         $client = new Client();   
    //         $request = $client->get('https://www.thyrocare.com/API_BETA/order.svc/sNhdlQjqvoD7zCbzf56sxppBJX3MmdWSAomi@RBhXRrVcGyko7hIzQ==/'.$order->order_id.'/'.auth()->user()->mobile.'/all/OrderSummary');
    //         $response = json_decode($request->getBody(),true);
    //         array_push($myOrders,$response);
    //     }
    //     return view('my_orders')->with('myOrders',$myOrders);
    // }

    public function placeOrder(Request $request,$reports,$slot){
        $cart = Cart::where('user_id',auth()->user()->id)->get();
        $beneficiaries = Beneficiary::where('user_id',auth()->user()->id)->get();
        $discount_percent = Discount::where("id",1)->first()->percent_discount;;

        $subtotal = 0;
        $discount = 0;

        for($i=0;$i<count($cart);$i++){
            $subtotal += $cart[$i]["rate"];
            $discount += ($discount_percent*$cart[$i]["margin"]/100);
        }

        $subtotal *= count($beneficiaries);
        $discount *= count($beneficiaries);
        $discount = round($discount);

        if($slot[3]=='0'){
            $final_slot = substr($slot,0,2).':30';
        }
        else{
            $final_slot = substr($slot,8,2).':00';
        }
        // return $final_slot;

        // //Add the order entry to our local table
        // $order = new Order;
        // $order->user_id = auth()->user()->id;
        // $order_id = $order->order_id;
        // $order->save();

        // //Fix appointment for slot chosen
        // $client = new Client();
        // $request = $client->post('https://www.thyrocare.com/api_beta/ORDER.svc/FixAppointment',
        //                         array(
        //                             'form_params' => array(
        //                                 'Api_key'=>'asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=',
        //                                 'VisitId' => $order_id,
        //                                 'Pincode'=> auth()->user()->pincode,
        //                                 'AppointmentDate'=>session('date').' '.$final_slot,
        //                             )
        //                         )
        //                     );
        // $response = json_decode($request->getBody(),true);
        // if($response["RESPONSE"]!="SUCCESS")
        //     return redirect()->back()->with('error',"Oops, something went wrong. Please try again later!");

        //Post order to thyrocare
        $ben_str = '<NewDataSet>';
        return $ben_str;
        // for($i=0;$i<count($beneficiaries);$i++){
        //     $ben_str =  $ben_str.'<Ben_details><Name>'.$beneficiaries[$i]["first_name"].' '.$beneficiaries[$i]["last_name"].'</Name><Age>'.
        //                 $beneficiaries[$i]["age"].'</Age><Gender>'.$beneficiaries[$i]["gender"][0].'</Gender></Ben_details>';
        // }
        $ben_str=$ben_str.'</NewDataSet>';

        return $ben_str;
        $client = new Client();
        $request = $client->post('https://www.thyrocare.com/API_BETA/ORDER.svc/Postorderdata',
                                array(
                                    'form_params' => array(
                                        'Api_key'=>'asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=',
                                        'orderid' => $order_id,
                                        'address'=> auth()->user()->address,
                                        'pincode'=> auth()->user()->pincode,
                                        'product' => '',
                                        'std' => '0',
                                        'mobile' => auth()->user()->mobile,
                                        'email' => auth()->user()->email,
                                        'service_type' => 'H',
                                        'order_by' => auth()->user()->first_name.' '.auth()->user()->last_name,
                                        'rate' => $subtotal,
                                        'hc' => '0',
                                        'reports' => $reports,
                                        'ref_code' => 7208084766,
                                        'pay_type' => 'Prepaid',
                                        'passon'=> $discount,
                                        'bencount' => count($beneficiaries),
                                        'bendataxml' => $ben_str
                                    )
                                )
                            );
        $response = json_decode($request->getBody(),true);


        // //Clear cart
        // $cart_items = Cart::where(user_id,auth()->user()->id)->get();
        // foreach($cart_items as $item){
        //     $item->delete();
        // }

        // //Redirect to home page with "success"->Order has been placed, you'll receive a mail regarding the same.
        // return redirect('/')->with('success',"Your order has been successfully placed, you will receive an email regarding the same.");

    }
}
