<?php  include(URL_VISTA . 'navbar.php') ;
?>

<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h2 class="section-heading" style="color:white">Registrer Discounts</h2>
        <hr class="primary">
        <p>
          <strong style="color:white">
            Register! .
          </strong>
        </p>
        <div class="regularform">
          <div class="row">
            <div class="col-md-12 marcform1">
             <form class="form1" method="post" action="<?php echo URL ?>/discount/to_update/">
              <p><input  name="id" type=hidden value="<?= $discount->getId()?>"></p>
              <p class="p2" type="Discount:"><input value="<?=$discount->getDisc();?>" type="number" class="int" name="dis" style="color:white" placeholder="Enter in the Discount here.."></input></p>
              <p class="p2" type="Description:"><input value="<?= $discount->getDescription(); ?>" type="text" class="int" name="description" style="color:white" placeholder="It introduces the Description"></input></p>
               <p class="p2" type="Day:"><input value="<?= $discount->getFecha(); ?>" class="int" type="date" name="day" style="color:white" placeholder="Enter the Days.."></input></p>
              <p class="p2" type="Hours:"><input value="<?= $discount->getHora(); ?>" type="time" class="int" name="hours" style="color:white" placeholder="Enter the working hours of the discount.."></input></p>
              <button class="but">Modify Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>