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
        <h2 class="section-heading" style="color:white">Modify Cinema</h2>
        <hr class="primary">
        <p>
          <strong style="color:white">
            Modifi! .
          </strong>
        </p>
        <div class="regularform">
          <div class="row">
            <div class="col-md-12 marcform">
              <?php  if(!empty($cinema)) { ?>
             <form class="form1" method="post" action="<?php echo URL ?>/cinema/modify/">
              <p><input  name="id" type=hidden value="<?= $cinema->getId()?>"></p>
              <p class="p2" type="Name Cinema:"><input class="int" value="<?=$cinema->getNombre()?>" name="name" style="color:white" placeholder="Enter in the name of the cinema here.."></input></p>
              <p class="p2" type="Address:"><input  class="int" value="<?=$cinema->getDireccion()?>" name="address" style="color:white" placeholder="Enter the address of the cinema.."></input></p>
              <button class="but">Modify Data</button>
            </form>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>