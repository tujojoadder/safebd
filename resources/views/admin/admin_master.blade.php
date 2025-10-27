<!doctype html>
<html lang="en">
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8"/>
   <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
   <meta name="description" content=""/>
   <meta name="author" content=""/>
   <title>Admin Dashboard</title>
   <!--favicon-->
   <link rel="icon" href="{{asset('backend/assets/images/favicon-32x32.png ') }}" type="image/png" />
   <!--plugins-->
   <link href="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css ') }}" rel="stylesheet"/>
   <link href="{{asset('backend/assets/plugins/simplebar/css/simplebar.css ') }}" rel="stylesheet" />
   <link href="{{asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css ') }}" rel="stylesheet" />
   <link href="{{asset('backend/assets/plugins/metismenu/css/metisMenu.min.css ') }}" rel="stylesheet" />
   <link href="{{asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css ')}}" rel="stylesheet" />
   <!-- Bootstrap CSS -->
   <link href="{{asset('backend/assets/css/bootstrap.min.css ') }}" rel="stylesheet">
   <link href="{{asset('backend/assets/css/bootstrap-extended.css ') }}" rel="stylesheet">
   <link href="{{asset('backend/assets/css/bootstrap-extended.css ') }}" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
   <link href="{{asset('backend/assets/css/app.css ')}}" rel="stylesheet">
   <link href="{{asset('backend/assets/css/icons.css ')}}" rel="stylesheet">

    <!-- bootstrap tags input css -->
    <link href="{{asset('backend/assets/plugins/input-tags/css/tagsinput.css ')}}" rel="stylesheet" />

   <!-- select2 css -->
   <link href="{{asset('backend/assets/plugins/select2/css/select2.min.css ')}}" rel="stylesheet" />
   <link href="{{asset('backend/assets/plugins/select2/css/select2-bootstrap4.css ')}}" rel="stylesheet" />

   <!-- Drag-And-Drop -->
   <link href="{{asset('backend/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css ') }}" rel="stylesheet" />

   <!-- Toastr css -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

   <!-- front awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Data Range CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body class="bg-theme bg-theme1">
   <!--wrapper-->
   <div class="wrapper">
      <!--sidebar wrapper -->
      @include('admin.body.sidebar')
      <!--end sidebar wrapper -->

      <!--start header -->
      @include('admin.body.header')
      <!--end header -->
      <!--start page wrapper -->
      @yield('admin')
      <!--end page wrapper -->
      <!--start overlay-->
      <div class="overlay toggle-icon"></div>
      <!--end overlay-->
      <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
      <!--End Back To Top Button-->
      @include('admin.body.footer')
   </div>
   <!--end wrapper-->
   <!--start switcher-->
   <div class="switcher-wrapper">
      <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
      </div>
      <div class="switcher-body">
         <div class="d-flex align-items-center">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
         </div>
         <hr/>
         <p class="mb-0">Gaussian Texture</p>
           <hr>
           
           <ul class="switcher">
            <li id="theme1"></li>
            <li id="theme2"></li>
            <li id="theme3"></li>
            <li id="theme4"></li>
            <li id="theme5"></li>
            <li id="theme6"></li>
           </ul>
               <hr>
           <p class="mb-0">Gradient Background</p>
           <hr>
           
           <ul class="switcher">
            <li id="theme7"></li>
            <li id="theme8"></li>
            <li id="theme9"></li>
            <li id="theme10"></li>
            <li id="theme11"></li>
            <li id="theme12"></li>
            <li id="theme13"></li>
            <li id="theme14"></li>
            <li id="theme15"></li>
           </ul>
      </div>
   </div>
   <!--end switcher-->

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!-- Bootstrap JS -->
   <script src="{{asset('backend/assets/js/bootstrap.bundle.min.js ')}}"></script>

    <!-- bootstrap tags input js -->
    <script src="{{asset('backend/assets/plugins/input-tags/js/tagsinput.js ')}}"></script>
   <!--plugins-->
   <script src="{{asset('backend/assets/js/jquery.min.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/simplebar/js/simplebar.min.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/metismenu/js/metisMenu.min.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/chartjs/chart.min.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/jquery-knob/excanvas.js ')}}"></script>
   <script src="{{asset('backend/assets/plugins/jquery-knob/jquery.knob.js ')}}"></script>
     <script>
        $(function() {
           $(".knob").knob();
        });
     </script>

   <script src="{{asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js ') }}"></script>
   <script src="{{asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js ') }}"></script>

    <script src="{{asset('backend/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js ') }}"></script>
    <script>
        $(document).ready(function () {
            $('#image-uploadify').imageuploadify();
        })
    </script>

   <script src="{{asset('backend/assets/plugins/select2/js/select2.min.js ')}}"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
   
   <script>
     $(document).ready(function() {
     $('#example').DataTable()
   });
     
   </script>

   <script src="{{asset('backend/assets/js/index.js ')}}"></script>
   <!--app JS-->
   <script src="{{asset('backend/assets/js/app.js ')}}"></script>

    <!-- Data Range -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

   <!-- Toastr js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


   <!-- all toastr message show  Update-->
   <script>
       @if(Session::has('message'))
       var type = "{{ Session::get('alert-type','info') }}"
       switch(type){
           case 'info':
           toastr.info(" {{ Session::get('message') }} ");
           break;

           case 'success':
           toastr.success(" {{ Session::get('message') }} ");
           break;

           case 'warning':
           toastr.warning(" {{ Session::get('message') }} ");
           break;

           case 'error':
           toastr.error(" {{ Session::get('message') }} ");
           break;
       }
       @endif
   </script>

   <!-- all toastr message show  old-->
   <script type="text/javascript">
        @if(Session::has('success'))
          toastr.success("{{Session::get('success')}}");
        @endif
        @if(Session::has('info'))
          toastr.info("{{Session::get('info')}}");
        @endif
        @if(Session::has('warning'))
          toastr.warning("{{Session::get('warning')}}");
        @endif
        @if(Session::has('error'))
          toastr.info("{{Session::get('error')}}");
        @endif
        @if(Session::has('danger'))
          toastr.danger("{{Session::get('danger')}}");
        @endif
    </script>
      
   <!-- sweetalerat link -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <!-- sweetalerat delete data -->
   <script type="text/javascript">
     $(function(){
         $(document).on('click','#delete',function(e){
           e.preventDefault();
           var link = $(this).attr("href");

           Swal.fire({
           title: 'Are you sure?',
           text: "Delete This Data!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
         if (result.isConfirmed) {
             window.location.href = link
             Swal.fire(
               'Deleted!',
               'Your file has been deleted.',
               'success'
             )
           }
         })
       });
     });
   </script>

   @stack('footer-script')
   
</body>

</html>