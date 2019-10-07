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
               <th>Capacity</th>
               <th>Addresse</th>
               <th>Input Value</th>

          </thead>
          <tbody>
               <form action="<?php echo URL?>/cinema/remove/" method="POST">
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
                              <td><?php echo $data->getValor_entrada(); ?></td>
                              <?php if(!empty($_SESSION["rol"])){ ?>
                                  <?php if($_SESSION["rol"] != 3){ ?>
                                   <td> 
                                        <button type="submit" name="btnRemove" class="btn btn-danger" value="<?php echo $data->getId(); ?>"> Eliminar </button>
                                   </td>
                              <?php } } ?>
                         </tr>
                         <?php
                    }

                    ?>
               </form>
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
