@extends('layouts.frontend')
@section('content-frontend')
<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>My account</li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form class="ps-form--account ps-tab-root" action="{{ route('login') }}" method="post">
                @csrf
                <ul class="ps-tab-list">
                    <li class="active"><a href="{{ route('login') }}">Login</a></li>
                </ul>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="sign-in">
                        <div class="ps-form__content">
                            <h5>Log In Your Account</h5>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input class="form-control" id="username" name="username" type="text" placeholder="Enter Username">
                                @error('username')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group form-forgot">
                                <label for="password">Password:</label>
                                <input class="form-control pass_log_id" name="password" type="password" id="password" placeholder="Enter Password">
                                <a href="javascript:;" class="input-group-text mt-4 bg-transparent"><i class='fas fa-eye toggle-password'></i></a>
                                @error('password')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="ps-checkbox">
                                    <input class="form-control" type="checkbox" id="remember-me" name="remember-me" />
                                    <label for="remember-me">Rememeber me</label>
                                    <a style="float:right;" href="{{ route('password.request') }}">Forgot Password ?</a>
                                    <p class="mt-5">Don't have an account yet? <a href="{{ route('register') }}">Sign up here</a>
                                </div>
                            </div>
                            <div class="form-group submtit">
                                <button class="ps-btn ps-btn--fullwidth">Login</button>
                            </div>
                        </div>
                        <!-- <div class="ps-form__footer">
                            <p>Connect with:</p>
                            <ul class="ps-list--social">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript">
  $(document).on('click', '.toggle-password', function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      
      var input = $(".pass_log_id");
      input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
  });
</script>


@endsection
