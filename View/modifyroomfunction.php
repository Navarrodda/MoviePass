<?php  include(URL_VISTA . 'navbar.php') ;?>

<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h2 class="section-heading" style="color:white">Register Function For: <?= $cinema->getNombre()?> in Room:</h2>
        <?php if (!empty($movie)) { ?>

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
                  <h3 style="color:white">Movie: <?= $movie->getTitle();?></h3>
                  <div class="fonds">
                   <img src="<?php echo URL ?>/img/room2.jpg?>">
                 </div>
               </p>
               <?php  $fec = date("d-m-Y", strtotime($day));?>
               <p><h4>The Day: <?=$fec?> and Hour: <?=$hour?></h4></p>
               <div class="flexsearch">
                <div class="flexsearch--wrapper">
                 <form class="flexsearch--form" method="post" action="#">             
                   <div class="flexsearch--input-wrapper">
                    <div class="center">
                     <p class="p2"  type="Room:">

                       <select class="btnselect" name="idroom" type="Select Room:" placeholder = "Select a Room" required>
                         <?php foreach ($room as $room) { ?>
                          <option value ="<?php echo $room->getId()?>"><?php echo $room->getNameRoom()?></option>
                        <?php } ?>
                      </select>

                    </p>
                  </div>
                </div>
                <p><input  name="day" type=hidden value="<?= $day?>"></p>
                <p><input  name="hour" type=hidden value="<?= $hour?>"></p>
                <p><input  name="idmovie" type=hidden value="<?= $movie->getId()?>"></p>
                <button class="but">Save Data-></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php } ?>
</div>
</div>
</section>