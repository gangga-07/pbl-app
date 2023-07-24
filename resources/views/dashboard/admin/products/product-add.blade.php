@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <!-- BEGIN: Content -->
    <div class="content">
        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Add New Product
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <form action="{{ route('manage_product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="intro-y box p-5">
                        <div>
                            <label for="name" class="form-label">Name</label>
                            @error('name')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="name" name="name" type="text" class="form-control"
                                placeholder="Input product name" value="{{ old('name') }}">
                        </div>
                        <div class="mt-3">
                            <label for="category_id" class="form-label mt-2">Category</label>
                            @error('category_id')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <select name="category_id" id="category_id" data-placeholder="Choose Product Category"
                                class="tom-select w-full">
                                <option value="0">None</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ old('category_id')==$item->id?'selected':null }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="product_code" class="form-label mt-2">Product Code</label>
                            @error('product_code')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror

                            <input id="product_code" name="product_code" type="text" class="form-control"
                                placeholder="Input Product Code" value="{{old('product_code')}}" >
                        </div>
                        <div class="mt-3">
                            <label for="price" class="form-label mt-2">Price</label>
                            @error('price')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="price" name="price" type="text" class="form-control"
                                placeholder="Input Product Price (Rp)" value="{{ old('price') }}">
                        </div>
                        <div class="mt-3">
                            <label for="stock" class="form-label mt-2">Stock</label>
                            @error('stock')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input type="number" name="stock" id="stock" class="form-control"
                                placeholder="Input Product Stock" value="{{ old('stock') }}">
                        </div>
                        <div class="mt-3">
                            <label for="youtube_url" class="form-label">YouTube URL</label>
                            @error('youtube_url')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <input id="youtube_url" name="youtube_url" type="text" class="form-control"
                                placeholder="Input YouTube URL" value="{{ old('youtube_url') }}">
                        </div>
                        <div class="mt-3">
                            <label for="description" class="form-label">Description</label>
                            @error('description')
                                <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                            @enderror
                            <textarea id="description" name="description" placeholder="Input Product Description">{{ old('description')??''}}</textarea>
                        </div>
                        <div class="upload__box mt-3">
                            @error('images[]')
                                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                            @enderror
                            <div class="upload__btn-box">
                                <label class="upload__btn btn btn-primary">
                                    <p>Choose An Image</p>
                                    <input type="file" name="images[]" multiple data-max_length="20"
                                        class="upload__inputfile">
                                </label>
                            </div>
                            <div class="upload__img-wrap"></div>
                        </div>
                        <div class="text-right mt-5">
                            <a href="{{ route('manage_product.all') }}"
                                class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
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
