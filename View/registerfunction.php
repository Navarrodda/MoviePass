<?php  include(URL_VISTA . 'navbar.php') ;
?>

<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
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
             <form class="formf" method="post" action="<?php echo URL ?>/function/add/">
             <select class="p2" type="Select Cinema:" placeholder = "Select a Cinema" required>
                <?php foreach($cineList as $cine) { ?>
                    <option value = <?php echo $cine->getId()?>><?php echo $cine->getName()?></option>
                <?php } ?>
             </select>
              <p class="p2" type="Capacity:"><input required type="number" class="int" name="capacity" style="color:white" placeholder="It introduces the totality of the cinema in total numbers.."></input></p>
               <p class="p2" type="Address:"><input required class="int" name="address" style="color:white" placeholder="Enter the address of the cinema.."></input></p>
              <p class="p2" type="Input Value:"><input required type="number" class="int" name="input_value" style="color:white" placeholder="What would you like to tell us.."></input></p>
              <button class="but">Save Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>