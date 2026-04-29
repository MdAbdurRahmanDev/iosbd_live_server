@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<aside class="navbar-aside bg-primary" id="offcanvas_aside">
    <div class="aside-top">
        <a href="{{ route('admin.dashboard') }}" class="brand-wrap">
            @php
                $logo = get_setting('site_footer_logo');
            @endphp
            @if($logo != null)
                <img src="{{ asset(get_setting('site_footer_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}"  style="height: 30px !important; width: 100px !important; min-width: 100px !important;">
            @else
                <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" style="height: 30px !important; width: 80px !important; min-width: 80px !important;">
            @endif
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="fa fa-arrow-left text-white"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ ($route == 'admin.dashboard')? 'active':'' }}">
                <a class="menu-link" href="{{ route('admin.dashboard') }}">
                   <i class="fa-solid fa-house fontawesome_icon_custom"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item has-submenu
                {{ ($prefix == 'admin/product') || ($prefix == 'admin/category') || ($route == 'attribute.index') || ($prefix == 'admin/brand') ? 'active' : '' }}
            ">
                    <a class="menu-link" href="#">
                        <i class="fa-solid fa-cart-shopping fontawesome_icon_custom"></i>
                        <span class="text">Products</span>
                    </a>
                <div class="submenu">
                        <a class="{{ ($route == 'product.add') ? 'active':'' }}" href="{{ route('product.add') }}">Product Add</a>
                        <a class="{{ ($route == 'product.all') ? 'active':'' }}" href="{{ route('product.all') }}">Products</a>
{{--                        <a class="{{ ($prefix == 'admin/category') ? 'active':'' }}" href="{{ route('category.index') }}">Categories</a>--}}
{{--                        <a class="{{ ($route == 'attribute.index') ? 'active':'' }}" href="{{ route('attribute.index') }}">Attributes</a>--}}
{{--                        <a class="{{ ($prefix == 'admin/brand') ? 'active':'' }}" href="{{ route('brand.all') }}">Brands</a>--}}
                </div>
            </li>

            <li class="menu-item has-submenu {{ ($prefix == 'admin/supplier')?'active':'' }}">
                    <a class="menu-link" href="#">
                        <i class="fas fa-truck fontawesome_icon_custom"></i>
                        <span class="text">Suppliers</span>
                    </a>
                <div class="submenu">
                        <a class="{{ ($route == 'supplier.all') ? 'active':'' }}" href="{{ route('supplier.all') }}">Supplier List</a>
                        <a class="{{ ($route == 'supplier.create') ? 'active':'' }}" href="{{ route('supplier.create') }}">Supplier Add</a>
                </div>
            </li>
            <li class="menu-item has-submenu
                {{ ($route == 'sales.report')? 'active':'' }}
            ">
                <a class="menu-link" href="#">
                    <i class="fas fa-bag-shopping fontawesome_icon_custom"></i>
                    <span class="text">Orders</span>
                </a>

                <div class="submenu">
                    <a class="{{ ($route == 'sales.report') ? 'active':'' }}" href="{{ route('sales.report') }}">Sales Report</a>
                </div>
            </li>
            <li class="menu-item has-submenu {{ ($route == 'return-request.all')?'active':'' }}">
                @if(Auth::guard('admin')->user()->role == '2')
                    <a class="menu-link" href="#">
                        <i class="fas fa-exchange fontawesome_icon_custom"></i>
                        <span class="text">Return Requests</span>
                    </a>
                @endif
                <div class="submenu">
                    @if(Auth::guard('admin')->user()->role == '2')
                        <a class="{{ ($route == 'return-request.all') ? 'active':'' }}" href="{{ route('return-request.all') }}" >All Requests</a>
                    @endif
                </div>
            </li>
            <li class="menu-item has-submenu
                {{ ($route == 'stock_report.index')? 'active':'' }}
{{--                {{ ($route == 'sales.report')? 'active':'' }}--}}
            ">
                <a class="menu-link" href="#">
                   <i class="fas fa-file-text fontawesome_icon_custom"></i>
                    <span class="text">Report</span>
                </a>

                <div class="submenu">
                    <a class="{{ ($route == 'stock_report.index') ? 'active':'' }}" href="{{ route('stock_report.index') }}">Product Stock</a>
{{--                    <a class="{{ ($route == 'sales.report') ? 'active':'' }}" href="{{ route('sales.report') }}">Sales Report</a>--}}
                </div>
            </li>

            <li class="menu-item has-submenu

                        {{ ($route == 'withdraw-requests.index')? 'active':'' }}
                        {{ ($route == 'withdraw-requests.create')? 'active':'' }}
                        {{ ($route == 'transaction.index')? 'active':'' }}">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-attach_money"></i>
                    <span class="text">Vendor Accounts</span>
                </a>
                <div class="submenu">
                    <a class="{{ ($route == 'withdraw-requests.index') ? 'active':'' }}" href="{{ route('withdraw-requests.index') }}">Withdrawal Requests</a>
                    <a class="{{ ($route == 'withdraw-requests.create') ? 'active':'' }}" href="{{ route('withdraw-requests.create') }}">Add Withdrawal Request</a>
                    <a class="{{ ($route == 'transaction.index') ? 'active':'' }}" href="{{ route('transaction.index') }}">View Transactions</a>
                </div>
            </li>


        </ul>
        <hr />
        <br />
        <br />
{{--        <div class="sidebar-widgets">--}}
{{--           <div class="copyright text-center m-25">--}}
{{--              <p>--}}
{{--                 <strong class="d-block">Admin Dashboard</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved--}}
{{--              </p>--}}
{{--           </div>--}}
{{--        </div>--}}
    </nav>
</aside>
