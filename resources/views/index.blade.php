@extends('layout')

@section('main')
    <div style="margin-left: 1vw; margin-top: 1vw; margin-right: 1vw; border-radius: 30px;">
      <div class="carousel carousel-slider center" style="border-radius: 30px; height: 500px;">
          <!-- <div class="carousel-fixed-item center">
            <a class="btn waves-effect white grey-text darken-text-2">button</a>
          </div> -->
          <div class="carousel-item " style="background-image: url('./assets/slider/mp.png');  background-position: center;  background-size: cover; height: 100%;">
                  <h2 class="black-text">First Panel</h2>
                  <p class="black-text">This is your first panel</p>
          </div>
          <div class="carousel-item " style="background-image: url('./assets/slider/plane.png'); background-position: center;  background-size: cover; height: 100%;">
                  <h2 class="white-text">second Panel</h2>
                  <p class="white-text">This is your first panel</p>
          </div>
          <div class="carousel-item " style="background-image: url('./assets/slider/plane.png'); background-position: center;  background-size: cover; height: 100%;">
              <h2 class="white-text">Third Panel</h2>
              <p class="white-text">This is your first panel</p>
          </div>
          <div class="carousel-item " style="background-image: url('./assets/slider/plane.png'); background-position: center;  background-size: cover; height: 100%;">
              <h2 class="white-text">Fourth Panel</h2>
              <p class="white-text">This is your first panel</p>
          </div>
        </div>
    </div>
  <div class="container" style="margin-top: 10vh;">
      <h3 class="center-align" style="font-weight: 600;">Internships</h3>

      <h6 class="center-align" style="margin-top: 5vh; font-size: 20px; font-weight: 500;">
          <span>Apply to Different Internships From Our trusted Partners for free with in Nepal</span>
      </h6>
  </div>
  <div class="container" style="margin-top: 10vh;">
      <h4 class="center-align" style="font-weight: 600;">Categories</h4>
      <div class="flexcontainer">
          <div class="center-flex hoverable">
              <div class="">
                  <img src="{{asset('assets/svgs/salesman.svg')}}" height="140" alt="">
              </div>
              <div>
                  <span style="font-weight: 600; font-size: 25px;">Sales</span>
              </div>
          </div>
          <div class="center-flex hoverable">
              <div class="">
                  <img src="{{asset('assets/svgs/developer.svg')}}" height="140" alt="">
              </div>
              <div>
                  <span style="font-weight: 600; font-size: 25px;">Developer</span>
              </div>
          </div>
      </div>
      <div class="center" style="margin-top: 5vh;">
          <button class="waves-effect btn-flat" style="font-size: 20px; font-weight: 600; color: #006994;">View Internships <i class="material-icons right">arrow_forward</i></button>
        </div>
  </div>
  <div class="">
      <div style="margin-top: 10vh;">
          <div class="">
              <h4 style="font-weight: 600;" class="center-align">Freshers Jobs <h4>
          </div>
       <div class="center">
          <div class="flexcontainer2">
              <div class="center-flex z-depth-3" style="width:300px;">
                  <div class="">
                      <img src="./assets/svgs/city.svg" height="140" alt="">
                  </div>
                  <div>
                      <span style="font-weight: 600; font-size: 25px;">Trusted Companies</span>
                  </div>
              </div>
              <div class="center-flex z-depth-3" style="width:300px;">
                  <div class="">
                      <img src="./assets/svgs/original-tag.svg" height="140" alt="">
                  </div>
                  <div>
                      <span style="font-weight: 600; font-size: 25px;">Verified Jobs</span>
                  </div>
              </div>
          </div>
       </div>
          
          <div class="center">
            <button class="waves-effect btn-flat" style="font-size: 20px; font-weight: 600; color: #006994;">View Jobs <i class="material-icons right">arrow_forward</i></button>
          </div>
        
      </div>
  </div>
  <div class="container" style="margin-top: 10vh;">
      <div class="cardbox z-depth-2 hoverable">
          <h3 class="center-align" style="font-weight: 600;">Wanna explore More?</h3>
          <div class="row" style="margin-top: 10vh;">
              <div class="col s6 right-align">
                  <button class="waves-effect theme btn-large modal-trigger" style=" border-radius: 20px;" href="#modal3">Login</button>
              </div>
              <div class="col s6 left-align">
                  <button class="waves-effect theme btn-large dropdown-trigger" style="border-radius: 20px;" href="#dropdown2">Register Now</button>
              </div>
          </div>
      </div>
      
  </div>
@endsection
