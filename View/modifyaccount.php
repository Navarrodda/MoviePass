<?php  include(URL_VISTA . "navbar.php"); ?>


<section class="register-account"> 
  <div class="container">
    <script type="text/javascript">
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
    <div class="centerin">
      <div class="row">
        <div class="col-md-12">
          <div class="headit">
            <h3 style="color:white">Modify your account</h3>
            <h4>No need to fill in all fields</h4>
          </div>
          <div class="form">

            <form class="login-form" method="post" onsubmit="return valida(this)" action="<?php echo URL ?>/user/modification_account">
              <input name="name" type="Text" value="<?=$user->getName();?>" placeholder="Name"/>
              <input name="lastname" type="Text" value="<?=$user->getLastname();?>" placeholder="Last Name"/>
              <input name="dni" type="Text" value="<?=$user->getDni();?>" placeholder="DNI"/>
              <input name="nikname" type="Text" value="<?=$user->getNikname();?>" placeholder="Nikname"/>
              <input name="email" type="Email" value="<?=$user->getEmail();?>" placeholder="Email"/> 
              <input required name="pass" id="pass"  value="<?=$user->getPassword();?>" type="password" placeholder="Password"/>
              <input required name="pass2" id="pass2"  value="<?=$user->getPassword();?>" type="password" placeholder="Confirm password"/>    
              <input class="subbt" type="submit" value="Sign In" style="border:none;"/>            
            </form>        
          </div>
        </div>
      </div>
    </div>
  </div>       
</section>