@extends('../layouts.newapp')
@section('content')
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">{{$profile['name']}}
            <br>
            <div>₹{{$profile['rate']['pay_amt']}}</div>
        </div>
        <div class="col-12 col-md-6 col-lg-6"></div>
      </div>
      <!-- .row end -->
    </div>
    <!-- .container end -->
  </section>

  <section id="speciality" class="section feature feature-3 bg-white pb-80">
    <div class="container">
        @if ($profile['image_location']!="null")
            <img src="{{$profile['image_location']}}" alt="" style="width: 100%;">
        @endif
        <div class="feature-content">
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
  </section>
@endsection