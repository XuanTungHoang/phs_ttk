
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{asset('public/admins/images/favicon.ico')}}">

        <title>TTK</title>

        <!-- App css -->
        <link href="{{asset('public/admins/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/admins/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/admins/css/style.css')}}" rel="stylesheet" type="text/css" />

        <script src="{{asset('public/admins/js/modernizr.min.js')}}"></script>

    </head>

    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>Nhóm<span> TTK</span></span></a>
                <h5 class="text-muted m-t-0 font-600">QUẢN LÍ PHÁT HÀNH SÁCH</h5>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Đăng nhập</h4>
                </div>
                <div class="p-20">
                    <form class="form-horizontal m-t-20" action="{{url('post-login')}}" method="POST">
                    <input name="_token" value="<?php echo csrf_token() ?>" type="hidden" />
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="input_name" class="form-control" type="text" required="" placeholder="Tên tài khoản">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="input_pass" class="form-control" type="password" required="" placeholder="Mật khẩu">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-custom">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Nhớ tài khoản
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Đăng nhập</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
                                <a href="reset_pass" class="text-muted"><i class="fa fa-lock m-r-5"></i> Quên mật khẩu?</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end card-box-->

            
        </div>
        <!-- end wrapper page -->



        <!-- jQuery  -->
        <script src="{{asset('public/admins/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/admins/js/popper.min.js')}}"></script>
        <script src="{{asset('public/admins/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/admins/js/detect.js')}}"></script>
        <script src="{{asset('public/admins/js/fastclick.js')}}"></script>
        <script src="{{asset('public/admins/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('public/admins/js/waves.js')}}"></script>
        <script src="{{asset('public/admins/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('public/admins/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('public/admins/js/jquery.scrollTo.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('public/admins/js/jquery.core.js')}}"></script>
        <script src="{{asset('public/admins/js/jquery.app.js')}}"></script>
	
	</body>
</html>