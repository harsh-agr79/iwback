@extends('layout')

@section('main')
    <div style="height: 100vh">
        <div class="center container">
            <div class="white z-depth-3" style="border-radius: 20px; margin-top: 20vh; padding:20px;">
                <h5><i class="material-icons red-text">warning</i>The Email ID is already in Use or <br> you cannot use it to login with google try using a different Gmail ID</h5>
                <div>
                    <a href="{{url('login')}}" class="btn theme waves-effect">Log in With A different account</a>
                    <a style="margin-top: 20px;" href="{{url('registeremployee')}}" class="btn theme waves-effect">Register with a different account as a employee</a>
                </div>
            </div>
        </div>
    </div>
@endsection