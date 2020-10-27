@extends('../layouts.newapp')
@section('content')

<section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset("images/background/hero.jpg") }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">Edit Benefitiary
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
        <h6 class="text-center h6-responsive font-weight-bold">Max 10 beneficiaries can be added by a user</h6>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Beneficiary') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ url('/beneficiaries/'.$ben->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name',$ben->first_name) }}" required autofocus>
    
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name',$ben->last_name) }}" required>
    
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
    
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input id="male" type="radio" class="form-check-input{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="M" @if(old('gender')) checked @endif>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="female" type="radio" class="form-check-input{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="F" @if(!old('gender')) checked @endif>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>
    
                                <div class="col-md-6">
                                    <input id="age" type="number" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ old('age',$ben->age) }}" required>
    
                                    @if ($errors->has('age'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('age') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Edit Beneficiary</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </section>
@endsection