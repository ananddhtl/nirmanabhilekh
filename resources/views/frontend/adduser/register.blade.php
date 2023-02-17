<?php
if (session()->get('sessionUserId') != "") {
    redirect()->to('/')->send();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thekedar :: A complete thekka patta hishab kitab software</title>
    <link rel="icon" href="icon.png">
    <!-- Google Font: Source Sans Pro -->
    <!-- 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('Adminpanel/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('Adminpanel/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('Adminpanel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">



</head>

<body class="hold-transition sidebar-mini" style="overflow-x: hidden;">
    <div class="wrapper">
        <div class="row" style="margin-top: 130px;">
            <div class="col-md-4"></div>
            <div class="col-md-4">

                <div style="width: 100%; margin-bottom:10px; text-align: center;"> <a href="http://tukisoft.com.np/" target="_blank" style="text-align: center;"> <img height="150px;" class="responsive" src="image/thekedar.png"></a></div>

                <!-- Input addon -->

                <!-- /.card -->
                <!-- Horizontal Form -->
                <div class="card card-info">

                    <div class="card-header">
                        <h3 class="card-title">Register</h3>

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if($errors->any())
                    <div class="m-2 p-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <div class="form-control form-control is-invalid">{{$error}}</div>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{route('registerAccount')}}" method="POST" autocomplete="off">
                        @csrf
                        <div class="card-body">


                            <div class="form-group row">
                                <!-- <label for="status" class="col-sm-2 col-form-label">Name</label> -->
                                <div class="col-sm-12">
                                    <input type="search" class="form-control " autocomplete="off" name="username" id="username" placeholder="Enter Full Name" required>

                                </div>



                            </div>

                            <div class="form-group row">
                                <!-- <label for="status" class="col-sm-2 col-form-label">Email</label> -->
                                <div class="col-sm-12">
                                    <input type="search" class="form-control " autocomplete="off" name="email" id="email" placeholder="Enter Email" required>

                                </div>
                                <!-- <label for="status" class="col-sm-2 col-form-label"></label> -->

                            </div>
                            <!-- <label for="status" class="col-sm-2 col-form-label">Password</label> -->
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="password" class="form-control " autocomplete="off" name="password" id="password" placeholder="Enter Password" required>

                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-sm-4">
                                    <input type="submit" value="Create Account" class="btn btn-info float-sm-centre"></button>

                                </div>
                                <div class="col-sm-4"></div>
                            </div>
                        </div>

                </div>

                <!-- /.card-footer -->
                </form>
                <div style="margin: 10px;">
                    <div class="footer">
                        <p>© 2022 thekedar All Rights Reserved | Developed by <a href="https://http://tukisoft.com.np/" target="_blank">Tuki Soft Pvt.Ltd.</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('Adminpanel/dist/js/adminlte.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('Adminpanel/dist/js/adminlte.min.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('Adminpanel/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('Adminpanel/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('Adminpanel/dist/js/demo.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script src="{{ asset('site/js/jquery.js') }}"></script>
    <script src="{{ asset('site/js/app.js') }}"></script>

    <script src="{{ asset('site/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('site/fontawesome/js/all.js') }}"></script>
    <script src="{{ asset('site/js/script.js') }}"></script>

    <script>
        $('#modelId').modal('show');
    </script>


</body>

</html>