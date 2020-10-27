@extends('layouts.newapp')
@section('content')

@guest
<section id="hero" class="section hero">
  <div class="bg-section">
    <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
  </div>
  <div class="container">
    <div class="row row-content">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="hero-headline">Please login via admin account
          <br>
      </div>
      <div class="col-12 col-md-6 col-lg-6"></div>
    </div>
    <!-- .row end -->
  </div>
  <!-- .container end -->
</section>
@else
@if( Auth::User()->email == "prekshahealthcare@gmail.com")
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">Discount Pecentage
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
            <form action="/savechanges" method="post">
                @csrf
                <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label"><h5>Discount Percent:</h5></label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="exampleInputEmail1" name="percent_discount" value="{{old('percent_discount',$percent_discount)}}">
                    </div>
                </div>
                    <div class="text-center" style="margin:10px;">
                        <button type="submit" class="btn btn-md btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="text-center" style="margin:10px;">
          <a href="/admin/orders" class="btn btn-md btn-primary">Orders</a>
      </div>
      <div class="text-center" style="margin:10px;">
        <a href="/admin/consultation" class="btn btn-md btn-primary">Consultation</a>
    </div>
    </div>
  </section>

@else
<section id="hero" class="section hero">
  <div class="bg-section">
    <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
  </div>
  <div class="container">
    <div class="row row-content">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="hero-headline">You are not admin
          <br>
      </div>
      <div class="col-12 col-md-6 col-lg-6"></div>
    </div>
    <!-- .row end -->
  </div>
  <!-- .container end -->
</section>
@endif
@endguest

@endsection