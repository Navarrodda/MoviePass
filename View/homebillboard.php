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
    <div class="row">
      <div class="col-md-12">
        <script type="text/javascript">
          function valida(search) {
            var ok = true;
            var msg = "!Empty search data:\n";
            if(search.elements["search"].value == "")
            {
              msg += "Complete the field\n";
              ok = false;
            }

            if(ok == false)
              alert(msg);
            return ok;
          }
        </script>

        <div class="flexsearch">
          <div class="flexsearch--wrapper">
            <form class="flexsearch--form" onsubmit="return valida(this)" method="post" action="<?php echo URL ?>/view/billboardforsearch">
              <div class="flexsearch--input-wrapper">
                <div class="col-md-12">
                <div class="center">
                 </div>
               </div>
             </div>
             <input method="post" class="flexsearch--input btn3"  name="search" type="search" placeholder="Search"> 
           </form>
         </div>
       </div>
     </div>
   </div>
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
                  <table class="table marc3">

                    <tbody> 
                     <tr>
                      <td rowspan="12" valign="middle" class="marctr3"><p><img class="tablesimg " src="<?= $mov->getPoster(); ?>"></p></td>
                    </tr>
                    <tr class="marctr1">
                      <td colspan="2">Titile: <?= $mov->getTitle();?></td>
                      <td colspan="1"class="fa fa-pied-piper-pp" > Popularity: <?= $mov->getPopularity();?></td>
                      <td colspan="1" class="fa fa-comment"> Language: <?= $mov->getLanguage();?></td>
                      <td colspan="1"></td>
                      <td colspan="1" class="fa fa-thumbs-o-up"> Votes: <?= $mov->getVote();?> </td>
                      <td colspan="1" class="fa fa-play-circle-o"> Duration: <?= $mov->getDuration();?></td>
                      <td colspan="1"></td>
                    </tr>
                    <tr style="color:white"> 
                      <td colspan="12" class="marctr2">Overview: <?= $mov->getOverview();?></td>
                    </tr>
                    <?php if(!empty($roomcinema)) { 
                     foreach ($roomcinema as $roomci){
                      if($mov->getId() === $roomci->getMovie()->getId()) { ?>
                        <tr rowspan="12" style="color:white">
                          <td colspan="1">Cinema: <?= $roomci->getRoom()->getCinema()->getNombre();  ?></td>
                          <td colspan="1">Day</td>
                          <td colspan="1">Hours</td>
                          <td colspan="1">Estimated Price</td>
                          <td colspan="1">Function</td>
                        </tr>
                        <tr style="color:white">
                         <td colspan="1">Room <?= $roomci->getRoom()->getNameRoom();?></td>
                         <td colspan="1"><?php $fecha = date("d/m/Y", strtotime($roomci->getDia())); echo $fecha?></td>
                         <td colspan="1"><?= $roomci->getHora(); ?></td>
                         <td colspan="1">$<?= $roomci->getRoom()->getInputValue(); ?></td>
                         <?php if(!empty($_SESSION["rol"])){ ?>
                          <?php if($_SESSION["rol"] == 3){ ?>
                            <form method="post" action="<?php echo URL ?>/view/buyq/">
                             <td colspan="1"><button class="btn btn-success fa fa-shopping-cart" name="idfuction" value =" <?= $roomci->getId(); ?>"> Select</button></td>
                           </form>
                         <?php } else {
                          ?>
                          <form method="post" action="<?php echo URL ?>/view/modifyfuction/">
                           <td colspan="1"><button class="btn btn-success fa fa-pencil" name="idfuction" value =" <?= $roomci->getId(); ?>"> Modify</button></td>
                         </form>
                       <?php } } else { ?>
                         <form method="post" action="<?php echo URL ?>/view/login/">
                           <td colspan="1"><button class="btn btn-success fa fa-shopping-cart" name="idfuction" value =" <?= $roomci->getId(); ?>"> Select</button></td>
                         </form>
                         <?php } ?>
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