@extends('layouts.dashboard-layout')
@section('dashboard-content')
<h2 class="intro-y text-lg font-medium mt-10">
    All Product
</h2>
<div class="intro-y text-base mt-2 text-gray-600">
    Total {{ $product->total() }} products
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('manage_product.create') }}" class="btn btn-primary shadow-md mr-2">Add New Product</a>
        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center">
                    <i class="w-4 h-4" data-lucide="filter"></i>
                </span>
            </button>
            {{-- kalo mau isi scroll [overflow-scroll] --}}
            <div class="dropdown-menu w-52 h-64"> 
                <ul class="dropdown-content">
                    <li>
                        <a href="/dashboard/products" class="dropdown-item">All</a>
                    </li>
                    @foreach ($cat as $item)
                    <li>
                        <a href="/dashboard/products?category={{ $item->name }}" class="dropdown-item">{{ $item->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-slate-500"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            {{-- <div class="w-56 relative text-slate-500">
                <form action="{{ route('manage_product.all') }}" method="get" id="form-search-product">
                    @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    <button type="submit">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </button>
                </form>
            </div> --}}
        </div>
    </div>
    
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-nowrap">No.</th>
                    <th class="text-center whitespace-nowrap">CODE</th>
                    <th class="text-center whitespace-nowrap">NAME</th>
                    <th class="text-center whitespace-nowrap">PRICE</th>
                    <th class="text-center whitespace-nowrap">STOCK</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($product as $index=>$item)
                <tr class="intro-x">
                    <td class="text-center w-20">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $item->product_code }}</td>
                    <td class="text-center w-24">
                        <a href="#" class="font-medium whitespace-nowrap">{{ Str::words($item->name, 3, '...') }}</a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                            {{ $item->category->name ?? 'None' }}
                        </div>
                    </td>
                    <td class="text-center">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $item->stock }}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{ route('manage_product.detail', ['product' => $item]) }}"> <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Detail </a>
                            <a class="flex items-center mr-3" href="{{ route('manage_product.update', ['product' => $item]) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                            {{-- <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" onclick="deleteModalHandler({{ $index }})"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                            <input type="hidden" id="delete_route_{{ $index }}" value="{{ route('manage_product.delete', ['product' => $item]) }}"> --}}
                       
                            <form style="display: inline;" type="hidden" id="delete_route_{{ $index }}" method="POST" action="{{ route('manage_product.delete', ['product' => $item]) }}">
                                <button class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" onclick="deleteModalHandler({{$index}})"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>Delete</button>
                                @method('DELETE')
                                {{ csrf_field() }} 
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center text-muted" colspan="9">No Data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
   <!-- BEGIN: Pagination -->
<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
    {{ $product->links() }}
    <select class="w-20 form-select box mt-3 sm:mt-0">
        <option>10</option>
        <option>25</option>
        <option>35</option>
        <option>50</option>
    </select>
</div>
<!-- END: Pagination -->
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">
                        Do you really want to delete these records?
                        <br>
                        This process cannot be undone.
                    </div>
                </div>
                <div class="px-5 pb-8 flex justify-center items-center">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <form id="deleteItem" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="" id="delete_route_input">
                        <button type="submit" class="btn btn-danger w-24">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('dist/js/view/manage-product/product.js') }}"></script>
@endsection