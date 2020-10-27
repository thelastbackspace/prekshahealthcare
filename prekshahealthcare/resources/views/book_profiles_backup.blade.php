@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 style="margin:30px;" class="text-center h3-responsive font-weight-bold">Profiles</h3>
        <div class="row">
            @foreach ($profiles as $profile)
                <div class="col-md-4">
                    <div class="card" style="margin: 10px">
                        <div class="card-body text-center">
                            <a href="{{url('/profiles/'.$profile["code"].'/details')}}"><p class="card-title font-weight-bold">{{$profile["name"]}}</p></a>
                            <p class="card-subtitle mb-2 text-muted">{{count($profile["childs"])}} Tests</p>
                            <p class="card-subtitle mb-2 text-muted"> &#8377 {{$profile["rate"]["b2c"]}}</p>
                            
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

                        </div>
                    </div>
                </div>        
            @endforeach
        </div>
    </div>
@endsection