<?php  include(URL_VISTA . 'navbar.php') ;?>

<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <?php if(!empty($cinema)) {?>
          <h2 class="section-heading" style="color:white">Register Room For: <?=$cinema->getNombre()?></h2>
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
                  <div class="imgr4">
                   <img src="<?php echo URL ?>/img/Rooms.png?>">
                 </div>
               </p>
              <form class="flexsearch--form" method="post" action="<?php echo URL ?>/fuction/add/">             
                <p class="p2" type="Numbre:"><input required type="number" min="1" max="1000000" class="int" name="numbrer" style="color:white" placeholder="It introduces the totality of the cinema in total numbers.."></input></p>
                <p class="p2" type="Capacity:"><input required type="number" min="10" max="999" class="int" name="capacity" style="color:white" placeholder="It introduces the totality of the cinema in total numbers.."></input></p>
                <button class="but">Save Data</button>
                <p><input  name="idmovie" type=hidden value="<?= $cinema->getId()?>"></p>
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
    <?php } ?>
  </div>
</div>
</section>