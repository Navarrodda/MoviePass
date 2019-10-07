<?php  include(URL_VISTA . 'navbar.php') ?>


<section class="blog-slide-text">
  <div class="container">
    <div class="row">
      <div class="centerin">
        <div class="col-md-12">
          <h1 style="color:white">Genre: <?php echo $titule; ?></h1>
        </div>
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
    <?php if(!isset($_SESSION)) {?>
      <h2>Search Categories or Movies</h2>
      <div class="tags">

        <script type="text/javascript">
          function valida(search) {
            var ok = true;
            var msg = "!Empty search data:\n";
            if(search.elements["search"].value == "")
            {
              msg += "Complete the field\n";
              ok = false;
            }

            if(ok == false)
              alert(msg);
            return ok;
          }
        </script>
        <div class="flexsearch">
          <div class="flexsearch--wrapper">
            <form class="flexsearch--form" onsubmit="return valida(this)" method="post" action="#">
              <div class="flexsearch--input-wrapper">
                <div class="center">
                  <select name="select" class="btnselect">
                   <option value="0">Choose an option</option> 
                   <option value="1">Movie</option> 
                   <option value="2">Categories</option>
                 </select>
               </div>
             </div>
             <input method="post" class="flexsearch--input btn3" value=""  name="search" type="search" placeholder="Search">          
           </form>
         </div>
       </div>
     </div>
   <?php }  ?>
 </div>
 <?php if(!empty($values)){
  foreach ($values as $data) { ?>
   <div class="col-md-9">
     <div class="b-slide-text">
       <div class="row">
        <div class="col-md-5">
          <div class="b-slide">
            <img src="<?php echo $data->getImageruta()?>">
          </div>
        </div>
        <div class="col-md-7">
          <div class="b-text">
            <h2><?php echo $data->getTitle()?></h2>
            <?php if($data->getVoteCount() < 100) {?>
              <p><span><i class="fa fa-calendar" aria-hidden="true"> <?php echo $data->getReleaseDate()?></i></span><span><i class="fa fa-long-arrow-down" aria-hidden="true"></i><?php echo $data->getVoteCount()?></span><span><i class="fa fa-pied-piper-pp" aria-hidden="true"></i><?php echo $data->getVoteAverage()?></span><span><i class="fa fa-comment" aria-hidden="true"></i>"<?php echo $data->getOriginalLanguage()?>"</span><span><i class="fa fa-check" aria-hidden="true"></i></span>
              </p>
            <?php } else { ?>          
              <p><span><i class="fa fa-calendar" aria-hidden="true"> <?php echo $data->getReleaseDate()?></i></span><span><i class="fa fa-long-arrow-up" aria-hidden="true"></i><?php echo $data->getVoteCount()?></span><span><i class="fa fa-pied-piper-pp" aria-hidden="true"></i><?php echo $data->getVoteAverage()?></span><span><i class="fa fa-comment" aria-hidden="true"></i>"<?php echo $data->getOriginalLanguage()?>"</span><span><i class="fa fa-remove" aria-hidden="true"></i></span>
              </p>
            <?php } ?>
            <h4><?php echo $data->getOverview(); ?></h4>
            <a href="#" class="fa fa-archive"> CHOOSE MOVIE</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } }  
else {
  ?>
  <div class="col-md-9">
   <div class="b-slide-text">
     <div class="row">
      <div class="col-md-7">
        <div class="b-text">
          <h2>There are no films with the genre: <?php echo $titule; ?></h2>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php } ?>
<?php if($length > 10 ) { ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="centre">
        <ul class="pagination pagination-lg">
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
<?php }  ?>
</div>
</section>