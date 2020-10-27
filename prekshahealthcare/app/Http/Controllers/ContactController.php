<?php 

namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use App\Contact;
use Mail; 

class ContactController extends Controller { 

      public function getContact() { 

       return view('contact_us'); 
      } 

     public function saveContact(Request $request) { 
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
        ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->phone_number = $request->phone_number;
        $contact->save();

          return back()->with('success', 'Thank you for booking free consultation!');

    }
    public function index()
    {
        $consultations = Contact::all();
        if(auth()->user()->email!="prekshahealthcare@gmail.com")
            redirect('/');
        else 
            return view('consultations')->with('consultations',$consultations);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(welcome $welcome)
    {
        
    }
    public function edit(welcome $welcome)
    {
        
    }
    public function update(Request $request, welcome $welcome)
    {
        //
    }
    public function destroy(Request $id)
    {
        return $id;
        $contact->delete();
        return redirect('admin/consultation/');
    }

    public function contacted(Request $request,$id){
        $cart = Contact::where(['id'=>$id]);
        $cart->delete();
        return redirect()->back();
    }
}
