<?php  include(URL_VISTA . "navbar.php"); ?>

<section class="mb-5">
 <div class="container">
  <?php if(!empty($values)) { ?>
   <div class="centerin">
    <div class="row">
      <div class="col-md-2"> 
      <?php if(!empty($_SESSION["rol"])){ ?>
       <?php if($_SESSION["rol"] != 3){ ?>
         <h1><a class="fa fa-plus" style="color:white" method="post" name="id_cliente" href="<?php echo URL?>/view/registrercinema/"></a></h1>
           <?php } }  ?>
         </div>
     <div class="col-md-6">
       <h2>Cinemas List</h2>
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
      <th>Address</th>
      <th>Capacity</th>
      <th>Estimated Price</th>
      <?php if(!empty($_SESSION["rol"])){ ?>
       <?php if($_SESSION["rol"] != 3){ ?>
         <th>Modification</th>
         <th>Delete</th>
       <?php } }  ?>


     </thead>
     <tbody>
      <?php

      foreach($values as $data){

       ?>
       <tr>
         <?php if(!empty($_SESSION["rol"])){ ?>
           <?php if($_SESSION["rol"] != 3){ ?>
             <td><?php echo $data->getId(); ?></td>
           <?php } } ?>
           <td><?php echo $data->getNombre(); ?></td>
           <td><?php echo $data->getCapacidad(); ?></td>
           <td><?php echo $data->getDireccion(); ?></td>
           <td>$<?php echo $data->getValor_entrada(); ?></td>
           <?php if(!empty($_SESSION["rol"])){ ?>
            <?php if($_SESSION["rol"] != 3){ ?>
             <td>
              <a href="#" class="disabled">         
                <span class="fa fa-pencil-square-o" title=""
                data-toggle="tooltip" data-placement="right">
              </span>
            </td>
            <td>
              <a type="submit" method="post"  name="id"  href="<?php echo URL ?>/cinema/remove/<?=$data->getId() ?>" class="disabled">
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
     <h2 class="mb-4">There are no registered cinemas ADD: <a class="fa fa-plus" style="color:white" method="post" name="id_cliente" href="<?php echo URL?>/view/registrercinema/"></a></h2>
   <?php }} else { ?>
     <h2 class="mb-4">There are no registered cinemas</h2>
   <?php }?>
   </div>
 </div>
<?php } ?>
</div>
</section>
