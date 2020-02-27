<?php  
  include(URL_VISTA . "navbar.php");
  include("Config/faceConf.php");
?>


<section class="register-account"> 

  <div class="left"><a href="#" style="float:right;margin-right:35px;font-size: 0.9em;" class="bts-a">Don't have an account? Sign up!</a>
    <div class="bts">
      <a href="<?php echo $loginUrl; ?>" onClick="loadingFb();" class="fblogin social"><i class="fa fa-facebook"></i><span>Register with Facebook</span></a>
      <a href="#" class="twlogin social"><i class="fa fa-twitter"></i><span>Register with Twitter</span></a>
      <a href="#" class="gplogin social"><i class="fa fa-google-plus"></i><span>Register with Google</span></a>             
    </div>
  </div>
  <div class="right">
    <div class="headit">
      <h4>Login To Your Account</h4>
    </div>
    <div class="form">
      <form class="login-form" method="post" onsubmit="return valida(this)" action="<?php echo URL ?>/user/check_in/">
        <input required name="name" type="Text" value="" placeholder="Name"/>
        <input required name="lastname" type="Text" value="" placeholder="Last Name"/>
        <input required name="dni" min="1000000" max="99999999" type="number" value="" placeholder="DNI"/>
        <input required name="nikname" type="Text" value="" placeholder="Nikname"/>
        <input required name="email" type="Email" value="" placeholder="Email"/>     
        <input required name="pass" id="pass"  value="" type="password" placeholder="Password"/>
        <input required name="pass2" id="pass2"  value="" type="password" placeholder="Confirm password"/>
        <input class="subbt" type="submit" value="Sign In" style="border:none;"/>            
      </form>        
    </div>
  </div>   

   <script type="text/javascript">
        function valida(number) {
          var ok = true;
          var msg = "The fields are different:\n";
          if(number.elements["dni"].value <= 10000000)
          {
            msg += "Error the DNI contains less than the allowed characters\n";
            ok = false;
          }
          if(number.elements["dni"].value >= 99999999){
             msg += "Error the DNI contains more than the allowed characters\n";
            ok = false;
          }


          if(ok == false)
            alert(msg);
          return ok;
        }

          function valida(password) {
          var ok = true;
          var msg = "The fields are different:\n";
          if(password.elements["pass"].value != password.elements["pass2"].value)
          {
            msg += "Verify the password\n";
            ok = false;
          }


          if(ok == false)
            alert(msg);
          return ok;
        }

      </script>  


</section>