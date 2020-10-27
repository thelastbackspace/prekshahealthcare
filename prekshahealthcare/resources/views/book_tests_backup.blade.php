@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 style="margin:30px;" class="text-center h3-responsive font-weight-bold">Tests</h3>
        <div class="row">
            @foreach ($tests as $test)
                <div class="col-md-4">
                    <div class="card" style="margin: 10px">
                        <div class="card-body text-center">
                            <a href="{{url('/tests/'.$test["code"].'/details')}}"><p class="card-title font-weight-bold">{{$test["name"]}}</p></a>
                            <p class="card-subtitle mb-2 text-muted">&#8377 {{$test["rate"]["b2c"]}}</p>
                           
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
                           
                        </div>
                    </div>
                </div>        
            @endforeach
        </div>
    </div>
@endsection