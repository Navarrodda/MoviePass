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
      <?php if($funcion!= null ) { ?>
        <h2 class="section-heading">The functions registered to date and time are<?= $current_date ?></h2>
        <hr class="primary"> <?php }
        else{ ?>
          <h2 class="section-heading">No functions registered to date and time are<?= $current_date ?></h2>
          <hr class="primary"> <?php } ?>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <?php if(!empty($funcion))
               {
                foreach ($funcion as $fun) { 
                  ?>
              <table class="table marc3">
                <?php foreach ($fun as $date) { ?>
                  <tbody> 
                    
                   <tr>
                    <td rowspan="12" valign="middle"><p><img class="tablesimg " src="<?= $date->getMovie()->getPoster(); ?>"></p></td>
                  </tr>
                  <tr style="color:pink">
                    <td colspan="2" style="background:black">Titile: <?= $date->getMovie()->getTitle(); ?></td>
                    <td colspan="2"class="fa fa-pied-piper-pp" > Popularity: <?= $date->getMovie()->getPopularity(); ?></td>
                    <td colspan="1" class="fa fa-comment"> Language: <?= $date->getMovie()->getLanguage(); ?></td>
                  </tr>
                  <tr style="color:white"> 
                    <td colspan="12" style="background:black">Overview: <?= $date->getMovie()->getOverview();  ?></td>
                  </tr>
                  <?php if(!empty($roomcinema)) { 
                   foreach ($roomcinema as $romcin){
                    if($romcin->getId() === $date->getRoom()->getId()) { ?>

                  <tr style="color:white">
                    <td colspan="1">Cinema: <?= $romcin->getCinema()->getNombre();  ?></td>
                    <td colspan="1">Day</td>
                    <td colspan="1">Hours</td>
                    <td colspan="1">Estimated Price</td>
                  </tr >
               
                  <tr style="color:white">
                   <td colspan="1">Room <?= $romcin->getNameRoom();?></td>
                   <td colspan="1"><?= $date->getDia(); ?></td>
                   <td colspan="1"><?= $date->getHora(); ?></td>
                   <td colspan="1"><?= $romcin->getCinema()->getValor_entrada(); ?></td>
                 </tr>
                  <?php } } } ?>
                 <tr style="color:white">
                  <td colspan="2">?</td>
                  <td colspan="2">?</td>
                  <td colspan="2">?</td>
                </tr>
                <tr style="color:white">
                  <td colspan="2">C</td>
                  <td colspan="2">C</td>
                  <td colspan="2">G</td>
                  <td colspan="2">C</td>
                </tr>
            
          </tbody>
            <?php } ?>
      </table>
      <?php } } ?>
  </div>
</div>
  </div>
</div>

</section>