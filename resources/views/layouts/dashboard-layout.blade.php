@extends('layouts.base-layout')

@section('base_head')
    <link rel="stylesheet" href="{{ asset('dist/css/_app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('image/catalog/urban.png') }}" /> --}}
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('style/img/pbl.png') }}" /> --}}
@endsection

@section('base_body')
    <div>
        @if (session()->has('alert'))
            @include('fragments.alert')
        @endif
        @if (session()->has('error'))
            @include('fragments.error')
        @endif
        @if (session()->has('success'))
            @include('fragments.success')
        @endif
        @yield('body')
        <div class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
            <div class="flex  overflow-hidden">
                <!-- BEGIN: Mobile Menu -->
                @include('fragments.dashboard-mobile-menu-fragment')
                <!-- END: Mobile Menu -->
                <!-- BEGIN: Side Menu -->
                @include('fragments.dashboard-sidebar-fragment')
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content mt-[4.7rem] md:mt-0">
                    <!-- BEGIN: Top Bar -->
                    @include('fragments.dashboard-topbar-fragment')
                    <!-- END: Top Bar -->
                    @include('fragments.dashboard-content-fragment')
                </div>
                <!-- END: Content -->
            </div>
            <!-- BEGIN: JS Assets-->
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
        </div>
    </div>
@endsection
@section('base_script')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <script src="https://cdn.tiny.cloud/1/1cwcv7fb2ka7wchr47abco6ychaqqw5fpjdp5ssh1ea863qp/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    @yield('script')
@endsection

