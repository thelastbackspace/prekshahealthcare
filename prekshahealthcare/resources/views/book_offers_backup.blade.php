@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="text-center h2-responsive font-weight-bold">Our Products</h2>
        <h3 style="margin:30px;" class="text-center h3-responsive font-weight-bold">Offers</h3>
        <div class="row">
            @foreach ($offers as $offer)

                <div class="col-md-4">
                    <div class="card" style="margin: 10px">
                        <div class="card-body text-center">
                            <a href="{{url('/offers/'.$offer["code"].'/details')}}"><p class="card-title font-weight-bold">{{$offer["name"]}}</p></a>
                            <h5 class="card-subtitle mb-2 text-muted">{{count($offer["childs"])}} Tests</h5>
                            <p style="text-decoration:line-through;" class="card-subtitle mb-2 text-muted">&#8377 {{$offer["rate"]["b2c"]}}</p>
                            <p class="card-subtitle mb-2 text-muted">&#8377 {{$offer["rate"]["offer_rate"]}}</p>
                            <p class="card-subtitle mb-2 text-muted">Valid till: {{$offer["valid_to"]}}</p>
                            
                            @if(in_array($offer["code"],$cart))
                                <form action="{{url('/remove/OFFER/'.$offer["code"])}}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="card-link btn btn-danger" type="submit">Remove From Cart</button>
                                </form>
                            @else
                                <form action="{{url('/add/OFFER/'.$offer["name"].'/'.$offer["code"].'/'.$offer["rate"]["offer_rate"].'/'.$offer["margin"].'/'.count($offer["childs"]))}}" method="post">
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