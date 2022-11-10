@extends('layouts.app')

@section('content')
<div class="container">
<style>

.box{
    width:400px;
    position:absolute;
    top:50%;
    left:50%;
    transform: translate(-50%,-50%);
    padding:50px;
    background: #FFEA00;
    border-radius: 10px;
}
.box h1{
    margin-bottom: 30px;
    color:black;
    text-align: center;
    text-transform: capitalize;
}
.box .inputBox{
    position: relative;
}

.box .inputBox input{
    width: 100%;
    padding:10px;
    font-size: 16px;
    color:black;
    letter-spacing: 1px;
    margin-bottom: 30px;
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline:none;
}
.box .inputBox label{
    position: absolute;
    top:0;
    left:0px;
    padding:10px 0;
    letter-spacing: 1px;
    font-size: 16px;
    color: black;
    transition: 0.5s;
}
.box input[type="submit"]{
    background: transparent;
    border:none;
    outline:none;
    color:black;
    background-color:#03a9f4;
    padding:8px 16px;
    border-radius: 6px;

}

.box .inputBox input:focus ~ label,
.box .inputBox input:valid ~ label{
top:-20px;
left:0;
color:black;
font-size: 12px;
}
#imgagepos{
    width: 150px;
    position: absolute;
    z-index: 1;
    left: 470px;
}


</style>




 <div class="main_div">
    {{-- <div id="imagepos">
         </div> --}}
       <div class="box">

        <img style="position:relative; left:70px; width:150px; border-radius:50%;" src="{{asset('Logo/Newsimg.png')}}"/>

           <div>
           <form method="POST" action="{{ route('login') }}">
@csrf
               <div class="inputBox">
               <input id="email" type="email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}"  required autocomplete="email" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                   <label>{{ __('Email Address') }}</label>
               </div>
               <div class="inputBox">
               <input id="password" type="password"  @error('password') is-invalid @enderror name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                <label>{{ __('Password') }}</label>
                </div>
                <div class="inputBox" >
                 <div id="rem">
                <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label>{{ __('Remember Me') }}</label>
                 </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                  @endif

           </form>
        </div>
       </div>
    </div>









</div>
@endsection
