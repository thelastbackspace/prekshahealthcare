@extends('../layouts.newapp')
@section('content')
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">{{$test['name']}}
            <br>
            <div>₹{{$test['rate']['pay_amt']}}</div>
        </div>
        <div class="col-12 col-md-6 col-lg-6"></div>
      </div>
      <!-- .row end -->
    </div>
    <!-- .container end -->
  </section>

  <section id="speciality" class="section feature feature-3 bg-white pb-80">
    <div class="container">
        @if ($test['image_location']!="null")
            <img src="{{$test['image_location']}}" alt="" style="width: 100%;">
        @endif

        <div class="feature-content">
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
  </section>
@endsection