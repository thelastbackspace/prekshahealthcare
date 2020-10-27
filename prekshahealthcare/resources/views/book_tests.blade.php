@extends('layouts.newapp')
@section('content')
      <!-- Slider #1 ============================================= -->
      <section id="hero" class="section hero">
        <div class="bg-section">
          <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
        </div>
        <div class="container">
          <div class="row row-content">
            <div class="col-12 col-md-6 col-lg-6">
              <div class="hero-headline">Book your tests
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
          <div class="row">
            @auth 
            <div class="col-12 col-md-12 col-lg-12 text-center pb-80">
              <a class="btn btn-success" href="/viewcart/{{ Auth::User()->id }}">View Cart</a>
            </div>
            @endauth
            @foreach ($tests as $test)


            <div class="col-12 col-md-4 col-lg-4">
                <div class="feature-panel">
                  <div class="feature-img">
                    <img src="{{ asset('images/icons/1.svg') }}" alt="target">
                  </div>
                  <div class="feature-content">
                    <a href="{{url('/tests/'.$test["code"].'/details')}}"><h3>{{$test["name"]}}</h3></a>
                    <p>₹ {{$test["rate"]["b2c"]}}</p>
                    <br>
                    @guest
                            
                    <a href="{{ url('/login') }}" class="card-link btn btn-primary">Add to cart</a>
                @else
                    @if(in_array($test["code"],$cart))
                        <form action="{{url('/remove/TEST/'.$test["code"])}}" method="POST">
                            {{ csrf_field() }}
                            <button class="card-link btn btn-danger" type="submit">Remove From Cart</button>
                        </form>
                    @else
                        <form action="{{url('/add/TEST/'.$test["name"].'/'.$test["code"].'/'.$test["rate"]["b2c"].'/'.$test["margin"].'/1')}}" method="post">
                            {{ csrf_field() }}
                            <button class="card-link btn btn-primary" type="submit">Add To Cart</button>
                        </form>
                    @endif
                @endguest
                  </div>
                </div>
                <!-- .feature-panel end -->
              </div>
                   
            @endforeach
            @auth 
            <div class="col-12 col-md-12 col-lg-12 text-center pb-80">
              <a class="btn btn-success" href="/viewcart/{{ Auth::User()->id }}">View Cart</a>
            </div>
            @endauth
        </div>

    </section>
@endsection