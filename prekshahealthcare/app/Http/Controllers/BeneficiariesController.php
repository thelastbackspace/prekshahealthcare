<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiary;
use App\User;

class BeneficiariesController extends Controller
{
    //
    public function new(){
        $beneficiaries = Beneficiary::where('user_id',auth()->user()->id)->get();
        return view('beneficiaries.new')->with('beneficiaries',$beneficiaries);
    }

    public function store(Request $request){
        $this->validate($request,[
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'gender'=>'required|string|max:6',
            'age'=>'required|integer'
        ]);
        $ben = new Beneficiary;
        $ben->user_id = auth()->user()->id;
        $ben->first_name = $request->input('first_name');
        $ben->last_name = $request->input('last_name');
        $ben->gender = $request->input('gender');
        $ben->age = $request->input('age');
        $ben->save();

        return redirect('/viewcart/'.auth()->user()->id);
    }

    public function edit($id){
        $beneficiaries = Beneficiary::find($id);
        return view('beneficiaries.edit')->with('ben',$beneficiaries);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'gender'=>'required|string|max:6',
            'age'=>'required|integer'
        ]);
        $ben = Beneficiary::find($id);
        $ben->user_id = auth()->user()->id;
        $ben->first_name = $request->input('first_name');
        $ben->last_name = $request->input('last_name');
        $ben->gender = $request->input('gender');
        $ben->age = $request->input('age');
        $ben->save();

        return redirect('/viewcart/'.auth()->user()->id);
    }

    public function destroy(Request $request,$id){
        $ben = Beneficiary::find($id);
        $ben->delete();

        return redirect('/viewcart/'.auth()->user()->id);
    }

    public function edit_user(){
        $user = User::find(auth()->user()->id);
        return view('edit')->with('user',$user);
    }

    public function update_user(Request $request,$id){
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'mobile' => 'required|string|min:10|max:10',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'address' => 'required|string',
            'pincode' => 'required|string',
            'city'=> 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        $user=User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->gender = $request->input('gender');
        $user->mobile = $request->input('mobile');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->pincode = $request->input('pincode');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->save();

        return redirect('/')->with('success','Profile successfully updated!');
    }
}
