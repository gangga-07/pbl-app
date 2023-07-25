{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PBL | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    .main{
        height: 100vh;
        box-sizing: border-box;
    }
    .login-box{
        width: 500px;
        border: solid 1px; 
        padding: 30px
    }
    form div{
        margin-bottom: 15px;
    }
</style>
<body>
    
    <div class="main d-flex flex-column justify-content-center align-items-center">
        @if (session('status'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
            
        @endif
        <div class="login-box">
            <form action="" method="post">
                @csrf
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required> 
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>
                <div class="text-center">
                    <a href="register">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html> --}}


@extends('layouts.base-layout')
@section('base_head')
    <link rel="stylesheet" href="{{ asset('dist/css/_app.css') }}">
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('image/catalog/urban.png') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
@endsection
@section('base_body')
    <div class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        {{-- <img alt="" class="w-40" src="{{ asset('/image/catalog/urban.png') }}"> --}}
                    </a>
                    <div class="my-auto">
                        <img alt="" class="-intro-x w-1/2 -mt-16" src="dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to
                            <br>
                            sign in to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your
                            PBL-STORE accounts in one place</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                                Sign In
                            </h2>
                            <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to
                                your account. Manage all your PBL-STORE accounts in one place</div>
                            <div class="intro-x mt-8">
                                <div class="mt-4">
                                    <input type="email" name="email" class="intro-x form-control py-3 px-4"
                                        placeholder="Email">
                                    @error('email')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <input type="password" name="password" class="intro-x form-control py-3 px-4"
                                        placeholder="Password">
                                    @error('password')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                @if (session('status'))
                                <div class="mt-4 alert alert-danger">
                                    {{session('message')}}
                                </div>
                                    
                                @endif
                            </div>
                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                                {{-- <div class="flex items-center mr-auto">
                                    <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                </div> --}}
                                <a href="{{route ('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit"
                                    class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Login</button>
                                <a href='register'
                                    class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</a>
                            </div>
                            <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
                                By signin up, you agree to our <a class="text-primary dark:text-slate-200"
                                    href="">Terms and Conditions</a> & <a class="text-primary dark:text-slate-200"
                                    href="">Privacy Policy</a> </div>
                        </form>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
    </div>
@endsection