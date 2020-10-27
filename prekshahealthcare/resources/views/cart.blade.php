@extends('layouts.newapp')
@section('content')
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">Cart Details
            <br>
        </div>
        <div class="col-12 col-md-6 col-lg-6"></div>
      </div>
      <!-- .row end -->
    </div>
    <!-- .container end -->
  </section>

  <section id="speciality" class="section feature feature-3 bg-white pb-80">
    <div class="container">
        <h3 style="margin:30px auto;" class="h3-responsive font-weight-bold">Selected Items ({{count($cart)}})</h3>
        @if(count($cart)>0)
            @foreach ($cart as $cart_item)
                <div class="row">
                    <div class="col-sm-10">
                    <h5 class="h5-responsive font-weight-bold">{{$cart_item["name"]}} ({{$cart_item["type"]}})</h5>
                    <h6><strong>{{$cart_item["count"]}} Test(s)</strong></h6>
                    <p>&#8377 {{$cart_item["rate"]}}</p>
                    </div>
                    <div class="col-sm-2">
                        <form action="{{url('/remove/'.$cart_item["type"].'/'.$cart_item["product_id"])}}" method="POST">
                            {{ csrf_field() }}
                            <button class="card-link btn btn-danger" type="submit">Remove From Cart</button>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach
        @endif
        <div class="row">
            <div class="col-sm-10">
                <h3 style="margin:30px auto;" class="h3-responsive font-weight-bold">Beneficiary Details</h3>
            </div>
            <div class="col-sm-2">
                <a href="/beneficiaries/add" style="margin:30px auto;" class="btn btn-warning btn-md">&nbsp;Add Beneficiaries &nbsp;</a>
            </div>
        </div>
        <div class="jumbotron">
            {{-- display all beneficiaries by using for each with an edit and delete button --}}
            <div class="row">
                @if(count($beneficiaries)>0)
                @foreach ($beneficiaries as $ben)
                    <div class="col-md-3">
                        <div class="jumbotron" style="background-color: white; color: black;">
                            <h4 class="h4-responsive font-weight-bold">{{$ben->first_name}} {{$ben->last_name}}</h4>
                            <h6>{{$ben->gender}}, {{$ben->age}} years</h6>
                            
                           
                           
                            <div class="d-flex justify-content-around col-12">
                                

                                
                                    <a href="{{url('/beneficiaries/'.$ben->id.'/edit')}}" class="btn btn-warning btn-xs col-2"><span class="material-icons">
                                        create
                                        </span></a>
                                    <br>
                                    <form action="{{url('/beneficiaries/'.$ben->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-xs col-2" type="submit"><span class="material-icons">
                                            clear
                                            </span></button>
                                    </form>
                               
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
        <h3 style="margin:30px auto;" class="h3-responsive font-weight-bold">Payment Details</h3>
        <div class="jumbotron" style="background-color: white;color:black">
            <div class="row">
                <div class="col-sm-10">
                    <h5 class="h5-responsive font-weight-bold">Total Amount:</h5>
                </div>
                <div class="col-sm-2">
                    <h6 class="h6-responsive">&#8377 {{$subtotal}}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <h5 class="h5-responsive font-weight-bold">Total Discount:</h5>
                </div>
                <div class="col-sm-2">
                    <h6 class="h6-responsive">&#8377 {{$discount}}</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <input type="checkbox" name="reports" id="reports" onclick="myFunction()">
                    <label for="reports"><h5 class="h5-responsive font-weight-bold">Reports:<small>(Hard Copy)</small></h5></label>
                </div>
                <div class="col-sm-2">
                    <h6 class="h6-responsive" id="report-rate" style="display: none">&#8377 75</h6>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-sm-10">
                    <h4 class="h4-responsive font-weight-bold">Payable Amount:</h4>
                </div>
                <div class="col-sm-2">
                    <h5 class="h5-responsive" id="without" style="display: block">&#8377 {{$subtotal-$discount}}</h5>
                    <h5 class="h5-responsive" id="with" style="display:none">&#8377 {{$subtotal-$discount+75}}</h5>
                </div>
            </div>
        </div>

        <div class="text-center">
                <a href="/gettimeslots" class="btn btn-success">Proceed to Checkout</a>
        </div>
    </div>

  </section>
@endsection
