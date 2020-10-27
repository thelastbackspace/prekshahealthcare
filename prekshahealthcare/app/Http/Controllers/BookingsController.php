<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Cart;
use App\Contact;
use App\Discount;
use App\Beneficiary;
use App\Order;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use DB;

class BookingsController extends Controller
{
    public function test_index(){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/jDXsNDgSYAVmNX)XuKuj5KP5ZWv8ZeUg5K72eXxvZcOd97SipsVZ7g==/TESTS/products');
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
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/jDXsNDgSYAVmNX)XuKuj5KP5ZWv8ZeUg5K72eXxvZcOd97SipsVZ7g==/PROFILE/products');
        $profile_response = json_decode($request->getBody(),true)['MASTERS']['PROFILE'];
        $cart = array();

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
        return view('book_profiles')->with(['profiles'=>$profile_response,'cart'=>$cart]);
    }

    public function offer_index(){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/jDXsNDgSYAVmNX)XuKuj5KP5ZWv8ZeUg5K72eXxvZcOd97SipsVZ7g==/OFFER/products');
        $offer_response = json_decode($request->getBody(),true)['MASTERS']['OFFER'];

        //Compare all items with Cart
        $cart = array();

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
        return view('book_offers')->with(['offers'=>$offer_response,'cart'=>$cart]);
    }

    public function offer_detail($code){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/jDXsNDgSYAVmNX)XuKuj5KP5ZWv8ZeUg5K72eXxvZcOd97SipsVZ7g==/OFFER/products');
        $offer_response = json_decode($request->getBody(),true)['MASTERS']['OFFER'];

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

        for($i=0;$i<count($offer_response);$i++){
            if($offer_response[$i]['code']==$code)
                return view('details.offer_details')->with(['offer'=>$offer_response[$i],'cart'=>$cart]);
        }
    }

    public function test_detail($code){
        $client = new Client();
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/jDXsNDgSYAVmNX)XuKuj5KP5ZWv8ZeUg5K72eXxvZcOd97SipsVZ7g==/TESTS/products');
        $test_response = json_decode($request->getBody(),true)['MASTERS']['TESTS'];

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

        for($i=0;$i<count($test_response);$i++){
            if($test_response[$i]['code']==$code)
                return view('details.test_details')->with(['test'=>$test_response[$i],'cart'=>$cart]);
        }
    }

    public function profile_detail($code){
        $client = new Client();   
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/jDXsNDgSYAVmNX)XuKuj5KP5ZWv8ZeUg5K72eXxvZcOd97SipsVZ7g==/PROFILE/products');
        $profile_response = json_decode($request->getBody(),true)['MASTERS']['PROFILE'];
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

        for($i=0;$i<count($profile_response);$i++){
            if($profile_response[$i]['code']==$code)
                return view('details.profile_details')->with(['profile'=>$profile_response[$i],'cart'=>$cart]);
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
        $discount_percent = Discount::where("id",1)->first()->percent_discount;
        $subtotal = 0;
        $discount = 0;

        for($i=0;$i<count($cart);$i++){
            $subtotal += $cart[$i]["rate"];
            $discount += ($discount_percent*$cart[$i]["rate"]/100);
            
        }

        $subtotal *= count($beneficiaries);
        $discount *= count($beneficiaries);
        $discount = round($discount);

       // echo $subtotal;
        //return $discount;   

        return view('cart')->with(['cart'=>$cart,'beneficiaries'=>$beneficiaries,'subtotal'=>$subtotal,'discount'=>$discount]);
    }

    public function checkPinCode(){
        $client = new Client();   
        $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/jDXsNDgSYAVmNX)XuKuj5KP5ZWv8ZeUg5K72eXxvZcOd97SipsVZ7g==/'.auth()->user()->pincode.'/PincodeAvailability');
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
            $discount += ($discount_percent*$cart[$i]["rate"]/100);
        }

        $subtotal *= count($beneficiaries);
        $discount *= count($beneficiaries);
        $discount = round($discount);

        return view('final_page')->with(['cart'=>$cart,'beneficiaries'=>$beneficiaries,'subtotal'=>$subtotal,'discount'=>$discount,'slot'=>$slot]);
    }

    public function myorders(){
         $orders = Order::where('user_id',auth()->user()->id);
         $myOrders = array();
         foreach($orders as $order){
             $client = new Client();   
             $request = $client->get('https://www.thyrocare.com/API_BETA/master.svc/jDXsNDgSYAVmNX)XuKuj5KP5ZWv8ZeUg5K72eXxvZcOd97SipsVZ7g==/'.$order->order_id.'/'.auth()->user()->mobile.'/all/OrderSummary');
             $response = json_decode($request->getBody(),true);
             array_push($myOrders,$response);
         }
         //return view('my_orders')->with('myOrders',$myOrders);
         return $myOrders;
     }

    public function placeOrder(Request $request,$reports,$slot,$test){
        $cart = Cart::where('user_id',auth()->user()->id)->get();
        $beneficiaries = Beneficiary::where('user_id',auth()->user()->id)->get();
        $discount_percent = Discount::where("id",1)->first()->percent_discount;
        $ben_array= json_decode($beneficiaries);
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
         //return $beneficiaries
         $order_id = uniqid();

        //Fix appointment for slot chosen
        $client = new Client();
        $requestdata = array(
                                     'Api_key'=>'asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=',
                                         'VisitId' => $order_id,
                                         'Pincode'=> auth()->user()->pincode,
                                         'AppointmentDate'=>session('date').' '.$final_slot,
                                     )
                                 ;

         $request = $client->request('POST', 'https://www.thyrocare.com/api_beta/ORDER.svc/FixAppointment',
         [
             'json' => $requestdata
         ]);
         $response = json_decode($request->getBody(),true);

         if($response["RESPONSE"]!="SUCCESS")
             return redirect()->back()->with('error',"Oops, something went wrong. Please try again later!");
            
       $ben_str = ''; 
       $ben_str_array='';
       
       foreach ($ben_array as $index => $ben_user)
       {
           $ben_str_array = $ben_str_array.$ben_str.'<Ben_details><Name>'.$ben_user->first_name.' '.$ben_user->last_name.'</Name><Age>'.
           $ben_user->age.'</Age><Gender>'.$ben_user->gender.'</Gender></Ben_details>';        
           
           $ben_count = $index+1;
       }
        $ben_str_array='<NewDataSet>'.$ben_str_array.'</NewDataSet>';

        

       $prod_array= json_decode($test); 

       $prod_str = ""; //this is product id string
       $prod_name = ""; //this is product name string

       
       foreach ($prod_array as $test_prod)
        {
           $prod_str = $test_prod->product_id.",".$prod_str; 
           $prod_str = rtrim($prod_str, ",");
           $prod_name = $test_prod->name.", ".$prod_name; 
           $prod_name = rtrim($prod_name, ",");
        }   

        $data= array(
                    "api_key"=> "asvnCqhd5Kgv@uOCAHDfGt)md5hBcNMfvPgYBeIXe3s=",
                    "mobile"=> auth()->user()->mobile,          
                    "email"=> auth()->user()->email,
                    "address"=> auth()->user()->address,
                    "pincode"=> auth()->user()->pincode,
                    "orderid"=> $order_id, 
                    "std"=> 0,
                    "service_type"=> "H",
                    "order_by"=> auth()->user()->first_name.' '.auth()->user()->last_name,
                    "remarks"=> "NA",
                    "ref_code"=> 7208084766,
                    "product"=> $prod_str, //take the cart value input here  
                    "rate"=> $subtotal,              
                    "hc"=> 0,
                    "appt_date"=> "2021-08-21 06:30:00 AM", 
                    "reports"=> $reports,
                    "pay_type"=> "Prepaid",      
                    "report_code"=> "",               
                    "bencount"=> $ben_count,
                    "geo_location"=> "",
                    "perPassOn"=> "0",
                    "passon"=> $discount,
                    "bendataxml"=> $ben_str_array,
        );

        $request = $client->request('POST', 'https://www.thyrocare.com/API_BETA/ORDER.svc/Postorderdata',
    [
        'json' => $data
    ]
);
   // echo $order_id;
    $response = json_decode($request->getBody(),true);
     //Clear cart
         $cart_items = Cart::where('user_id',auth()->user()->id)->get();
         foreach($cart_items as $item){
             $item->delete();
     }

        // Add the order entry to our local table
        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->order_id = $order_id;
        $order->name = auth()->user()->first_name.' '.auth()->user()->last_name;
        $order->product_name = $prod_name;
        //$order_id = $order->order_id; 
        $order->save();
        // Redirect to home page with "success"->Order has been placed, you'll receive a mail regarding the same.
         return view('orderplaced');
    }


    public function displayorder(){
        
        $myorders = DB::table('orders')->where('user_id',auth()->user()->id)->paginate(10);
       // $myorders = Order::where('user_id',auth()->user()->id)->get();
        return view('myorder')->with('myorders',$myorders);
    }

    public function getorder(){
        $myorders = DB::table('orders')->orderBy('id', 'desc')->paginate(10);  
        return view('myorder')->with('myorders',$myorders);
    }
    
    public function destroygetconsultation($id)
    {
        $todo = Contact::find($id);
        $todo->delete();
        $consultations = Contact::all();
        return back();
    }
}



