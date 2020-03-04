<section>
  <?php  include(URL_VISTA . 'navbar.php') ?>
  <div class="clear"></div>
</section>

<section>
  <div id="contenedor_carga">
    <div id="carga"></div>
  </div>
</section>
<section id="principal" class="blog-slide-text">
  <div class="container">
    <div class="row">
      <div class="centerin">
        <?php  if(!empty($values)){ ?>
          <div class="col-md-12">
            <h1 style="color:white">New Movies</h1>
          </div>
        <?php } else { ?>
          <div class="col-md-12">
            <h1 style="color:white">At this time there are </h1>
            <h1 style="color:white">no movies to show trying later</h1>
            <h2 style="color:white"></h2>
          </div>
        <?php } ?>
      </div>
      <div class="blog-sidebar">
        <?php if(!empty($genere)){ ?>
         <h2>Categories</h2>
         <div class="categorie">
          <div class="row">
            <div class="col-md-12">
             <?php foreach ($genere as $gen) { ?>
              <p><a href="<?php echo URL ?>/view/genre/<?php echo $gen->getName() ?>/<?php echo $gen->getId() ?>/"><span><i class="fa fa-list-ul"> <?php echo $gen->getName()?></i></span></a></p>
            <?php  }?>
          </div>
        </div>
      </div> 
    <?php }  ?>
    <?php if(!empty($_SESSION)){
      if($_SESSION["rol"] != 3) { ?>
      <?php  } } ?>
    </div>
    <?php if(!empty($values)){
      foreach ($values as $data) { ?>
       <div class="col-md-9">
         <div class="b-slide-text">
           <div class="row fond">
            <div class="col-md-5">
              <div class="b-slide marc">
                <img src="<?php echo $data->getBackdrop()?>">
              </div>
            </div>
            <div class="col-md-7">
              <div class="b-text">
                <h2><?php echo $data->getTitle()?></h2>
                <p>
                  <span><i class="fa fa-calendar" aria-hidden="true"> <?php echo $data->getDate()?></i></span>
                  <?php if($data->getVote() < 100) {?>
                    <span><i class="fa fa-long-arrow-down" aria-hidden="true"></i><?php echo $data->getVote()?></span>
                  <?php } else { ?>          
                    <span><i class="fa fa-long-arrow-up" aria-hidden="true"></i><?php echo $data->getVote()?></span>
                  <?php } ?>
                  <span><i class="fa fa-pied-piper-pp" aria-hidden="true"></i><?php echo $data->getPopularity()?></span><span><i class="fa fa-comment" aria-hidden="true"></i>"<?php echo $data->getLanguage()?>"</span>
                  <?php  if($data->codigo == TRUE) { ?>
                    <span><i class="fa fa-check" aria-hidden="true"></i></span>
                  <?php } else { ?>
                    <span><i class="fa fa-remove" aria-hidden="true"></i></span>
                  <?php } ?>
                </p>
                <h4><?php echo $data->getOverview(); ?></h4>
                <?php  if($data->codigo == FALSE) { ?>
                  <a href="<?php echo URL ?>/movie/choose_movie/<?php echo $data->getIdapi()  ?>/<?php echo $page ?>/" class="fa fa-archive"> CHOOSE MOVIE</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } } ?>
  </div>
  <?php if(!empty($length)){ ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="centre">
          <ul class="pagination pagination-lg">   
            <?php if($page > 3) { ?>
              <li><a href="<?php echo URL ?>/view/moviespages/<?php echo $emty ?>/<?php echo $page ?>/<?php echo $count ?>/<?php echo -1 ?>"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
            <?php } ?>
            <?php for ($i=$emty; $i <= $count; $i++) {
              if($i == $page) { ?>
                <li><a style="color:#a11d26"><?php echo $i;?></a></li>
              <?php } else { ?>
                <li><a href="<?php echo URL ?>/view/moviespages/<?php echo $emty ?>/<?php echo $i ?>/<?php echo $count ?>/<?php echo 2?>"><?php echo $i?></a></li>
              <?php } } 
              if ($page < 66) { ?>
                <li><a href="<?php echo URL ?>/view/moviespages/<?php echo $emty ?>/<?php echo $i ?>/<?php echo $count ?>/<?php echo 1?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    <?php }  ?>
  </div>
</section>

<script>
  window.onload = function(){
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity = '0';
  }
</script>