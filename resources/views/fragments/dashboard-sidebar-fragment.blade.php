<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4 mt-3">
        <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}"/>
        <span class="hidden xl:block text-white text-lg ml-3"> PBL | APP </span> 
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        {{-- kalo admin maka muncul menu ini --}}
        @if (Auth::user()->role_id == 1)
        <li>
            <a href="{{ route('dashboard') }}" class="side-menu {{ Request::is('dashboard') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="home"></i></div>
                <div class="side-menu__title">
                    Dashboard
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('manage_category.all') }}" class="side-menu {{ Request::is('dashboard/categories') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="layout-grid"></i></div>
                <div class="side-menu__title">
                    Categories
                </div>
            </a>
        </li>

        <li>
            <a href="{{ route('manage_product.all') }}" class="side-menu {{ Request::is('dashboard/products') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="package"></i></div>
                <div class="side-menu__title">
                    Products
                </div>
            </a>
        </li>

        <li>
            <a href="{{ route('manage_user.all') }}" class="side-menu {{ Request::is('dashboard/users') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="users"></i></div>
                <div class="side-menu__title"> Users </div>
            </a>
        </li>
        <li>
            <a href="{{ route('manage_order.all') }}" class="side-menu {{Request::is('/dashboard/all-order') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><i data-lucide="clipboard-list"></i></div>
                <div class="side-menu__title"> Orders </div>
            </a>
        </li>
       
        {{-- <li>
            <a href="{{ route('manage_order.all') }}" class="side-menu side-menu">
                <div class="side-menu__icon"><i data-lucide="clipboard-list"></i></div>
                <div class="side-menu__title">
                    Orders
                </div>
            </a>
        </li> --}}

        {{-- kalo bukan admin maka muncul menu ini aja --}}
        @else
        <li>
            <a href="{{ route('my-account') }}" class="side-menu {{ Request::is('my-account') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="users"></i></div>
                <div class="side-menu__title"> Users </div>
            </a>
        </li>
        <li>
            <a href="{{ route('cartall') }}" class="side-menu side-menu {{ Request::is('cartall') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="shopping-cart"></i></div>
                <div class="side-menu__title">
                    Carts
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('allWhislist') }}" class="side-menu side-menu {{ Request::is('whislist-all') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="heart"></i></div>
                <div class="side-menu__title">
                    Wishlists
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('manage_my_order.all') }}" class="side-menu {{Request::is('frontpage/my-all-order') ? 'side-menu--active' : ''}}">
                <div class="side-menu__icon"><i data-lucide="clipboard-list"></i></div>
                <div class="side-menu__title">My Orders </div>
            </a>
        </li>
        @endif
        
        
        
       

    </ul>
</nav>
<!-- END: Side Menu -->