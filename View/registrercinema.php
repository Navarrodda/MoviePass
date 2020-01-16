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
             <form class="form1" method="post" action="<?php echo URL ?>/cinema/add/">
              <p class="p2" type="Name Cinema:"><input required class="int" name="name" style="color:white" placeholder="Enter in the name of the cinema here.."></input></p>
              <p class="p2" type="Address:"><input required class="int" name="address" style="color:white" placeholder="Enter the address of the cinema.."></input></p>
              <button class="but">Save Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>