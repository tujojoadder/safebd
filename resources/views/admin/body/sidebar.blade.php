@php
    $route = Route::current()->getName();
    $prefix = Request::route()->getPrefix();
@endphp
<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png ') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin Login</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (Auth::user()->can('dashboard.menu'))
            <li>
                <a href="{{ route('admin.dashobard') }}" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
        @endif
        @if (Auth::user()->can('poin-of-sales.menu'))
            <li class="
    {{ $route == 'poin-of-sales.index' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                    </div>
                    <div class="menu-title">Pos Systeam</div>
                    <span class="badge badge-inline bg-danger ml-2">Addon</span>
                </a>
                <ul>
                    <li> <a href="{{ route('poin-of-sales.index') }}"><i class="bx bx-right-arrow-alt"></i>Pos
                            Manager</a>
                    </li>
                    <li> <a href="{{ route('poin-of-sales.all.orders') }}"><i class="bx bx-right-arrow-alt"></i>Pos All
                            Orders</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('slider.menu'))
            <li
                class="
	{{ $route == 'slider.edit' ? 'mm-active' : '' }}
	{{ $route == 'slider.view' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                    </div>
                    <div class="menu-title">Slider</div>
                </a>
                <ul>
                    <li> <a href="{{ route('slider.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage Slider</a>
                    </li>
                    <li> <a href="{{ route('slider.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('product.menu'))
            <li
                class="

		{{ $route == 'product.edit' ? 'mm-active' : '' }}
		{{ $route == 'product.view' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-cart"></i>
                    </div>
                    <div class="menu-title">Products</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('product.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage Product</a>
                    </li>
                    <li>
                        <a href="{{ route('product.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('sale.order.menu'))
            <li
                class="

		{{ $route == 'order.index' ? 'mm-active' : '' }}
		{{ $route == 'order.show' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-delivery"></i>
                    </div>
                    <div class="menu-title">Sales</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('order.index') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            All Orders
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('report.menu'))
            <li
                class="

		{{ $route == 'report.view' ? 'mm-active' : '' }}
		{{ $route == 'search-by-date' ? 'mm-active' : '' }}
		{{ $route == 'search-by-month' ? 'mm-active' : '' }}
		{{ $route == 'search-by-year' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-delivery"></i>
                    </div>
                    <div class="menu-title">Manage Reports</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('report.view') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            Report View
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('stock.menu'))
            <li class="
		{{ $route == 'product.stock' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-cart"></i>
                    </div>
                    <div class="menu-title">Stock Manage</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('return_order.menu'))
            <li
                class="

		{{ $route == 'return.request' ? 'mm-active' : '' }}
		{{ $route == 'order.show' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-delivery"></i>
                    </div>
                    <div class="menu-title">Return Order</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('return.request') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            All Return Order
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('complete.return.request') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            Completed Return Order
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('review.menu'))
            <li
                class="

		{{ $route == 'pending.review' ? 'mm-active' : '' }}
		{{ $route == 'blog.view' ? 'mm-active' : '' }}

	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-react"></i>
                    </div>
                    <div class="menu-title">Review</div>
                </a>
                <ul>
                    <li> <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending
                            Review</a>
                    </li>
                    <li> <a href="{{ route('publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish
                            Review</a>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('subscribe.menu'))
            <li class="

		{{ $route == 'subscribe.index' ? 'mm-active' : '' }}

	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="menu-title">Subscribe</div>
                </a>
                <ul>
                    <li> <a href="{{ route('subscribe.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Subscribe</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('brand.menu'))
            <li
                class="

		{{ $route == 'brand.edit' ? 'mm-active' : '' }}
		{{ $route == 'brand.view' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-coffee-cup"></i>
                    </div>
                    <div class="menu-title">Brand</div>
                </a>
                <ul>
                    <li> <a href="{{ route('brand.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage Brand</a>
                    </li>
                    <li> <a href="{{ route('brand.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('category.menu'))
            <li
                class="

	  {{ $route == 'category.edit' ? 'mm-active' : '' }}
    {{ $route == 'category.view' ? 'mm-active' : '' }}
    {{ $route == 'subcategory.edit' ? 'mm-active' : '' }}
    {{ $route == 'subcategory.view' ? 'mm-active' : '' }}
    {{ $route == 'subsubcategory.edit' ? 'mm-active' : '' }}
    {{ $route == 'subsubcategory.view' ? 'mm-active' : '' }}

	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-codepen"></i>
                    </div>
                    <div class="menu-title">Category</div>
                </a>
                <ul>
                    <li><a href="{{ route('category.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Category</a>
                    </li>
                    <li><a href="{{ route('category.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            Category</a>
                    <li><a href="{{ route('subcategory.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            SubCategory</a>
                    <li> <a href="{{ route('subcategory.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            SubCategory</a>
                    <li> <a href="{{ route('subsubcategory.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            SubSubCategory</a>
                    <li> <a href="{{ route('subsubcategory.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            SubSubCategory</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('pages.menu'))
            <li
                class="

	{{ $route == 'pages.edit' ? 'mm-active' : '' }}
	{{ $route == 'pages.view' ? 'mm-active' : '' }}

	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-react"></i>
                    </div>
                    <div class="menu-title">Pages</div>
                </a>
                <ul>
                    <li> <a href="{{ route('pages.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage Pages</a>
                    </li>
                    <li> <a href="{{ route('pages.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Padges</a>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('setting.menu'))
            <li
                class="
		{{ $route == 'setting.index' ? 'mm-active' : '' }}
		{{ $route == 'admin.user.index' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cog"></i>
                    </div>
                    <div class="menu-title">Advance Setting</div>
                </a>
                <ul>
                    <li> <a href="{{ route('setting.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Setting</a>
                    </li>
                    <li> <a href="{{ route('color.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage Color</a>
                    </li>
                    <!--<li> <a href="{{ route('admin.user.index') }}"><i class="bx bx-right-arrow-alt"></i>User List</a>-->

                    <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Payment Methods</a>
                    <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Manage Seo</a>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('blog.menu'))
            <li
                class="

		{{ $route == 'blog.edit' ? 'mm-active' : '' }}
		{{ $route == 'blog.view' ? 'mm-active' : '' }}

	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cake"></i>
                    </div>
                    <div class="menu-title">Blog</div>
                </a>
                <ul>
                    <li> <a href="{{ route('blog.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage Blog</a>
                    </li>
                    <li> <a href="{{ route('blog.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Blog</a>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('banner.menu'))
            <li
                class="

		{{ $route == 'banner.edit' ? 'mm-active' : '' }}
		{{ $route == 'banner.view' ? 'mm-active' : '' }}

	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-tshirt"></i>
                    </div>
                    <div class="menu-title">Baner</div>
                </a>
                <ul>
                    <li> <a href="{{ route('banner.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage Baner</a>
                    </li>
                    <li> <a href="{{ route('banner.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Baner</a>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('country.menu'))
            <li
                class="
		{{ $route == 'admin.division.view' ? 'mm-active' : '' }}
		{{ $route == 'admin.district.view' ? 'mm-active' : '' }}
		{{ $route == 'admin.subdistrict.view' ? 'mm-active' : '' }}
		{{ $route == 'admin.union.view' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-globe"></i>
                    </div>
                    <div class="menu-title">Country Information</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.division.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Division</a>
                    </li>
                    <li> <a href="{{ route('admin.district.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            District</a>
                    </li>
                    <li> <a href="{{ route('admin.subdistrict.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Upazilla</a>
                    </li>
                    <li> <a href="{{ route('admin.union.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Union</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('permission.menu'))
            <li
                class="
		{{ $route == 'all.permission' ? 'mm-active' : '' }}
		{{ $route == 'add.permission' ? 'mm-active' : '' }}
		{{ $route == 'add.roles' ? 'mm-active' : '' }}
		{{ $route == 'all.roles' ? 'mm-active' : '' }}
		{{ $route == 'add.roles.permission' ? 'mm-active' : '' }}
		{{ $route == 'all.roles.permission' ? 'mm-active' : '' }}
	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-address-card"></i>
                    </div>
                    <div class="menu-title">Roles And Permission </div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Permission</a>
                    </li>
                    <li> <a href="{{ route('all.roles') }}"><i class="bx bx-right-arrow-alt"></i>Manage Roles</a>
                    </li>
                    <li> <a href="{{ route('add.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Add Roles
                            in Permission</a>
                    </li>
                    <li> <a href="{{ route('all.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Roles in Permission</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('setting_admin.staff'))
            <li
                class="
    {{ $route == 'staff.create' ? 'mm-active' : '' }}
    {{ $route == 'staff.index' ? 'mm-active' : '' }}
    ">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="fas fa-user"></i>
                    </div>
                    <div class="menu-title">Staffs</div>
                </a>
                <ul>
                    <li> <a href="{{ route('staff.index') }}"><i class="bx bx-right-arrow-alt"></i>Mangae Staff</a>
                    </li>
                    <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Staff permissions</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->can('coupon.menu'))
            <li
                class="

		{{ $route == 'coupon.edit' ? 'mm-active' : '' }}
		{{ $route == 'coupon.view' ? 'mm-active' : '' }}

	">
                <a href="#" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-drupal-original"></i>
                    </div>
                    <div class="menu-title">Coupon</div>
                </a>
                <ul>
                    <li> <a href="{{ route('coupon.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                            Coupon</a>
                    </li>
                    <li> <a href="{{ route('coupon.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </ul>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
