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
                <form class="ps-form--account ps-tab-root" action="{{ route('register') }}" method="post">
                    @csrf
                    <ul class="ps-tab-list">
                        <li class="active"><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="sign-in">
                            <div class="ps-form__content">
                                <h5>Register An Account</h5>

                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name">
                                    @error('name')
                                        <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                @php
                                    $random = Illuminate\Support\Str::random(6);
                                    $random_no = strtoupper($random);
                                @endphp
                                <span id="match_username" class=""></span>
                                <span id="notmatch_username" class=""></span>
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input class="form-control" id="username" name="username" type="text" placeholder="Enter Username" value="{{ $random_no }}">
                                    @error('username')
                                        <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Enter email address">
                                    @error('email')
                                        <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                
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
                                
                                <!-- <span id="match_referby" class="ml-5"></span>
                                <div class="form-group">
                                    <label for="refer_by">Refer By:</label>
                                    <input type="text" id="refer_by" class="form-control" name="refer_by" placeholder="Refer ID">
                                    @error('refer_by')
                                        <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div> -->
                                
                                <!-- <span id="match_placement_id" class="ml-5"></span>
                                <div class="form-group">
                                    <label for="placement_id">Placement Id:</label>
                                    <input type="text" id="placement_id" class="form-control" name="placement_id" value="" placeholder="Enter Placement ID">
                                    @error('placement_id')
                                        <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div> -->

                                <!-- <div class="form-group">
                                    <label>Placement:</label>
                                    <select class="form-control" name="placement" aria-label="Default select example">
                                        <option selected>Select Position</option>
                                        <option value="left" id="left_placement">Left Placment</option>
                                        <option value="right">Right Placment</option>
                                    </select>
                                </div> -->

                                <div class="form-group">
                                    <div class="ps-checkbox">
                                        <input class="form-control" type="checkbox" id="remember-me" name="remember-me" />
                                        <label for="remember-me">Rememeber me</label>
                                        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                                    </div>
                                </div>
                                <div class="form-group submtit">
                                    <button class="ps-btn ps-btn--fullwidth">Register</button>
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
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.toggle-password1', function() {

            $(this).toggleClass("fa-eye fa-eye-slash");

            var input = $(".pass_log_id2");
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
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
            } else {
                $('#match').text('Password not matched!');
                $('#match').removeClass('fw-bold');
                $('#match').addClass('text-danger');
                $('#match').removeClass('success');
                $(".userFalse").removeClass('d-none');
                $(".userTrue").addClass('d-none');
            }
        });
    </script>
    
    <!-- start ajax username check -->
    <script type="text/javascript">
          $('#username').keyup(function(){
              var username = $(this).val();
            //   alert(username);
              if(username) {
                  $.ajax({
                      url: "{{  url('check/register/refer') }}/"+username,
                      type:"GET",
                      dataType:"json",
                      success:function(success) {
                        console.log(success);
                        $('#match_username').html(success);
                      }
                    
                      
                  });
              } else {
                    alert('Please Provide Valid Information.');
              }
          });
    </script>
    <!-- end ajax username check -->
    
    <!-- start ajax refer by check -->
    <script type="text/javascript">
          $('#refer_by').keyup(function(){
              var refer_by = $(this).val();
            //   alert(refer_by);
              if(refer_by) {
                  $.ajax({
                      url: "{{  url('check/register/refer/by/user') }}/"+refer_by,
                      type:"GET",
                      dataType:"json",
                      success:function(success) {
                        // console.log(success);
                        $('#match_referby').html(success.username);
                      }
                    
                      
                  });
              } else {
                    alert('Please Provide Valid Information.');
              }
          });
    </script>
    <!-- end ajax refer by check -->
    
    <!-- start ajax placement_id  check -->
    <script type="text/javascript">
          $('#placement_id').keyup(function(){
              var placement_id = $(this).val();
            // alert(placement_id);
              if(placement_id) {
                  $.ajax({
                      url: "{{  url('check/register/placement/') }}/"+placement_id,
                      type:"GET",
                      dataType:"json",
                      success:function(success) {
                        console.log(success);
                        $('#match_placement_id').html(success);
                      }
                    
                      
                  });
              } else {
                    alert('Please Provide Valid Information.');
              }
          });
    </script>
    <!-- end ajax placement_id  check -->
@endsection
