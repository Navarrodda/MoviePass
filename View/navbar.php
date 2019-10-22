<!-- Section Navbar.
  ================================================== -->
  <header>
    <section class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <ul>
              <?php if(!empty($_SESSION["email"])){ ?>
                <li><a href="<?php echo URL ?>/view/account/">Account</a></li>
                <li><a href="#">Checkout</a></li>
                <li><a href="#">dashbord</a></li>
              <?php } ?>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="icon">
             <a><img src="<?php echo URL ?>/img/Icon/cine.png"/></a>
           </div>
         </div>
         <div class="col-md-4">
           <div class="a-right">
            <?php if(empty($_SESSION["email"])){ ?>
              <a href="<?php echo URL ?>/view/login/"><p><span><i class="fa fa-user"></i></span>Login</p></a>
              <a href="<?php echo URL ?>/view/register/"><p><span><i class="fa fa-pencil"></i></span>Register</p></a>
            <?php } else { ?>
              <a href="<?php echo URL ?>/user/logout/"><p><span><i  class="fa fa-sign-out"></i></span>Sign Out</p></a>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="clear"></div>
  </section>
  <section class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
         <div class="logo">
          <a></a>
        </div>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo URL ?>">HOME</a></li>
        <?php //if(!empty($_SESSION["rol"])){ ?>
          <?php //if($_SESSION["rol"] != 3){ ?>
            <li><a href="<?php echo URL?>/view/movies/">MOVIES</a></li>
            <?php// } } ?>
            <?php if(!empty($_SESSION["rol"])){ ?>
              <?php if($_SESSION["rol"] != 3){ ?>
                <li><a href="<?php echo URL?>/view/registrercinema/">REGISTER CINEMA</a></li>
                <li><a href="<?php echo URL ?>/view/feature/">FEATURE</a></li>
              <?php } } ?>
              <li><a href="<?php echo URL ?>/view/cinema/">CINEMAS</a></li>
            </ul>
            <?php if(!empty($_SESSION["rol"])){ ?>
              <?php if($_SESSION["rol"] == 3){ ?>
                <div class="col-md-12">
                  <div class="cart">
                    <p><i class="fa fa-cart-arrow-down"></i><sup>0</sup> &#36;&nbsp;&nbsp;0.00</p>
                  </div>
                </div>
              <?php } } ?>
            </div>
            <div class="row">
              <div class="col-md-12">
               <div class="header-part">
                <p>MOVIEPASS &nbsp;&nbsp;&nbsp;<span><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<?= $view; ?></span></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </header>
    