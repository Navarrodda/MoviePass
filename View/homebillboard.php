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
  <div class="container">
    <div class="container lower-box box-primary" style="text-align: center;">
      <?php if($movies!= null ) { ?>
        <h2 class="section-heading">The functions registered to date and time are<?= $current_date ?></h2>
        <hr class="primary"> <?php }
        else{ ?>
          <h2 class="section-heading">No functions registered to date and time are<?= $current_date ?></h2>
          <hr class="primary"> <?php } ?>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <?php if(!empty($movies)){
                foreach ($movies as $mov) { ?>
                  <table class="table marc3">

                    <tbody> 
                     <tr>
                      <td rowspan="12" valign="middle"><p><img class="tablesimg " src="<?= $mov->getPoster(); ?>"></p></td>
                    </tr>
                    <tr style="color:pink">
                      <td colspan="2" style="background:black">Titile: <?= $mov->getTitle(); ?></td>
                      <td colspan="2"class="fa fa-pied-piper-pp" > Popularity: <?= $mov->getPopularity(); ?></td>
                      <td colspan="1" class="fa fa-comment"> Language: <?= $mov->getLanguage(); ?></td>
                    </tr>
                    <tr style="color:white"> 
                      <td colspan="12" style="background:black">Overview: <?= $fun->getMovie()->getOverview();  ?></td>
                    </tr>
                    <?php if(!empty($roomcinema)) { 
                     foreach ($roomcinema as $roomci){
                      if($mov->getId() === $roomci->getMovie()->getId()) { ?>
                        <tr rowspan="12" style="color:white">
                          <td colspan="1">Cinema: <?= $roomci->getRoom()->getCinema()->getNombre();  ?></td>
                          <td colspan="1">Day</td>
                          <td colspan="1">Hours</td>
                          <td colspan="1">Estimated Price</td>
                          <td colspan="1">Select</td>
                        </tr>
                        <tr style="color:white">
                         <td colspan="1">Room <?= $roomci->getRoom()->getNameRoom();?></td>
                         <td colspan="1"><?= $roomci->getDia(); ?></td>
                         <td colspan="1"><?= $roomci->getHora(); ?></td>
                         <td colspan="1"><?= $roomci->getRoom()->getCinema()->getValor_entrada(); ?></td>
                          <form method="post" action="<?php echo URL ?>/view/buyq/">
                         <td colspan="1"><button name="idfuction" style="background:coral" value ="<?= $roomci->getId(); ?>">Botonaso</button></td>
                         </form>
                       </tr>
                     <?php } } } ?>
                   </tbody>
                 </table>
               <?php }  } ?>
             </div>
           </div>
         </div>
       </div>
     </section>