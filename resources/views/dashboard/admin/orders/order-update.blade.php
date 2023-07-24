@extends('layouts.dashboard-layout')

@section('dashboard-content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Update Order
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">

    <form action="{{ route('manage_order.save_update', ['order' => $order]) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" id="deleted_images" name="deleted_images">
        <div class="intro-y box p-5">
            <div>
                <label for="name" class="form-label">Pembeli</label>
                @error('pembeli')
                <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                @enderror
                <input id="pembeli" name="pembeli" type="text" class="form-control" placeholder="Input Pembeli" value="{{old('pembeli')??$order->pembeli}}">
            </div>
            <div class="mt-3">
                <label for="email" class="form-label mt-2">Email</label>
                @error('email')
                <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                @enderror
                <input id="email" name="email" type="text" class="form-control w-full" placeholder="Input email" value="{{old('email')??$order->email}}">
            </div>
            <div class="mt-3">
                <label for="name" class="form-label mt-2">Nama Produk</label>
                @error('name')
                <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                @enderror
                <input id="name" name="name" type="text" class="form-control w-full" placeholder="Input Produk" value="{{old('name')??$order->name}}">
            </div>
            <div class="mt-3">
                <label for="price" class="form-label mt-2">Harga Produk</label>
                @error('price')
                <small class="text-xs text-red-500 ml-1">{{'*'.$message }}</small>
                @enderror
                <input id="price" name="price" type="text" class="form-control w-full" placeholder="Input Harga Produk" value="{{old('price')??$order->price}}">
            </div>
            <div class="mt-3">
                <label for="tanggal" class="form-label mt-2">Tanggal Order</label>
                @error('tanggal')
                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                @enderror
                <input id="tanggal" name="tanggal" type="date" class="form-control" placeholder="Input Order tanggal" value="{{old('tanggal')??$order->tanggal}}">
            </div>
            <div class="mt-3">
                <label for="no_tlp" class="form-label mt-2">No Telepon</label>
                @error('no_tlp')
                <small class="text-xs text-red-500 ml-1">{{ '*' . $message }}</small>
                @enderror
                <input type="text" name="no_tlp" id="no_tlp" class="form-control" placeholder="Input No Telepon" value="{{ old('no_tlp')??$order->no_tlp }}">
            </div>
            <div class="text-right mt-5">
                <a href="{{ route('manage_order.all') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                <input type="submit" value="Save" class="btn btn-outline-primary shadow-md w-24 mr-1">
            </div>
        </div>
    </form>
@endsection

    </div>
</div>