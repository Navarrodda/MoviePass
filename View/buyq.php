<?php  include(URL_VISTA . 'navbar.php') ;?>

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
                  <h4><?php $fecha = date("d-m-Y", strtotime($fuction->getDia())); echo "Function Day:  ".$fecha." ".$fuction->getHora();?></h1>
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
                     
                      <script>
                       var entrada = <?php echo $cinema->getValor_entrada(); ?>;
                        var activities = document.getElementById("selector");
                         activities.addEventListener("change", function() {
                            // alert(this.value * entrada);
                               var total1 = this.value * entrada;
                               document.getElementById("total").innerHTML = "Total : $" + total1.toString();
                          });
                          </script>
                       <h4 id = "total" style="color:white">Total : <?php echo $cinema->getValor_entrada(); ?> </h4>
                      
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