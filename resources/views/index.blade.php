@extends('layout')

@section('main')
   
<div class="main-content-home">
    <div>
        <div class="row white hide-on-med-and-down">
            <div class="col s12 l6 m12" style="padding: 30px; margin-top: 30px;">
                <img src="./assets/images/Main-light-transparent.png" class="responsive-img" alt="">
                <h4 style="margin-left: 20px;" class="theme-text">Welcome To Your Professional community</h4>
                <p  style="margin-left: 20px; font-size: 1.3rem">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus illo architecto accusantium atque facere commodi quo itaque, error suscipit quia.</p>
                <div class="center" style="margin-top: 8vh;">
                    <button class="btn-large waves-effect waves-light theme" style="border-radius: 30px;  margin-top:20px;">Sign Up Now!</button><button class="btn-large waves-effect waves-light theme" style="border-radius: 30px; margin-left: 20px; margin-top:20px;">Log In</button>
                </div>
            </div>
            <div class="col s12 l6 m12">
                <div class="center">
                    <img src="./assets/pngs/concept-of-remote-team-2112518.png" class="responsive-img" alt="">
                </div>
                
            </div>
        </div>
        <div class="row white hide-on-large-only">
            <div class="col s12 l6 m12" style="padding: 30px; margin-top: 30px;">
                <img src="{{asset('assets/images/Main-light-transparent.png')}}" class="responsive-img" alt="">
                <h4 class="center-align theme-text">Welcome To Your Professional community</h4>
                <p  style="font-size: 1.3rem; text-align:justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus illo architecto accusantium atque facere commodi quo itaque, error suscipit quia.</p>
            </div>
            <div class="col s12 l6 m12">
                <div class="center">
                    <img src="{{asset('assets/pngs/concept-of-remote-team-2112518.png')}}" class="responsive-img" alt="">
                    <div class="center">
                        <button class="btn-large waves-effect waves-light theme" style="border-radius: 30px;  margin-top:20px; margin-bottom: 20px;">Sign Up Now!</button><br><button class="btn-large waves-effect waves-light theme" style="border-radius: 30px; margin-top:20px; margin-bottom: 20px;">Log In</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
    <div class="interest-section row">
        <div class="title-section col s12 m6">
            <h3>Explore sectors you are interested in</h3>
        </div>
        <div class="sector-select-div col s12 m6">
            <div class="title">
                job sectors
            </div>
            <ul class="chip-section chip-section-1">
                <li class="chip-item active">All Sectors</li>
                <li class="chip-item">Marketing</li>
                <li class="chip-item">Programming</li>
                <li class="chip-item">Finance</li>
                <li class="chip-item">Health & Medicine</li>
                <li class="chip-item">Business</li>
                <li class="chip-item">Technology</li>
                <div class="hidden-chips hidChips-1">
                    <li class="chip-item">Food</li>
                    <li class="chip-item">Education</li>
                    <li class="chip-item">Stage Performance</li>
                    <li class="chip-item">Show Host</li>
                </div>
            </ul>
            <div class="see-more-btn see-more-btn-1" onclick="seeMore1()">
                See More
                <i class="material-icons">expand_more</i>
            </div>
        </div>
    </div>
    <div class="interest-section suggest-section row">
        <div class="title-section col s12 m6">
            <h3>Find the right job or internship for you</h3>
        </div>
        <div class="sector-select-div col s12 m6">
            <div class="title">
                suggested searches
            </div>
            <ul class="chip-section chip-section-2">
                <li class="chip-item active">All Sectors</li>
                <li class="chip-item">Marketing</li>
                <li class="chip-item">Programming</li>
                <li class="chip-item">Finance</li>
                <li class="chip-item">Health</li>
                <li class="chip-item">Business</li>
                <li class="chip-item">Technology</li>
                <div class="hidden-chips hidChips-2">
                    <li class="chip-item">Food</li>
                    <li class="chip-item">Education</li>
                    <li class="chip-item">Stage Performance</li>
                    <li class="chip-item">Show Host</li>
                </div>
            </ul>
            <div class="see-more-btn see-more-btn-2" onclick="seeMore2()">
                See More
                <i class="material-icons">expand_more</i>
            </div>
        </div>
    </div>
    <div class="interest-section post-section row">
        <div class="title-section col s12 m6">
            <h3>Post your job for millions of people to see</h3>
        </div>
        <div class="sector-select-div col s12 m6">
            <ul class="chip-section jp">
                <li class="chip-item active">Post a Job</li>
            </ul>
        </div>
    </div>

<div class="about-slider">
    <div class="slide-nav">
        <span class="prev-slide" onclick="plusSlides(-1)">
            <i class="material-icons">arrow_back_ios</i>
            Previous
        </span>
        <span class="next-slide" onclick="plusSlides(1)">
            Next
            <i class="material-icons">arrow_forward_ios</i>
        </span>
    </div>
    <div class="slide-items">
        <div class="slide-item active fade">
            <div class="slide-info">
                <h2>Let the right people know you're open to work</h2>
                <p>With the Open To Work feature, you can privately tell recruiters or publicly share with the LinkedIn community that you are looking for new job opportunities.</p>
            </div>
            <div class="slide-img">
                <img src="{{asset('assets/pngs/company.png')}}">
            </div>
        </div>
        <div class="slide-item fade">
            <div class="slide-info">
                <h2>Hire the candidates you find worthy for your vacancy</h2>
                <p>With the Open To Work feature, you can privately tell recruiters or publicly share with the LinkedIn community that you are looking for new job opportunities.</p>
            </div>
            <div class="slide-img">
                <img src="{{asset('assets/pngs/candidate.png')}}">
            </div>
        </div>
    </div>
</div>
<div class="sign-up-div">
    <h2>Find your ideal Employee, or your dream Job.</h2>
    <a href="#">
        <button class="sign-up-link">Get Started</button>
    </a>
</div>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("slide-item");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].classList.remove('active');
        }
        slides[slideIndex-1].classList.add("active");
    }

    var seeMoreBtn2 = document.querySelector('.see-more-btn-2');
    var chipItem2 = document.querySelector('.hidChips-2');
    function seeMore2(){
        chipItem2.classList.toggle('show-chips')
        if(chipItem2.classList.contains('show-chips')){
            seeMoreBtn2.innerHTML = "Show Less<i class='material-icons'>expand_less</i>"
        }
        else{
            seeMoreBtn2.innerHTML = "Show More<i class='material-icons'>expand_more</i>"
        }
    }

    var seeMoreBtn1 = document.querySelector('.see-more-btn-1');
    var chipItem1 = document.querySelector('.hidChips-1');
    function seeMore1(){
        chipItem1.classList.toggle('show-chips')
        if(chipItem1.classList.contains('show-chips')){
            seeMoreBtn1.innerHTML = "Show Less<i class='material-icons'>expand_less</i>"
        }
        else{
            seeMoreBtn1.innerHTML = "Show More<i class='material-icons'>expand_more</i>"
        }
    }
</script> 
@endsection
