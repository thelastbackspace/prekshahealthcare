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
              <div class="hero-headline">Book Profiles
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
            @foreach ($profiles as $profile)


            <div class="col-12 col-md-4 col-lg-4">
                <div class="feature-panel">
                  <div class="feature-img">
                    <img src="{{ asset('images/icons/1.svg') }}" alt="target">
                  </div>
                  <div class="feature-content">
                    <a href="{{url('/profiles/'.$profile["code"].'/details')}}"><h3>{{$profile["name"]}}</h3></a>
                    <p class="card-subtitle mb-2 text-muted">{{count($profile["childs"])}} Tests</p>
                    <p class="card-subtitle mb-2 text-muted"> &#8377 {{$profile["rate"]["b2c"]}}</p>
                    <br>
                    @guest
                            
                    <a href="{{ url('/login') }}" class="card-link btn btn-primary">Add to cart</a>
                @else
                    @if(in_array($profile["name"],$cart))
                        <form action="{{url('/remove/PROFILE/'.$profile["name"])}}" method="POST">
                            {{ csrf_field() }}
                            <button class="card-link btn btn-danger" type="submit">Remove From Cart</button>
                        </form>
                    @else
                        <form action="{{url('/add/PROFILE/'.$profile["name"].'/'.$profile["name"].'/'.$profile["rate"]["b2c"].'/'.$profile["margin"].'/'.count($profile["childs"]))}}" method="post">
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