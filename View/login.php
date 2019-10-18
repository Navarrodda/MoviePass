<?php  include(URL_VISTA . "navbar.php"); ?>


 <?php if(isset($this->message)) {?>
    <div class="container">
      <h1> <?= $this->message->cartelAlert($this->message->getMessage(),$this->message->getTipo()) ?></h1>
    </div>
  <?php } ?>

  <section class="register-account"> 
      
          <div class="left"><a href="#" style="float:right;margin-right:35px;font-size: 0.9em;" class="bts-a">Don't have an account? Sign up!</a>
            <div class="bts">
              <a href="#" class="fblogin social"><i class="fa fa-facebook"></i><span>Login in with Facebook</span></a>
               <a href="#" class="twlogin social"><i class="fa fa-twitter"></i><span>Login in with Twitter</span></a>
              <a href="#" class="gplogin social"><i class="fa fa-google-plus"></i><span>Login in with Google</span></a>             
            </div>
          </div>
          <div class="right">
              <div class="headit">
                <h4>Login To Your Account</h4>
              </div>
              <div class="form">
                <form class="login-form" class="login-form" method="post" action="<?php echo URL ?>/user/login/">
                    <input name="dato" type="Text" placeholder="Email or Nikname"/>     
                    <input name="password" type="password" placeholder="Password"/>

                    <input class="subbt" type="submit" value="Sign In" style="border:none;"/>   
                </form>
                <input type="checkbox" id="remember" name="remember"><span style="color:#b6b6b6;font-size: 0.9em;"> Remember Me</span><a href="#">Forgot your password?</a>        
              </div>
          </div>       
    
  </section>