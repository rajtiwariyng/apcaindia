<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>Apcachef Login</title>
 <!-- <link rel="icon" href="{{url('/')}}/favicon.ico" type="image/x-icon"> -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{url('/')}}/admin_assets/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('/')}}/admin_assets/css/admin.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/admin_assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="{{url('/')}}/admin_assets/Ionicons/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/admin_assets/css/AdminLTE.min.css">
  <!-- iCheck -->


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css">
  .z-depth-2{
    background: #fff;
        -webkit-box-shadow: 0 4px 5px 0 rgb(0 0 0 / 14%), 0 1px 10px 0 rgb(0 0 0 / 12%), 0 2px 4px -1px rgb(0 0 0 / 30%);
    box-shadow: 0 4px 5px 0 rgb(0 0 0 / 14%), 0 1px 10px 0 rgb(0 0 0 / 12%), 0 2px 4px -1px rgb(0 0 0 / 30%);
}
  }
  .errors{
    font-size: 14px;
  }
  .errors::-webkit-input-placeholder { /* Chrome/Opera/Safari */
   color: red !important;
  }
  .errors::-moz-placeholder { /* Firefox 19+ */
   color: red !important;
  }
  .errors:-ms-input-placeholder { /* IE 10+ */
   color: red;
  }
  .errors:-moz-placeholder { /* Firefox 18- */
   color: red !important;
  }
  .errors_selectbox
  {
   color:red !important;
  }
  .textarea-pading{
    padding-bottom: 4px !important;
  }
  .dos-comingsoon .footer-animate-logo img{
    margin: auto;
  }
</style>
</head>

<style>
  .ti-login-flexbox{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70vh;
  }
  .ti-login-flexbox .ti-login-form .form-group label{
    display: block;
  }
  .ti-login-flexbox .ti-login-form .form-group .form-control{
    padding: 3px 5px;
    height: 45px;
    border-radius: 0;
    box-shadow: none;
    font-weight: normal;
  }
  .ti-login-flexbox .ti-login-form{
    max-width: 400px;
    padding: 30px;
    
    width: 100%;
  }
  .ti-login-flexbox .ti-login-form .form-group .request-btn{
    border: 2px solid #0f53b7;
    color: #0f53b7;
    background: none;
    border-radius: 0;
    text-transform: uppercase;
    font-size: 16px;
    padding: 11px 25px;
    margin-top: 30px;
    text-align: center;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
  }
  .ti-login-flexbox .ti-login-form .form-group .request-btn button{
    background: #fff;
    text-align: center;
    border: 0;
  }
  .ti-login-flexbox .ti-login-form .form-group .request-btn:hover button{
    color: #fff;
    background: transparent;
  }
  .ti-login-flexbox .ti-login-form .form-group .request-btn:hover{
    background: #0f53b7 none repeat scroll 0 0;
    color: #ffffff;
  }
  .logo-admin{
    margin-top: 5%;
    margin-bottom: 10%;
    text-align: center;

  }
  .logo-admin img{
    width: 50%;
  }
  .mt-2{
    margin-top: 10%;
  }
  .login-admin{
    background-repeat: no-repeat;
    background-position: center;
     background-image: url("{{url('/')}}/bg-login.jpg"); 
  }
</style>
<body class="login-admin">
<div class="ti-login-main">
  <div class="container">
    <div class="ti-login-flexbox">
      <div class="ti-login-form z-depth-2 mt-2">
        <div class="logo-admin"><img src="{{url('/')}}/assets/images/logo.webp"></div>
        <form id="userloginadmin" method="POST" onsubmit="return loginFunction();" >
          {{csrf_field()}}
          <div class="form-group">
            <label for="">Email Address<span>*</span></label>
            <label for="" class="email">
            <input  type="text" class="form-control" maxlength="100" id="email" name="email" placeholder="Enter user name">

             </label>
          </div>
          <div class="form-group">
            <label for="">Password<span>*</span></label>
            <label for="" class="passowrd">
      
              <input  type="password" class="form-control" name="password" id="password" placeholder="Enter password" maxlength="100">
            </label>
          
          </div>
          <div class="form-group">
          <div id="loginerror" style="color:#ff0000;text-align: center;"></div>
            <label for="" class="ti-signin">
            <div class="request-btn hvr-sweep-to-right"><button type="submit">LOG IN</button></div>
             <!--  <a href="influencers-profile.html" class="hvr-sweep-to-right">Sign in</a>  -->
            </label>
          </div>
         
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{url('/')}}/assets/js/jquery.min.js"></script>

<script>
        function loginFunction()
        {
            var email =document.getElementById("email").value.trim();
            var strUserEml=email.toLowerCase();
            var password =document.getElementById("password").value.trim();
            var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
            var PswFilter = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;

            if(email=="")
            {
            
              $("#email").css("border", "#ff0000 solid 1px");
                document.getElementById("email").focus();
                $('#email').attr("placeholder", "Enter your email");
                $("#email").addClass( "errors" );
                return false;
            }
            else if(!filter.test(strUserEml)) 
            {
                document.getElementById('email').style.borderColor='#ff0000';
                document.getElementById("email").focus();
                $('#email').val('');
                $('#email').attr("placeholder", "Invalid E-mail");
                $("#email").addClass( "errors" );
                return false;
            }
            else
            {
                $("#email").css("border", "#eaeaea solid 1px");   
                  
            }
            if(password=="")
              {
                $("#password").css("border", "#ff0000 solid 1px");
                document.getElementById("password").focus();
                $('#password').val('');
                $('#password').attr("placeholder", "Enter password");
                $("#password").addClass( "errors" );
                return false;
              }
            else
              {
                 $("#password").css("border", "#eaeaea solid 1px");  
              }
        
      /*         var loginformdata = new FormData($('#userloginadmin')[0]);
                loginformdata.append('email', email);
                loginformdata.append('password', password);*/
                 document.getElementById("loginerror").innerHTML="<i class='fa fa-spinner fa-spin' style='font-size:24px;color: #1a4f52;'></i>";
               //  var loginformdata={'email':email,'password':password}      
          //  console.log(loginformdata);
                $.ajax({
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                  type: 'POST',
                  url: "{{ url('/admin/login_check') }}",
                  data:{'email':email,'password':password} ,
                 
                  success:function(response) 
                  {                  
                    // console.log(response);
                   var status=response.status;
                var msg=response.msg;
                if(status==200)
                {
                    $('#loginerror').css('color','green');
                  document.getElementById("loginerror").innerHTML=response.msg;
                  var path="{{url('/admin/dashboard')}}";
                  setTimeout(function() { window.location=path; }, 1000);
                            
                }
                 else if(status==401)
                {
                    $('#loginerror').css('color','red');
                    document.getElementById("loginerror").innerHTML=msg;
                }
                  else {
        
                  }
              }
        
        
            });
            
           
          return false;
        }
          
          </script>

</body>
</html>