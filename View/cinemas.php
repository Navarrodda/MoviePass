<?php  include(URL_VISTA . "navbar.php"); ?>

<section class="mb-5">
 <div class="container">
  <?php if(!empty($values)) { ?>
   <div class="centerin">
     <div class="col-md-12">
       <h2 class="mb-4">Cinemas List</h2>
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
              <a type="submit" method="post"  name=""  href="#" class="disabled">
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
     <h2 class="mb-4">There are no registered cinemas</h2>
   </div>
 </div>
<?php } ?>
</div>
</section>
