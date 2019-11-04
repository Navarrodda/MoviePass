<?php  include(URL_VISTA . 'navbar.php') ;
?>

<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <?php if(!empty($cineList)) {?>
        <h2 class="section-heading" style="color:white">Register Function</h2>
        <hr class="primary">
        <p>
          <strong style="color:white">
            Register!
          </strong>
        </p>
        <div class="regularform">
          <div class="row">
            <div class="col-md-12 marcform">
            <div class="flexsearch">
            <div class="flexsearch--wrapper">
             <form class="flexsearch--form" method="post" action="<?php echo URL ?>/function/add/">             
             <div class="flexsearch--input-wrapper">
                  <div class="center">
             <select class="btnselect" type="Select Cinema:" placeholder = "Select a Cinema" required>
                <?php foreach($cineList as $cine) { ?>
                    <option value = "<?php echo $cine->getId()?>"><?php echo $cine->getNombre()?></option>
                <?php } ?>
             </select>
                  </div>
                </div>
            
              <p class="p2" type="Date:"><input required type="date" class="int" name="day" style="color:white" placeholder="Select Day of Function"></input></p>
               <p class="p2" type="Hour:"><input required type="time" class="int" name="hour" style="color:white" placeholder="Select Hour of Function"></input></p>
              <button class="but">Save Data</button>
              <p><input  name="id" type=hidden value="<?= $movie->getId()?>"></p>
            </form>
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