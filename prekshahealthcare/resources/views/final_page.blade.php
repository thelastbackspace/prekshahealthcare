@extends('layouts.newapp')

@section('content')
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">Order Details
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
        <div class="jumbotron">
            @foreach ($cart as $item)
                <div class="row">
                    <div class="col-sm-10">
                        <h5 class="h5-responsive">{{$item->name}} ({{$item->type}})</h5>
                    </div>
                    <div class="col-sm-2">
                        <h5 class="h5-responsive font-weight-bold">&#8377 {{$item->rate}}</h5>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        <h3 class="h3-responsive font-weight-bold">Beneficiary Details <small>({{count($beneficiaries)}} Beneficiaries)</small></h3>

        <table class="table table-striped" style="margin: 20px auto;">
            <thead>
              <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($beneficiaries as $ben)
                    
                <tr>
                    <th scope="row">{{$ben->first_name}}</th>
                    <td>{{$ben->last_name}}</td>
                    <td>{{$ben->gender}}</td>
                    <td>{{$ben->age}}</td>
                </tr>
                
                @endforeach
            </tbody>  
        </table>
        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron" style="background-color:white">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="h5-responsive">Appointment Date</h5>
                        </div>
                        <div class="col-sm-4">
                            <h5 class="h5-responsive font-weight-bold">{{date('M jS, Y',strtotime(session('date')))}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="h5-responsive">Time Slot</h5>
                        </div>
                        <div class="col-sm-4">
                            <h5 class="h5-responsive font-weight-bold">{{$slot}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="jumbotron" style="background-color:white">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="h5-responsive">Discount Offered <small>(x{{count($beneficiaries)}})</small></h5>
                        </div>
                        <div class="col-sm-4">
                            <h5 class="h5-responsive font-weight-bold">&#8377 {{$discount}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="checkbox" name="reports" id="reports" onclick="myFunction()">
                            <label for="reports"><h5 class="h5-responsive">Reports:<small>(Hard Copy)</small></h5></label>
                        </div>
                        <div class="col-sm-4">
                            <h5 class="h5-responsive font-weight-bold" id="report-rate" style="display: none">&#8377 75</h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="h5-responsive">Amount Payable <small>(x{{count($beneficiaries)}})</small></h5>
                        </div>
                        <div class="col-sm-4">
                            <h5 class="h5-responsive font-weight-bold" id="without" style="display: block">&#8377 {{$subtotal-$discount}}</h5>
                            <h5 class="h5-responsive font-weight-bold" id="with" style="display: none">&#8377 {{$subtotal-$discount+75}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{url('/placeorder/N/'.$slot.'/'.$cart)}}" method="post" id="bolo" name="bolo" style="display: block">
            @csrf
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-success">Place Order</button>
            </div>
        </form>
        <form action="{{url('/placeorder/Y/'.$slot.'/'.$cart)}}" method="post" id="bolo_1" name="bolo_1" style="display: none">
            @csrf
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-success">Place Order</button>
            </div>
        </form>

        <script>
            function myFunction(){
                if(document.getElementById("reports").checked==true){
                    document.getElementById('report-rate').style.display="block";
                    document.getElementById('with').style.display="block";
                    document.getElementById('without').style.display="none";
                    document.bolo_1.style.display="block";
                    document.bolo.style.display="none";
                }
                else{
                    document.getElementById('report-rate').style.display="none";
                    document.getElementById('with').style.display="none";
                    document.getElementById('without').style.display="block";
                    document.bolo_1.style.display="none";
                    document.bolo.style.display="block";
                }
            }
        </script>

    </div>
  </section>
@endsection