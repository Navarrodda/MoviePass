<?php  include(URL_VISTA . 'navbar.php') ;?>

<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <?php if(!empty($cineList)) {?>
          <h2 class="section-heading" style="color:white">Register Function For:</h2>
          <?php if (!empty($movie)) { ?>
          <?php }?>
          <hr class="primary">
          <p>
            <strong style="color:white">
              Register!
            </strong>
          </p>
          <div class="regularform">
            <div class="row">
              <div class="col-md-12 marcform">
                <p>
                  <h3 style="color:white"><?= $movie->getTitle();?></h3>
                  <div class="imgr3 ">
                    <div class="fonds">
                   <img src="<?= $movie->getBackdrop();?>">
                 </div>
                 </div>
               </p>
               <div class="flexsearch">
                <div class="flexsearch--wrapper">
                 <form class="flexsearch--form" method="post" action="<?php echo URL ?>/view/selectroom/">             
                   <div class="flexsearch--input-wrapper">
                    <div class="center">
                     <p class="p2"  type="Cinema:">
                       <select class="btnselect" name="idcinema" type="Select Cinema:" placeholder = "Select a Cinema" required>
                        <?php foreach($cineList as $cine) { ?>
                          <option value ="<?php echo $cine->getId()?>"><?php echo $cine->getNombre()?></option>
                        <?php } ?>
                      </select>
                    </p>
                  </div>
                </div>
            
             <p class="p2" type="Day:"><input required id="dat" min="<?=$current_date?>" class="int" type="date" name="day" style="color:white" placeholder="Enter the Days.."></input></p>
              
               <p class="p2" type="Hours:"><input required type="time" class="int" name="hour" style="color:white" placeholder="Select Hour of Function"></input></p>
              <button class="but">Select Room -></button>
              <p><input  name="idmovie" type=hidden value="<?= $movie->getId()?>"></p>
              <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
              <script> var array = <?php// echo json_encode($fecha);?>;
                $('#dat').datepicker({
                  beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('Y-m-d', date);
                    return [ array.indexOf(string) == -1 ]
                  }
                });
              </script>-->
            </form>
                </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php }else {?>
  <h2 class="section-heading" style="color:white">No Cinemas Registered</h2>
<?php }?>
</div>
</div>
</section>