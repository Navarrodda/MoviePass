<?php  include(URL_VISTA . 'navbar.php') ;
?>

<section>
 <?php if(isset($this->message)) {?>
  <div class="container">
    <h1> <?= $this->message->cartelAlert($this->message->getMessage(),$this->message->getTipo()) ?></h1>
  </div>
<?php } ?>
</section>


<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h2 class="section-heading" style="color:white">Register Cinema</h2>
        <hr class="primary">
        <p>
          <strong style="color:white">
            Register! .
          </strong>
        </p>
        <div class="regularform">
          <div class="row">
            <div class="col-md-12 marcform">
              <?php  if(!empty($cinema)) { ?>
             <form class="form1" method="post" action="<?php echo URL ?>/cinema/add/">
              <p class="p2" type="Name Cinema:"><input class="int" value="<?=$cinema->getNombre()?>" name="name" style="color:white" placeholder="Enter in the name of the cinema here.."></input></p>
              <p class="p2" type="Capacity:"><input  type="number" value="<?=$cinema->getCapacidad()?>" min="100" max="395" class="int" name="capacity" style="color:white" placeholder="It introduces the totality of the cinema in total numbers.."></input></p>
              <p class="p2" type="Address:"><input  class="int" value="<?=$cinema->getDireccion()?>" name="address" style="color:white" placeholder="Enter the address of the cinema.."></input></p>
              <p class="p2" type="Input Value:"><input  type="number" value="<?=$cinema->getValor_entrada()?>" min="150" max="600" class="int" name="input_value" style="color:white" placeholder="What would you like to tell us.."></input></p>
              <button class="but">Save Data</button>
            </form>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>