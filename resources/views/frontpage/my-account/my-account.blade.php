@extends('layouts.dashboard-layout')
@section('dashboard-content')
<!-- BEGIN: Content -->
<div class="content">
    <!-- END: Top Bar -->
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Detail Account
        </h2>
        <ul class="breadcrumb mt-2">
            <li><a href="{{ route('main') }}"><i class="fa fa-home mr-1"></i></a></li>
            <li>
                <p>Home</p>
            </li>
        </ul>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{route ('profile.update',['user'=>$user])}}" class="btn btn-primary shadow-md mr-2">Update My Account</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box p-8">
                <div class="md:flex md:flex-row gap-5">
                    <div class="md:flex-shrink-0 basis-10/12">
                        <div class="flex flex-row gap-2">
                            <label for="name" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Full Name</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $user->name }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="email" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Email</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $user->email }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="no_tlp" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Phone</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $user->phone }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="tanggal" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Address</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $user->address }}</p>
                        </div>
                        <div class="flex flex-row flex-none gap-2">
                            <label for="category" class="basis-1/3 capitalize tracking-wide text-sm text-black font-semibold mb-2">Created Date</label>
                            <p class="basis-2/3 text-sm mb-2">: {{ $user->created_at}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content -->
@endsection
@section('script')
<script src="{{ asset('dist/js/view/manage-product/product.js') }}"></script>
<script>
    jQuery(document).ready(function () {
    productImages();
});
</script>
@endsection