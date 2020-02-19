<section>
  <?php  include(URL_VISTA . 'navbar.php') ?>
  <div class="clear"></div>
</section>
<section>
  <?php if(isset($this->message)) {?>
    <div class="container">
      <h1> <?= $this->message->cartelAlert($this->message->getMessage(),$this->message->getTipo()) ?></h1>
    </div>
  <?php } ?>
  <div class="clear"></div>
</section>

<section>
  <div class="flexs">
    <div class="flexs--wrapper">
      <form class="flexs--form" onsubmit="return valida(this)" method="post" action="<?php echo URL ?>/view/remanets_buys/">
        <div class="flexs--input-wrapper">
          <div class="center">
            <select style="text-align:center;" name="select" class="btnselect">
             <option value="0">Consult totals sold</option> 
             <option value="1">For Movies</option> 
             <option value="2">For Cinema</option>
           </select>
         </div>
       </div>
       <input method="post" class="flexs--input btn2" value=""  name="search" type="search" placeholder="Search"> 
     </form>
   </div>
 </div>
</section>

<section>
  <div class="container">
    <div class="container lower-box box-primary" style="text-align: center;">
      <?php if($movies!= null ) { ?>
        <h2 class="section-heading">The functions registered to date and time are <?= $current_date ?></h2>
        <hr class="primary"> <?php }
        else{ ?>
          <h2 class="section-heading">No functions registered to date and time are <?= $current_date ?></h2>
          <hr class="primary"> <?php } ?>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <?php if(!empty($movies)){
                foreach ($movies as $mov) { ?>
                  <table class="table">

                    <tbody> 
                     <tr>
                      <td rowspan="1" valign="middle" ><p><img class="tablesimg " src="<?= $mov->getPoster(); ?>"></p></td>
                    </tr>
                    <tr class="marctr3">
                      <td colspan="2">Titile: <?= $mov->getTitle();?></td>
                    </tr>
                    <tr class="marctr3"> 
                      <td colspan="2" class="marctr2">Overview: <?= $mov->getOverview();?></td>
                    </tr>
                    <tr rowspan="2" class="marctr3">
                      <td colspan="1">Totola Sold</td>
                      <td colspan="1">Total Collected</td>
                    </tr>
                    <tr class="marctr3">
                     <?php if(!empty($mov->coun)){ ?>
                       <td colspan="1"><?= $mov->coun; ?></td>
                       <td colspan="1">$<?= $mov->min; ?></td>
                     <?php } else { ?>
                       <td colspan="1">0</td>
                       <td colspan="1">0</td>
                     <?php } ?>
                   </tr>
                 </tbody>
               </table>
             <?php }  } ?>
           </div>
         </div>
       </div>
     </div>
   </section>