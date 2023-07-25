@extends('layouts.base-layout')
@section('base_head')
    <link rel="stylesheet" href="{{ asset('dist/css/_app.css') }}">
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('image/catalog/urban.png') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <style>
        /* CSS untuk mematikan efek hover */
        .btn.btn-outline-secondary {
            background-color: #34D399; /* Warna hijau */
            color: white;
        }
        .btn.btn-outline-secondary:hover {
            background-color: #34D399; /* Warna hijau tetap sama saat dihover */
            color: white;
        }
    </style>
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
                        <div class="-intro-x text-white font-medium text-3xl leading-tight mt-10">
                            A few more clicks to
                            <br>
                            forgot password to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your
                            PBL-STORE accounts in one place
                        </div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <form method="POST" action="{{ route('password.update') }}" method="post">>
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                                Reset Password
                            </h2>
                            <div class="intro-x mt-8">
                                <div class="mt-4">
                                    <input type="email" id="email" name="email" class="intro-x form-control py-3 px-4"
                                        placeholder="Email" required>
                                    @error('email')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <input type="password" for='password' name="password" id="password" class="intro-x form-control py-3 px-4"
                                        placeholder="New Password" required>
                                    @error('password')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <input type="password" for="password_confirmation" name="password_confirmation" id="password_confirmation" class="intro-x form-control py-3 px-4"
                                        placeholder="Password" required>
                                    @error('password_confirmation')
                                        <small class="text-xs text-red-500 ml-1 mt-1">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <form class="flex flex-col xl:flex-row items-center xl:items-start">
                                    <button type="submit" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-auto mt-3 xl:mt-0 align-top">
                                        Reset Password
                                    </button>
                                </form>
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