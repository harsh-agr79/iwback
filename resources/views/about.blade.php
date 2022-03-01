@extends('layout')

@section('main')
<style>
    .topbg{
       height: 20vh;
       width: 100%;
       background-position:center;
       background-size: cover;
       background-repeat: no-repeat; 
    }
    hr{
        margin: 50px 60px 20px 60px;  
        border-top: 1px solid rgb(211, 211, 211);
    }
</style>
<div class="white">
    <div class="topbg" style="background-image: url('{{asset("assets/pngs/dots1.jpg")}}') ">
    </div>
    <div class="container" style="margin-top: 10vh;">
        <div class="row">
            <div class="col s12">
                <img class="responsive-img" src="{{asset('assets/images/Main-light-transparent.png')}}" alt="">
            </div>
            <div class="col s12 center">
                <h2>About Internwheel</h2>
            </div>
            <div class="col s12 center">
                <h6 style="font-size: 20px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, maxime incidunt. Totam, numquam ipsum? Quia iusto temporibus ea asperiores! Minus.</h6>
                <hr>
            </div>
            <div class="col s12 center">
                <h2>Vision</h2>
            </div>
            <div class="col s12 center">
                <h6 style="font-size: 20px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, maxime incidunt. Totam, numquam ipsum? Quia iusto temporibus ea asperiores! Minus.</h6>
                <hr>
            </div>
            <div class="col s12 center">
                <h2>Mission</h2>
            </div>
            <div class="col s12 center">
                <h6 style="font-size: 20px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, maxime incidunt. Totam, numquam ipsum? Quia iusto temporibus ea asperiores! Minus.</h6>
                <hr>
            </div>
            <div class="col s12 center">
                <h2>Who are we?</h2>
            </div>
            <div class="col s12 center">
                <h6 style="font-size: 20px; font-weight:100;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos, maxime quisquam vel consectetur ducimus harum? Eos ad eius quasi consequuntur nulla ratione porro deserunt repellat quia natus temporibus earum veritatis, dolorum numquam fugiat voluptas velit distinctio. Corrupti facere aliquam tenetur dolores. Quae sed beatae architecto nemo veniam, minus quo dignissimos qui quas optio fugiat magni ratione hic laudantium ipsum natus exercitationem voluptatum! Officiis consequuntur hic quaerat, laboriosam consectetur laudantium mollitia earum, reiciendis iusto nemo quidem eligendi quisquam? Sequi maiores dolorem, harum ipsa quasi omnis nobis aut laudantium, earum eveniet distinctio odit repudiandae ut qui, vitae blanditiis voluptates. Commodi, ipsam ea.</h6>
            </div>
        </div>
    </div>
</div>
@endsection