<?php  include(URL_VISTA . 'navbar.php') ;?>

<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <?php if(!empty($room)) {?>
          <h2 class="section-heading" style="color:white">Modify Room For: <?=$room->getCinema()->getNombre()?></h2>
          <hr class="primary">
          <p>
            <strong style="color:white">
              Modify!
            </strong>
          </p>
          <div class="regularform">
            <div class="row">
              <div class="col-md-12 marcform">
                <p>
                  <div class="imgr4">
                   <img class="imgr4" src="<?php echo URL ?>/img/Rooms.png?>">
                 </div>
               </p>
              <form class="flexsearch--form" method="post" action="<?php echo URL ?>/room/modify">             
                <p class="p2" type="Name_Room:"><input required type="text" value="<?= $room->getNameRoom(); ?>" class="int" name="name_room" style="color:white" placeholder="It introduces name the room"></input></p>
                <p class="p2" type="Cant_Site:"><input required type="number" value="<?= $room->getCantSite(); ?>" min="1" max="999" class="int" name="cant_site" style="color:white" placeholder="It introduces the totality of the site in the room.."></input></p>
                <p class="p2" type="Input Value:"><input required type="number" value="<?= $room->getInputValue(); ?>" min="0" max="900" class="int" name="input_value" style="color:white" placeholder="What would you like to tell us.."></input></p>
                <p><input  name="idroom" type=hidden value="<?= $room->getId()?>"></p>
                <button class="but">Modify Data</button>
                
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