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
                 <form class="flexsearch--form" method="post" action="<?php echo URL ?>/view/buyseat/">             
                   <div class="flexsearch--input-wrapper">
                    <div class="center">
                     <p class="p2"  type="Quantity:">
                       <select class="btnselect" name="idquantity" type="Select Quantity:" placeholder = "Select Ticket Quantity" required>
                        <?php for($i = 0; $i<10;$i++){ ?>
                          <option value ="$i"><?php echo $i?></option>
                        <?php } ?>
                      </select>
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