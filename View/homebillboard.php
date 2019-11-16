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
                             <?php if($funcion!= null )
               {
                foreach ($funcion as $fun) { 
                  ?>
              <table class="table marc3">
                  <tbody> 
                   <tr>
                    <td rowspan="12" valign="middle"><p><img class="tablesimg " src="<?= $fun->getMovie()->getPoster(); ?>"></p></td>
                  </tr>
                  <form action="<?php echo URL?>/view/buyq/<?= $fun->getId();?>">
                  <button >boton</button>
                  </form>
                  <tr style="color:pink">
                    <td colspan="2" style="background:black">Titile: <?= $fun->getMovie()->getTitle(); ?></td>
                    <td colspan="2"class="fa fa-pied-piper-pp" > Popularity: <?= $fun->getMovie()->getPopularity(); ?></td>
                    <td colspan="1" class="fa fa-comment"> Language: <?= $fun->getMovie()->getLanguage(); ?></td>
                  </tr>
                  <tr style="color:white"> 
                    <td colspan="12" style="background:black">Overview: <?= $fun->getMovie()->getOverview();  ?></td>
                  </tr>
                  <tr style="color:white"> 
                    <td colspan="12">: <?= $fun->getMovie()->getLanguage();  ?></td>
                  </tr style="color:white"> 
                  <tr style="color:white">
                    <td colspan="2"></td>
                    <td colspan="2">:</td>
                    <td colspan="2">:?</td>
                  </tr >
                  <tr style="color:white">
                   <td colspan="2"></td>
                   <td colspan="2"></td>
                   <td colspan="2">?</td>
                   <td colspan="2">?</td>
                 </tr>
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
      </table>
      <?php } } ?>
  </div>
</div>
  </div>
</div>

</section>