@extends('layouts.newapp')
@section('content')
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">My Orders
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
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Sr. no.</th>
                <th scope="col">Order id</th>
                <th scope="col">Product</th>
                <th scope="col">Date & Time</th>
              </tr>
            </thead>
            <tbody>

            @foreach($myorders as $myorder)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $myorder->order_id }}</td>
                <td>{{ $myorder->product_name }}</td>
                <td>{{ $myorder->created_at }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $myorders->render()  }} 
    </div>
    
  </section>
@endsection
