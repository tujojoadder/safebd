<div class="ps-section__left">
    <aside class="ps-widget--account-dashboard">
        @php
            $route = Route::current()->getName();
            $prefix = Request::route()->getPrefix();
        @endphp
        @php
           $id = Auth::guard('web')->user()->id;
           $adminData = App\Models\User::where('role','user')->find($id);
        @endphp
       <div class="ps-widget__header d-block text-center">
          <img src="{{ (!empty($adminData->profile_photo)) ? url('upload/user_images/'.$adminData->profile_photo):url('upload/no_image.jpg') }}" alt="" />
          <figure>
             <figcaption>{{ $adminData->name ?? 'Null' }}</figcaption>
             <p><a href="#">{{ $adminData->phone ?? 'Null' }}</a></p>
          </figure>
       </div>
       <div class="ps-widget__content">
            <ul>
                <li class="{{ ($route == 'dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon-user"></i> Account Information</a></li>
                <li class="{{ ($route == 'user.password.change') ? 'active' : '' }}"><a href="{{ route('user.password.change') }}"><i class="icon-user"></i> Change Password</a></li>
                <li class="{{ ($route == 'user.orders.index') ? 'active' : '' }}"><a href="{{ route('user.orders.index') }}"><i class="icon-store"></i> Orders</a></li>
                <li class="{{ ($route == 'return.order.page') ? 'active' : '' }}"><a href="{{ route('return.order.page') }}"><i class="icon-alarm-ringing"></i> Reuturn Order</a></li>
                <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>
                <li><a href="{{ route('user.logout') }}"><i class="icon-power-switch"></i>Logout</a></li>
            </ul>
       </div>
    </aside>
 </div>
