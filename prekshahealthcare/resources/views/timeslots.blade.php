@extends('layouts.newapp')

@section('content')
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">Choose Time Slot
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
        @if ($serving=="N")
            <div class="jumbotron text-center">
                <h4 class="h4-responsive font-weight-bold">Oops, Looks like we don't serve at your pincode :(</h4>
                <h5 class="h5-responsive font-weight-bold">You may edit your profile!</h5>
                <a href="" class="btn btn-warning btn-lg">Edit Profile</a>
            </div>
        @else
        <div class="jumbotron text-center">
            <h4 class="h4-responsive font-weight-bold">{{$response["LastMonthsOrders"]}}</h4>
        </div>
        <form action="{{url('/displaytimeslots')}}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="date" class="col-sm-3 col-form-label text-center"><strong>Choose appointment date</strong></label>
                <div class="col-sm-6">
                    @if(session('date'))
                        <input type="date" name="date" id="date" class="form-control" placeholder="DD-MM-YYYY" min="{{date('Y-m-d')}}" value="{{session('date')}}" required>
                    @else
                        <input type="date" name="date" id="date" class="form-control" placeholder="DD-MM-YYYY" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" required>
                    @endif
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary btn-md">Select</button>
                </div>
            </div>
        </form>
        @if(session('date'))
            <h4 class="text-center h4-responsive">Choose time slot for {{date('M jS, Y',strtotime(session('date')))}}</h4>
        @else
            <h4 class="text-center h4-responsive">Choose time slot for {{date('M jS, Y')}}</h4>
        @endif
        <p><li>Availability may vary based on Technician's availability</li></p>
        <div class="row">
            @if (count($slots_response)>0)
                @foreach ($slots_response as $slot)
                <div class="col-sm-6">
                    <a href="{{url('/finalpage/'.$slot["Slot"])}}">
                        <div class="jumbotron me smalldesc">
                            <h5 class="text-center font-weight-bold">{{$slot["Slot"]}}</h5>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <div class="jumbotron col-sm-12">
                    {{-- {{count($slots_response)}} --}}
                    <h5 class="text-center font-weight-bold">Oops, no appointments available for this day!</h5>
                </div>
            @endif
        </div>
        @endif
    </div>
  </section>
@endsection