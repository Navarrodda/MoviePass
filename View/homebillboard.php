<section>
  <?php  include(URL_VISTA . 'navbar.php') ?>
  <div class="clear"></div>
  <section>
    <?php if(isset($this->message)) {?>
      <div class="container">
        <h1> <?= $this->message->cartelAlert($this->message->getMessage(),$this->message->getTipo()) ?></h1>
      </div>
    <?php } ?>
    <div class="clear"></div>
  </section>

</section>

<section class="product-s-display">
  <?php if(!empty($genresel)){ ?>
    <div class="container">
      <div class="row">
       <h1>Genres</h1>
       <?php foreach ($genresel as $genre) { ?>
        <div class="col-md-4">
          <div class="s_display">
            <div class="imgri">
              <a href="<?php echo URL ?>/view/billboardforgenre/<?=$genre->getId();?>">
                <img class="imgri" src="<?= $genre->getImage();?>" alt="">
              </a>
            </div>
            <h1 style="color:white"><?= $genre->getName();?></h1>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
<?php } ?>
</section>
<section>
  <div class="clear"></div>
</section>

<section>

 <div class="container">
  <div class="related-products">
    <div class="row">
      <div class="col-md-12">
       <h1>Cinema Functions</h1>
     </div>
   </div>
   <?php if(!empty($cinemas)) { 
     foreach ($cinemas as $cin) {?>
       <div class="bar">
        <h2><?= $cin->getNombre();?></h2>
        <img alt="" src="<?php echo URL ?>/img/bar.png">
      </div>
      <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
          <?php if(!empty($movies)) {
            foreach ($movies as $muv) { 
              if($muv->getCinema()->getId() == $cin->getId()) { ?>
                <div class="col-md-4">
                  <div class="product">
                    <h1><?php $fecha = date("d-m-Y", strtotime($muv->getDia())); echo $fecha?></h1>
                    <div class="s_product">
                      <img alt="" src="<?= $muv->getMovie()->getPoster();?>">
                      <div class="s_overlay"></div>
                      <h2 style="background:black; color:white"><?=$muv->getHora()?></h2>
                      <h3><?=$muv->getMovie()->getTitle() ?></h3>
                      <?php if(!empty($_SESSION)){
                        if($_SESSION["rol"] == 3) { ?>
                          <h4><a href="#"><i aria-hidden="true" class="fa fa-cart-arrow-down"></i>ADD TO CART</a></h4>
                        <?php } else { ?>
                          <h4><a href="<?php echo URL ?>/view/modifyfuction/<?=$muv->getId();?>"><i aria-hidden="true" class="fa fa-angle-double-right"></i>Modify</a></h4>
                        <?php } } else { ?>
                          <h4><a href="<?php echo URL ?>/view/login/"><i aria-hidden="true" class="fa fa-cart-arrow-down"></i>ADD TO CART</a></h4>
                        <?php  } ?>
                      </div>
                      <div class="rate">
                        <h3><?=$muv->getMovie()->getOverview()?></h3>
                        <p>   <?php  if(floor($muv->getMovie()->getVote()*5/100) <= 1) { ?>
                         <p><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                       <?php } ?>
                       <?php  if(floor($muv->getMovie()->getVote()*5/100) == 2) { ?>
                         <p><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                       <?php } ?>
                       <?php  if(floor($muv->getMovie()->getVote()*5/100) == 3) { ?>
                         <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                       <?php }?>
                       <?php  if(floor($muv->getMovie()->getVote()*5/100) == 4) { ?>
                         <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p> 
                       <?php }?>
                       <?php  if(floor($muv->getMovie()->getVote()*5/100) > 5) { ?>
                         <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i></p> 
                       <?php }?>
                       <p><span style="color:white"><i class="fa fa-pied-piper-pp" aria-hidden="true"></i><?=$muv->getMovie()->getPopularity()?></span> <span style="color:white"><i class="fa fa-comment" aria-hidden="true"></i>"<?= $muv->getMovie()->getLanguage()?>"</span> <span style="color:white"><i class="fa fa-play-circle-o" aria-hidden="true"> <?= $muv->getMovie()->getDuration()?></i></span></p>
                     </p>
                     <h5>Estimated Price: $<?= $cin->getValor_entrada(); ?></h5>
                   </div>
                 </div>

               </div>
             <?php } else { ?>
              <h3>no movies registered</h3>
            <?php } } } ?>
          </div>
          </div>
        </div>
        </div>
    <?php } } ?>
  </div>
</div>
</section>