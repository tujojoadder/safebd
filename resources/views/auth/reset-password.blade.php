@extends('layouts.frontend')
@section('content-frontend')
@section('title')
   Forgot-Password Page
@endsection
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
            <form class="ps-form--account ps-tab-root" action="{{ route('password.update') }}" method="post">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <ul class="ps-tab-list">
                    <li class="active">
                        <a href="#">Reset your password?</a>
                    </li>
                </ul>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="sign-in">
                        <div class="ps-form__content">
                            <h5>Reset password</h5>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input class="form-control" id="email" name="email" value="{{ old('email',$request->email)}}" type="email" placeholder="Enter your email" required>
                                @error('email')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <style type="text/css">
                               #match{
                                 font-size: 17px;
                                 color: red;
                                 font-weight: bold;
                                 text-align: center;
                                 padding: 0px 28px;
                               }
                            </style>
                            <span id="match" class="ml-5"></span>
                            <div class="form-group form-forgot">
                                <label for="password">Password:</label>
                                <input class="form-control pass_log_id" name="password" type="password" id="password" placeholder="Enter Password">
                                <a href="javascript:;" class="input-group-text mt-4 bg-transparent"><i class='fas fa-eye toggle-password'></i></a>
                                @error('password')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group form-forgot">
                                <label for="confirm_password">Confirm Password:</label>
                                <input class="form-control pass_log_id2" type="password" name="password_confirmation" id="confirm_password" placeholder="Enter Confirmation Password">
                                <a href="javascript:;" class="input-group-text mt-4 bg-transparent"><i class='fas fa-eye toggle-password1'></i></a>
                                @error('password_confirmation')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="ps-checkbox">
                                    <input class="form-control" type="checkbox" id="remember-me" name="remember-me" />
                                    <label for="remember-me">Rememeber me</label>
                                    <a style="float:right;" href="{{ route('login') }}">Login ?</a>
                                    <p class="mt-5">Don't have an account yet? <a href="{{ route('register') }}">Sign up here</a>
                                </div>
                            </div>
                            <div class="form-group submtit">
                                <button class="ps-btn ps-btn--fullwidth">Reset Password</button>
                            </div>
                        </div>
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

<script type="text/javascript">
  $(document).on('click', '.toggle-password1', function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      
      var input = $(".pass_log_id2");
      input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
  });
</script>

<script>
    $("#confirm_password").on("keyup", function(event) {
            var passowrd = $('#password').val();
            var confirm_pass = $('#confirm_password').val();
            if (passowrd == confirm_pass) {
                $('#match').text('Password matched !');
                $('#match').addClass('fw-bold');
                $('#match').addClass('success');
            }
            else {
                $('#match').text('Password not matched!');
                $('#match').removeClass('fw-bold');
                $('#match').addClass('text-danger');
                $('#match').removeClass('success');
                $(".userFalse").removeClass('d-none');
                $(".userTrue").addClass('d-none');
            }
    });
</script>
@endsection
