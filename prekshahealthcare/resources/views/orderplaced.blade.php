@extends('layouts.newapp')

@section('content')
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">Order Placed
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
        <div class="card text-center">
            <div class="card-body">
               
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_aZTCrz.json"  background="transparent"  speed="1"  style="height: 200px;"  loop  autoplay></lottie-player>
              <h5 class="card-title">Order Placed Successfully</h5>
              <a href="/" class="btn btn-primary">Redirect to Home</a>
              <br>
              <br>
            </div>
          </div>
    </div>
  </section>
@endsection