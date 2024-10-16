<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('images/favicon-32x32.png')}}" type="image/png" />
    <!-- loader-->
    <link href="{{asset('css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/icons.css')}}" rel="stylesheet">
    <title>Shubhastu</title>
</head>

<body class="bg-lock-screen">
    <!-- wrapper -->
    <form method="POST" action="{{route('marketing_login_submit')}}" >
       {{csrf_field()}}
    <div class="wrapper">
        <div class="authentication-lock-screen d-flex align-items-center justify-content-center" style="margin-top:5%">
            <div class="card shadow-none bg-transparent">
                <div class="card-body p-md-5 text-center">
                    <div style="text-align: center; ">
                        <img src="{{asset('images/logo-shubh (1).png')}}" class="" alt="" />
                    </div>
                    <div class="">
                        <img src="{{asset('images/icons/user.png')}}" class="mt-5" width="120" alt="" />
                    </div>
                    <p class="mt-2 text-white">Administrator</p>
                    <div class="mb-3 mt-3">
                       <input type="text" name="username" class="form-control" placeholder="username" />
                   </div>
                   <div class="mb-3 mt-3" id="show_hide_password">
                   <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Password" />
                   </div>
                   <div class="d-grid">
                       <button type="submit" class="btn btn-white">Login</button>
                   </div>
                </div>

            
            </div>

        
        </div>

    </div>
    </form>
    
    <div class="page-content " style="margin-top: 2%;">
        <div class="row">
            <div class="col-md-4">		
                <h5 style="margin-left: 2%;"><a> <img src="{{asset('images/llogo.png')}}" alt="plyastore"></a></h5>		
        

            </div>
            <div class="col-md-4" >				
                <h5 style="margin-left: 16%;"><a   href="https://webmediaindia.com/"><img src="{{asset('images/mlogo.png')}}"></a></h5>	
            </div>
            <div class="col-md-4">
                <h5 style="margin-left:11%;"><a  href="https://webmediaindia.com/"><img src="{{asset('images/flogo.png')}}"></a></h5>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
</body>


</html>