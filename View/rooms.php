<?php  include(URL_VISTA . "navbar.php"); ?>

<section class="mb-5">
 <div class="container">
  <?php if(!empty($room)) { ?>
   <div class="centerin">
    <div class="row">
      <div class="col-md-1"> 
        <?php if(!empty($_SESSION["rol"])){ ?>
         <?php if($_SESSION["rol"] != 3){ ?>
           <h1><a class="fa fa-plus" style="color:white" method="post" name="idcinema" href="<?php echo URL?>/view/registeroom/<?= $cinema->getId();?>"></a></h1>
         <?php } }  ?>
       </div>
       <div class="col-md-10">
         <h2>Rooms For Cinema:" <?=$cinema->getNombre()?>"</h2>
       </div>
     </div>
   </div>
   <table class="table bg-light-alpha">
    <thead>
     <?php if(!empty($_SESSION["rol"])){ ?>
       <?php if($_SESSION["rol"] != 3){ ?>
        <th>Id</th>
      <?php } }  ?>
      <th>Name</th>
      <th>Cant Site</th>
      <th>Number Room</th>
      <?php if(!empty($_SESSION["rol"])){ ?>
       <?php if($_SESSION["rol"] != 3){ ?>
         <th>Modification</th>
         <th>Delete</th>
       <?php } }  ?>


     </thead>
     <tbody>
      <?php

      foreach($room as $rooms){

       ?>
       <tr>
         <?php if(!empty($_SESSION["rol"])){ ?>
           <?php if($_SESSION["rol"] != 3){ ?>
             <td><?php echo $rooms->getId(); ?></td>
           <?php } } ?>
           <td><?php echo $rooms->getNameRoom();?></td>
           <td><?php echo $rooms->getCantSite();?></td>
           <td><?php echo $rooms->getNumberRoom();?></td>
           <?php if(!empty($_SESSION["rol"])){ ?>
            <?php if($_SESSION["rol"] != 3){ ?>
                <td>
                  <a href="#" class="disabled">         
                    <span class="fa fa-pencil-square-o" title=""
                    data-toggle="tooltip" data-placement="right">
                  </span>
                </td>
                <td>
                  <a type="submit" method="post"  name="id"  href="#" class="disabled">
                    <span class="fa fa-trash-o" title=""
                    data-toggle="tooltip" data-placement="right">
                  </span>
                </a>
              </td>
            <?php } } ?>
          </tr>
          <?php
        }

        ?>
      </tbody>
    </table>
  <?php } 
  else {?>
   <div class="centerin">
     <div class="col-md-12">
      <?php if(!empty($_SESSION["rol"])){ ?>
        <?php if($_SESSION["rol"] != 3){ ?>
         <h2 class="mb-4">There are no registered Room ADD: <a class="fa fa-plus" style="color:white" method="post" name="id_cliente" href="#"></a></h2>
       <?php }} else { ?>
         <h2 class="mb-4">There are no registered Rooms for cinema</h2>
       <?php }?>
     </div>
   </div>
 <?php } ?>
</div>
</section>
