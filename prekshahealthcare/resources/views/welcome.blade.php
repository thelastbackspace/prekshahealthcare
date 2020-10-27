@extends('layouts.newapp')

@section('content')
 
 
 
 <!-- Slider #1 ============================================= -->

 <section id="hero" class="section hero">
    <div class="bg-section">
      <img src="{{ asset('images/background/hero.jpg') }}" alt="background">
    </div>
    <div class="container">
      <div class="row row-content">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="hero-headline">Your Health Care is
            <br>
            Our
            <span class="typed-text" data-typed-string="Responsibility,Purpose,Ambition"></span></div>
          <div class="hero-bio">Book your test directly from your phone<br>
            <small class="">For any query, contact us at +91 98924 60335</small>
          </div>
          
          <div class="hero-action">
            <a href="#consultation" class="btn btn--primary" data-scroll="scrollTo">Free Consultation</a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6"></div>
      </div> 
      <!-- .row end -->
    </div>
    <!-- .container end -->
    
  </section>
  <!-- #slider end -->
  <!-- Feature #1 ============================================= -->
  <section id="speciality" class="section feature feature-3 bg-white pb-80">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="heading heading-1 text-center">
            <h2 class="heading-title">Our Speciality</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Panel #1 -->
        <div class="col-12 col-md-4 col-lg-4">
          <div class="feature-panel">
            <div class="feature-img">
              <img src="{{ asset('images/icons/1.svg') }}" alt="target">
            </div>
            <div class="feature-content">
              <h3>Best Medical Lab in Mumbai</h3>
              <p>If you are in need of medical laboratory services, then look no further! Here at Preksha Health Care we can provide you with top-notch medical laboratory services. Whether you need routine sample analyses or a one-off specialised test, our professional staff are available to get your work done for you accurately and on time. We are located in Mumbai and can be easily contacted on +917208084766.</p>
            </div>
          </div>
          <!-- .feature-panel end -->
        </div>
        <!-- .col-md-4 end -->

        <!-- Panel #2 -->
        <div class="col-12 col-md-4 col-lg-4">
          <div class="feature-panel">
            <div class="feature-img">
              <img src="{{ asset('images/icons/2.svg') }}" alt="target">
            </div>
            <div class="feature-content">
              <h3>A Highly Trained Team</h3>
              <p>Our highly trained, certified and professional team of laboratory technicians and specialists are always ready to carry out medical test analyses according to your requirements. They are friendly, compassionate, supportive and ready to provide you with the assistance you need. We strive to return your accurate test results. We also guarantee that your personal data and results will be kept confidential.</p>
            </div>
          </div>
          <!-- .feature-panel end -->
        </div>
        <!-- .col-md-4 end -->

        <!-- Panel #3 -->
        <div class="col-12 col-md-4 col-lg-4">
          <div class="feature-panel">
            <div class="feature-img">
              <img src="{{ asset('images/icons/3.sv') }}g" alt="target">
            </div>
            <div class="feature-content">
              <h3>Our Laboratory Technicians</h3>
              <p>Our medical laboratory staff are all licensed professionals with several years of experience. Skilled and reliable, we completely trust them to deliver accurate and error-free work. Every staff member goes through a very rigorous and complex recruitment process, which helps ensure that all of our employees fit our high standards of professionalism, medical laboratory practice and medical ethics.</p>
            </div>
          </div>
          <!-- .feature-panel end -->
        </div>
        <!-- .col-md-4 end -->

      </div>
      <!-- .row end -->
    </div>
    <!-- .container end -->
  </section>
  <!-- #speciality end -->

  <section id="bar" class="bg-white pt-0 pb-0">
    <div class="container">
      <div class="row">
        <div class="col">
          <hr class="hr-bar">
        </div>
      </div>
    </div>
  </section>
  <!-- #bar end -->

  <!-- Feature #2 ============================================= -->
  <section id="feature2" class="section feature feature-left bg-white">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="heading heading-1 mb-50 mt-30">
            <h2 class="heading-title">About Us</h2>
            <p class="heading-desc">Your life is our specialty. Our team of experienced physicians offers a comprehensive range of healthcare services.</p>
          </div>
          <div class="feature-panel">
            <div class="feature-img">
              <img src="{{ asset('images/icons/7.svg') }}" alt="about"/>
            </div>
            <div class="feature-content">
              <h3>Expert STAFF</h3>
              <p>Our team of physicians are experienced in the medical field.</p>
            </div>
          </div>
          <!-- .feature-panel end -->
          <div class="feature-panel">
            <div class="feature-img">
              <img src="{{ asset('images/icons/8.svg') }}" alt="about"/>
            </div>
            <div class="feature-content">
              <h3>Healthy Environment</h3>
              <p>We maintain healthy enviornment in all our labs.</p>
            </div>
          </div>
          <!-- .feature-panel end -->
        </div>
        <!-- .col-md-6 end -->
        <div class="col-12 col-md-6 col-lg-6">
          <img class="img-fluid img-shadow pull-right" src="{{ asset('images/features/about.jpg') }}" alt="about"/>
        </div>
        <!-- .col-md-6 end -->

      </div>
      <!-- .row end -->
    </div>
    <!-- .container end -->
  </section>
  <!-- #feature2 end -->

  <!-- Testimonial ============================================= -->
  <section id="patients" class="section testimonials bg-gray">
    <div class="container">
      <div class="row clearfix">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="heading heading-1 text-center">
            <h2 class="heading-title">Patients Say</h2>
          </div>
        </div>
        <!-- .col-md-6 end -->
      </div>
      <!-- .row end -->
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <div class="carousel carousel-dots owl-carousel" data-slide="2" data-slide-rs="2" data-autoplay="true" data-nav="false" data-dots="true" data-space="30" data-loop="true" data-speed="800">

            <!-- Testimonial #1 -->
            <div class="testimonial-panel">
              <div class="testimonial-body">
                <p>The labs of Preksha Health Care are good enough. They maintain hygiene in all their labs.</p>
                <div class="testimonial-author">
                  <h5>Ramesh Tandon</h5>
                </div>
              </div>
            </div>

            <!-- Testimonial #2 -->
            <div class="testimonial-panel">
              <div class="testimonial-body">
                <p>Prices of all the tests are better than what others offer. Also, really satisfied with the service</p>
                <div class="testimonial-author">
                  <h5>Robin Sinha</h5>
                </div>
              </div>
            </div>

          </div>
          <!-- .carousel End -->
        </div>
      </div>
      <!-- .row End -->
    </div>
    <!-- .container End -->
  </section>
  <!-- #patients End-->
  <!-- Action ============================================= -->
  <section id="consultation" class="section feature feature-2 bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="feature-panel">
            <div class="feature-content">
              <h3>Free Medical Consultation</h3>
              <p class="mb-30">We provide a free medical consultation for our patients, Once you submit the request, our office will contact you within one business day to schedule your appointment.</p>
              <ul>
                <li>Explain your health concerns.</li>
                <li>A Specialist will answer your questions.</li>
                <li>And, suggest you the required test.</li>
              </ul>
            </div>
          </div>
          <!-- .feature-panel end -->
        </div>
        <!-- .col-md-6 end -->
        <div class="col-12 col-md-6 col-lg-5 offset-lg-1">
          <div class="form-wrapper">
            <div class="heading">
              <h3 class="heading-title">Request a Free Consultation</h3>
            </div>
            <!-- .form-group end -->
            <form method="post" action="contact-us" class="contactForm mb-0">
              {{csrf_field()}}
              <div id="result" class="contact-result"></div>
              <div class="form-group">
                <label for="name">Your Name*</label>
                <input type="text" class="form-control" name="name" id="name" required="required">
              </div>
              <!-- .form-group end -->
              <div class="form-group">
                <label for="Phone number">Your Phone*</label>
                <input type="text" class="form-control" name="phone_number" id="phone" required="required">
              </div>
              <!-- .form-group end -->
              <div class="form-group">
                <input type="submit" value="Request a Free Consultation" name="submit" class="btn btn--primary btn--block">
              </div>
              <!-- .form-group end -->
              <div class="agreement">Available for limited time.</div>
            </form>
          </div>
        </div>
        <!-- .col-md-6 end -->

      </div>
      <!-- .row end -->
    </div>
    <!-- .container end -->
  </section>
  <!-- #consultation end -->
  <!-- Certification -->
  <section class="section feature feature-3 bg-white pb-80">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="heading heading-1 text-center">
            <h2 class="heading-title">Certificates</h2>
          </div>
        </div>
      </div>
      <div class="row">
  <div class="card-deck">
    <div class="card">
      <img src="{{ asset('images/logo/1.jpg') }}" class="card-img-top" alt="...">
    </div>
    <div class="card">
      <img src="{{ asset('images/logo/2.jpg') }}" class="card-img-top" alt="...">
    </div>
    <div class="card">
      <img src="{{ asset('images/logo/3.jpg') }}" class="card-img-top" alt="...">
    </div>
    <div class="card">
      <img src="{{ asset('images/logo/4.jpg') }}" class="card-img-top" alt="...">
    </div>
  </div>
      </div></div>
  </section>



  <section class="section feature feature-3 bg-white pb-80">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="heading heading-1 text-center">
            <h2 class="heading-title">Insurances</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card col-12 col-md-12 col-lg-12 text-center">
          <div class="card-body">
            <p class="card-text" style="font-size:20px;">We offer different types of insurances, click on the link below to know more about it.</p>
            <a href="/insurance" class="btn btn-primary">Know More</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection