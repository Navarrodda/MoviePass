<section>
  <?php  include(URL_VISTA . 'navbar.php') ?>
  <div class="clear"></div>


</section>
<!--
<section class="product-s-display">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="s_display">
                    <img src="img/s-display.jpg" alt="">
                    <h2>MEN’S SHIRTS</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="s_display">
                   <img src="img/s-display1.jpg" alt="">
                   <h2>RUNNING SHOES</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="s_display">
                    <img src="img/s-display2.jpg" alt="">
                    <h2>MEN’S SHIRTS</h2>
                </div>
            </div>
        </div>
    </div>
</section>-->
<div class="related-products">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
           <h1>Cinema Functions</h1>
       </div>
   </div>
   <div class="row">
    <div class="col-md-12">
        <?php if(!empty($cinemas)) { 
         foreach ($cinemas as $cin) {?>
             <div class="bar">
                <h2><?= $cin->getNombre();?></h2>
                <img alt="" src="<?php echo URL ?>/img/bar.png">
            </div>
        </div>
    </div>
    <div class="product">
        <?php if(!empty($movies)) {
          foreach ($movies as $muv) { 
            if($muv->getCinema()->getId() == $cin->getId()) { ?>
                <div class="row">      
                    <div class="col-md-3">
                        <div class="s_product">
                            <img alt="" src="<?= $muv->getMovie()->getPoster();?>">
                            <div class="s_overlay"></div>
                            <h2 style="background:black; color:white"><?=$muv->getDia()?></h2>
                            <h3><?=$muv->getMovie()->getTitle() ?></h3>
                            <?php if(!empty($_SESSION)){
                              if($_SESSION["rol"] == 3) { ?>
                                <h4><i aria-hidden="true" class="fa fa-cart-arrow-down" ></i>ADD TO CART</h4>
                            <?php } else { ?>
                                <h4><i aria-hidden="true" class="fa fa-cart-arrow-down"></i>Options</h4>
                            <?php } } else { ?>
                                <h4><i aria-hidden="true" class="fa fa-cart-arrow-down"></i>ADD TO CART</h4>
                            <?php  } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rate">

                                    <h3><?=$muv->getMovie()->getOverview()?></h3>
                                    <p>   <?php  if(floor($muv->getMovie()->getVote()*5/100) < 1) { ?>
                                       <p><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                                   <?php }?>
                                   <?php  if(floor($muv->getMovie()->getVote()*5/100) == 2) { ?>
                                       <p><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                                   <?php } ?>
                                   <?php  if(floor($muv->getMovie()->getVote()*5/100) == 3) { ?>
                                       <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                                   <?php }?>
                                   <?php  if(floor($muv->getMovie()->getVote()*5/100) == 4) { ?>
                                       <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p> 
                                   <?php }?>
                                   <?php  if(floor($muv->getMovie()->getVote()*5/100) > 5) { ?>
                                       <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i></p> 
                                       <?php }?></i></span>
                                       <span style="color:white"><i class="fa fa-pied-piper-pp" aria-hidden="true"></i><?=$muv->getMovie()->getPopularity()?></span> <span style="color:white"><i class="fa fa-comment" aria-hidden="true"></i>"<?= $muv->getMovie()->getLanguage()?>"</span> <span style="color:white"><i class="fa fa-play-circle-o" aria-hidden="true"> <?= $muv->getMovie()->getDuration()?></i></span></p>
                                       <h5>Estimated Price: $<?= $cin->getValor_entrada(); ?></h5>
                                   </div>
                               </div>
                           </div>
                       </div>
                   <?php } } } else { ?>
                      <h3>no movies registered</h3>
                  <?php  }?>
              </div>
          </div>
      <?php } } ?>
  </div>
</div>
