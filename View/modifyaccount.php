<?php  include(URL_VISTA . "navbar.php"); ?>


<section class="register-account"> 
  <div class="container">
  <div class="centerin">
      <div class="row">
        <div class="col-md-12">
        <div class="headit">
          <h3 style="color:white">Modify your account</h3>
          <h4>No need to fill in all fields</h4>
        </div>
        <div class="form">

          <form class="login-form" method="post" action="#">
            <input name="name" type="Text" value="" placeholder="Name"/>
            <input name="lastname" type="Text" value="" placeholder="Last Name"/>
            <input name="dni" type="Text" value="" placeholder="DNI"/>
            <input name="nikname" type="Text" value="" placeholder="Nikname"/>
            <input name="email" type="Email" value="" placeholder="Email"/>     
            <input class="subbt" type="submit" value="Sign In" style="border:none;"/>            
          </form>        
        </div>
      </div>
    </div>
  </div>
  </div>       
</section>