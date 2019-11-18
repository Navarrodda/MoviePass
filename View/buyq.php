<?php  include(URL_VISTA . 'navbar.php') ;?>

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
          <hr class="primary">
          <p>
            <strong style="color:white">
              Buy Process!
            </strong>
          </p>
          <div class="regularform">
            <div class="row">
              <div class="col-md-12 marcform">
                <p>
                  <h3 style="color:white"><?= $movie->getTitle();?></h3>
                  <h4><?php $fecha = date("d-m-Y", strtotime($fuction->getDia())); echo "Function Day:  ".$fecha." ".$fuction->getHora();?></h4>
                  <h4>Room : <?php echo $room->getNameRoom() ?> Number : <?php echo $room->getNumberRoom();?></h4>
                  <div class="imgr3 ">
                    <div class="fonds">
                   <img src="<?= $movie->getBackdrop();?>">
                 </div>
                 </div>
               </p>
               <div class="flexsearch">
                <div class="flexsearch--wrapper">
                 <form class="flexsearch--form" method="post" action="<?php echo URL ?>/view/card/">             
                   <div class="flexsearch--input-wrapper">
                    <div class="center">
                     <p class="p2"  type="Quantity:">
                       <select id ="selector" class="btnselect" name="idquantity" type="Select Quantity:" placeholder = "Select Ticket Quantity" required>
                        <?php for($i = 1; $i<=10;$i++){ ?>
                          <option value ="<?php echo $i?>"><?php echo $i?></option>
                        <?php } ?>
                      </select>
                      <p class="p2">
                      <select name="typecard" id="typecard" class="btnselect">
                            <option value="select">Select Card Type</option>
                            <option value="visa">Visa</option>
                            <option value="mastercard">Master Card</option>
                    </select>
                    </p>
                      <script>
                      <?php if(!empty($discount)) {?>
                        var discount = <?php echo $discount[0]->getDisc()/100 ?> ;
                      <?php }else {?>
                        var discount = 0;
                      <?php }?>
                       var entrada = <?php echo $cinema->getValor_entrada(); ?>;
                        var activities = document.getElementById("selector");
                         activities.addEventListener("change", function() {
                            // alert(this.value * entrada);
                              if(discount == 0)
                              {
                                var total1 = this.value * entrada;
                              }else{
                                var total1 = this.value * entrada * discount;
                              }
                               
                               document.getElementById("total").innerHTML = "Total : $" + total1.toString();
                          });
                          </script>
                          <?php if(!empty($discount)) {?>
                          <h2 style="color:white"> Discount :  <?php  echo "%".$discount[0]->getDisc();?></h2>
                          <p><input id ="iddiscount" name = "iddiscount" type = "hidden" value = "<?php  echo $discount[0]->getDisc();?>"></p>
                          <?php }?> 
                          <p><input id ="iddiscount" name = "iddiscount" type = "hidden" value = "0"></p>
                          <h2 style="color:white">Precio : <?php echo $cinema->getValor_entrada(); ?></h2>
                       <h1 id = "total" style="color:white">Total : <?php echo $cinema->getValor_entrada(); ?> </h1>
                       <p><input id ="idfuction" name = "idfuction" type = "hidden" value = "<?php echo $fuction->getId(); ?>"></p>
                       
                       
                    </p>
                   
                    <button class="but">Continue</button>
                  </div>
                </div>
            </form>
                </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>