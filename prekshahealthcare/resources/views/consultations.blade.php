@extends('layouts.newapp')
@section('content')
<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">My Orders
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
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Sr. no.</th>
                <th scope="col">Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>

            @foreach($consultations as $consultation)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $consultation->name }}</td>
                <td>{{ $consultation->phone_number }}
                </td>
                <td> 
                    <form method="post" action="/admin/consultation/{{$consultation->id}}">
                      {{ csrf_field() }}
                      <button class="card-link btn btn-success" type="submit">Contacted</button>
                  </form>
                   
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
    </div>
  </section>
@endsection
