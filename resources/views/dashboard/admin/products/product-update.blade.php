@extends('layouts.dashboard-layout')
@section('dashboard-content')
@section('head')
    <style>
    .upload__img-wrap {
    display: flex;
    flex-wrap: wrap;
    margin-top: 10px;
    }

    .upload__img-box {
        position: relative;
        margin-right: 10px;
        margin-bottom: 10px;
        width: 50px; /* Ubah sesuai keinginan Anda */
        height: 50px; /* Ubah sesuai keinginan Anda */
    }

    .upload__img-item {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }

    .upload__img-close {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        font-size: 14px;
        color: #333;
    }
    </style>
@endsection
<!-- BEGIN: Content -->
<div class="content">
    <!-- END: Top Bar -->
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update Product
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            {{-- <form action="{{ route('manage_product.patch',['product'=>$product]) }}" method="POST" enctype="multipart/form-data"> --}}
            <form action="{{ route('manage_product.patch',['product'=>$product]) }}" method="POST" enctype="form-data">
                @csrf
                @method('patch')
                <input type="hidden" id="deleted_images" name="deleted_images">
                <div class="intro-y box p-5">
                    <div>
                        <label for="name" class="form-label">Name</label>
                        @error('name')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                        @enderror
                        <input id="name" name="name" type="text" class="form-control" placeholder="Input product name" value="{{old('name')??$product->name}}">
                    </div>
                    <div class="mt-3">
                        <label for="category_id" class="form-label mt-2">Category</label>
                        @error('category_id')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                        @enderror
                        <select name="category_id" id="category_id" data-placeholder="Choose Product Category" class="tom-select w-full">
                            <option value="0">None</option>
                            @foreach ($categories as $item)
                            <option value="{{$item->id}}" {{ $product->category_id==$item->id?'selected':null }}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="product_code" class="form-label mt-2">Product Code</label>
                        @error('product_code')
                        <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                        @enderror
                        <input id="product_code" name="product_code" type="text" class="form-control w-full" placeholder="Input Product Code" value="{{old('product_code')??$product->product_code}}">
                    </div>
                    <div class="mt-3">
                        <label for="price" class="form-label mt-2">Price</label>
                        @error('price')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                        @enderror
                        <input id="price" name="price" type="text" class="form-control" placeholder="Input Product Price (Rp)" value="{{old('price')??$product->price}}">
                    </div>
                    <div class="mt-3">
                        <label for="stock" class="form-label mt-2">Stock</label>
                        @error('stock')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                        @enderror
                        <input type="number" name="stock" id="stock" class="form-control" placeholder="Input Product Stock" value="{{ old('stock')??$product->stock }}">
                    </div>
                    <div class="mt-3">
                        <label for="youtube_url" class="form-label mt-2">Demo Product</label>
                        @error('youtube_url')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                        @enderror
                        <input type="text" name="youtube_url" id="youtube_url" class="form-control" placeholder="Input YouTube URL" value="{{ old('youtube_url')??$product->youtube_url }}">
                    </div>
                    <div class="mt-3">
                        <label for="description" class="form-label">Description</label>
                        @error('description')
                            <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                        @enderror
                        <textarea id="description" name="description" class="form-control w-full" placeholder="Input Product Description">{{ $product->description ?? old('description')}}</textarea>
                    </div>
                    <div class="upload__box">
                        @error('images[]')
                        <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                        @enderror
                        <div class="upload__btn-box">
                            <label class="upload__btn btn btn-primary">
                                <p>Choose An Image</p>
                                <input type="file" name="images[]" multiple data-max_length="10" class="upload__inputfile">
                            </label>
                        </div>
                        <div class="upload__img-wrap">
                            @foreach ($product->images as $item)
                            <div class='upload__img-item'>
                                <img src="{{ asset('storage/' . $item->src) }}" alt="Preview Image">
                                <span class="upload__img-remove" onclick="removeImagePreview(this)">&times;</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a href="{{ route('manage_product.all') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
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
<script>
    // Fungsi untuk menampilkan preview gambar saat update
    function showImagePreview(input) {
        if (input.files && input.files.length > 0) {
            $('.upload__img-wrap').empty();
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgItem = `<div class="upload__img-item">
                                    <img src="${e.target.result}" alt="Preview Image">
                                    <span class="upload__img-remove" onclick="removeImagePreview(this)">&times;</span>
                                </div>`;
                    $('.upload__img-wrap').append(imgItem);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    // Fungsi untuk menghapus preview gambar
    function removeImagePreview(element) {
        $(element).parent().remove();
    }

    $(document).ready(function() {
        // Panggil fungsi showImagePreview saat input file berubah
        $('.upload__inputfile').on('change', function() {
            showImagePreview(this);
        });

        // Menghapus gambar yang sudah ada
        $('.upload__img-wrap .upload__img-remove').on('click', function() {
            $(this).parent().remove();
        });
    });

</script>
@endsection