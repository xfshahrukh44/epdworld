<div class="col-lg-3 col-md-4">
    <div class="myaccount-tab-menu nav" role="tablist">
        <a href="{{ URL('account') }}" class="<?php echo (isset($segment[0]) and $segment[0] == 'account') ? 'active' : ''; ?>"><i class="fas fa-th"></i>
            Dashboard</a>

        {{-- @if (Auth::user()->is_seller == 1 && Auth::user()->is_approved == 1) --}}
        @if (Auth::user()->is_seller == 1)
            <a href="{{ route('productlist') }}"
                class="{{ request()->route()->getName() == 'productlist' ? 'active' : '' }}"><i class="fas fa-th"></i>
                My Product</a>

            <a href="{{ route('myorders') }}"
                class="{{ request()->route()->getName() == 'myorders' ? 'active' : '' }}"><i
                    class="fa fa-cart-arrow-down"></i>My Orders</a>

            @if (Auth::user()->is_seller == 1 && Auth::user()->slug)
                <a href="{{ route('seller-profile', ['slug' => Auth::user()->slug]) }}"
                    class="{{ request()->route()->getName() == 'seller-profile' ? 'active' : '' }}">
                    <i class="fa fa-cart-arrow-down"></i> Visit Store
                </a>
            @endif
        @endif

        <a href="{{ URL('orders') }}" class="<?php echo (isset($segment[0]) and $segment[0] == 'orders') ? 'active' : ''; ?>"><i class="fa fa-cart-arrow-down"></i> Orders
            History</a>

        <a href="{{ URL('account-detail') }}" class="<?php echo (isset($segment[0]) and $segment[0] == 'account-detail') ? 'active' : ''; ?>"><i class="fa fa-user"></i> Account Details</a>

        <a href="{{ URL('signout') }}"><i class="fas fa-arrow-circle-left"></i> Logout</a>
    </div>
</div>
