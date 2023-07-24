@extends('layouts.dashboard-layout')
@section('dashboard-content')
<!-- BEGIN: Content -->
<div class="content">
    <!-- END: Top Bar -->
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update My Password
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form method="POST" action="{{ route('update-password') }}">
                @csrf
                <div class="intro-y box p-5">
                    <div>
                        <label for="oldPasswordInput" class="form-label">Old Password</label>
                        <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                            placeholder="Old Password">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="newPasswordInput" class="form-label">New Password</label>
                        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                            placeholder="New Password">
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                        <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                            placeholder="Confirm New Password">
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