@extends('layouts.dashboard-layout')
@section('dashboard-content')
<!-- BEGIN: Content -->
<div class="content">
    <!-- END: Top Bar -->
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update My Account
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('profile.patch',['user'=>$user]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="intro-y box p-5">
                    <div>
                        <label for="name" class="form-label">Full Name</label>
                        @error('name')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                        @enderror
                        <input id="name" name="name" type="text" class="form-control" placeholder="Input product name" value="{{old('name')??$user->name}}">
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label mt-2">Email</label>
                        @error('email')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                        @enderror
                        <input id="email" name="email" type="text" class="form-control w-full" placeholder="Input Email" value="{{old('email')??$user->email}}">
                    </div>
                    {{-- <div class="mt-3">
                        <label for="password" class="form-label mt-2">Password</label>
                        @error('password')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                        @enderror
                        <input id="password" name="password" type="text" class="form-control" placeholder="Input Password" value="{{old('password')??$user->password}}">
                    </div> --}}
                    <div class="mt-3">
                        <label for="phone" class="form-label mt-2">Phone</label>
                        @error('phone')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                        @enderror
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Input Phone" value="{{ old('phone')??$user->phone }}">
                    </div>
                    <div class="mt-3">
                        <label for="address" class="form-label mt-2">Address</label>
                        @error('address')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                        @enderror
                        <input type="text" name="address" id="address" class="form-control" placeholder="Input Address" value="{{ old('address')??$user->address }}">
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('my-account') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                        <input type="submit" value="Save" class="btn btn-outline-primary shadow-md w-24 mr-1">
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection
@section('script')
<script src="{{ asset('dist/js/view/manage-product/product.js') }}"></script>
@endsection