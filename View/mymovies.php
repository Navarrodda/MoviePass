<section>
  <?php  include(URL_VISTA . 'navbar.php') ?>
  <div class="clear"></div>


</section>
<section class="best-seller">
  <div class="container">
   <div class="row">
    <div class="col-md-12">
      <div class="bar">
        <h2>Genres</h2>
        <img alt="" src="<?php echo URL ?>/img/bar.png">
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
</section>
<section class="t-shart-brand">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="t_shart">
         <div class="row">
           <div class="col-md-5">
             <div class="t_shart_img">
              <img src="img/t-shart-brand1.jpg" alt="">
            </div>
          </div>
          <div class="col-md-7">
           <div class="t_shart_text">
            <h2>All Brand T-sharts</h2>
            <a href="#"><p>See More</p></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<section class="best-seller">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="bar">
          <h2>Movies</h2>
          <img alt="" src="<?php echo URL ?>/img/bar.png">
        </div>
      </div>
    </div>
    <div class="best-seller-part">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <?php if(!empty($value)){ 
              foreach ($value as $data)  { ?> 
                <div class="col-md-6 fond1">
                  <div class="best-sell-part">
                   <img src="<?= $data->getBackdrop();?>">
                   <p><i class="fa fa-heart" aria-hidden="true"></i></p>
                   <h4>Select For Billboard</h4>
                 </div>
                 <div class="row">
                  <div class="col-md-12">
                    <div class="prodact-s-text">
                      <h3><?= $data->getTitle(); ?></h3>
                      <?php  if(floor($data->getVote()*5/100) < 1) { ?>
                       <p><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                     <?php }?>
                     <?php  if(floor($data->getVote()*5/100) == 2) { ?>
                       <p><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                     <?php }?>
                     <?php  if(floor($data->getVote()*5/100) == 3) { ?>
                       <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p>
                     <?php }?>
                     <?php  if(floor($data->getVote()*5/100) == 4) { ?>
                       <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><span><i aria-hidden="true" class="fa fa-star"></i></span><span><i aria-hidden="true" class="fa fa-star"></i></span></p> 
                     <?php }?>
                     <?php  if(floor($data->getVote()*5/100) > 5) { ?>
                       <p><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i><i aria-hidden="true" class="fa fa-star"></i></p> 
                     <?php }?>
                     <p><span><i class="fa fa-calendar" aria-hidden="true"> <?php echo $data->getDate()?></i></span><span style="color:white"><i class="fa fa-pied-piper-pp" aria-hidden="true"></i><?php echo $data->getPopularity()?></span><span style="color:white"><i class="fa fa-comment" aria-hidden="true"></i>"<?php echo $data->getLanguage()?>" </span><span><i class="fa fa-play-circle-o" aria-hidden="true"> <?php echo $data->getDuration()?></i></span>
                     </p>
                     <h4><?= $data->getOverview(); ?></h4>
                     <h5></h5><p>
                     <form action="<?php echo URL?>/movie/remove/" method="POST">
                       <button type="submit" name="btnRemove" class="btn btn-danger" value="<?php echo $data->getId(); ?>">REMOVE TO</button>
                     </form>  
                     </p> 
                   </div>
                 </div>
               </div>
             </div>
           <?php  } } ?>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>

