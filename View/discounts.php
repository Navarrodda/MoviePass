<?php  include(URL_VISTA . "navbar.php"); ?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">

      </div>
    </div>
  </div>
</section>
<section>
 <div class="container">
  <?php if(!empty($discount)) { ?>
   <div class="">
    <div class="row">
     <div class="col-md-12">
       <h2 class="mb-4">Discounts List</h2>
     </div>
   </div>
 </div>
 <table class="table bg-light-alpha">
  <thead>
    <th>Id</th>
    <th>Discount</th>
    <th>Description</th>
    <th>Day</th>
    <th>Hours</th>
    <th>Modification</th>
    <th>Delete</th>
    <th><a class="fa fa-plus" style="color:white" method="post" name="id_cliente" href="<?php echo URL ?>/view/registrerdiscounts"></a></th>
  </thead>
  <tbody>
    <?php

    foreach($discount as $data){?>
     <tr>
      <td><?= $data->getId() ?></td>
      <td>%<?= $data->getDisc() ?></td>
      <td><?= $data->getDescription() ?></td>
      <?php $newDate = date("d/m/Y", strtotime($data->getFecha())); ?>
      <td><?= $newDate ?></td>
      <td><?= $data->getHora() ?></td>
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
    <td>-</td>
  </tr>
<?php } ?>
</tbody>
</table>
<?php } 
else { ?>
 <div class="centerin">
   <div class="col-md-12">
     <h2 class="mb-4">There are no registered Discounts ADD: <a class="fa fa-plus" style="color:white" method="post" name="id_cliente" href="<?php echo URL ?>/view/registrerdiscounts"></a></h2>
   </div>
 </div>
<?php } ?>
</div>
</section>
