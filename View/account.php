<?php  include(URL_VISTA . 'navbar.php') ?>

<section class="mb-4">
  <div class="container">
    <div class="row">
     <h2 class="col-md-12" style="color:white">Your Account</h2>
     <table class="table bg-light-alpha">
      <thead>
       <th style="color:white">Name</th>
       <th style="color:white">Lastname</th>
       <?php if($user->getDni() != null){ ?>
       <th style="color:white">DNI</th>
       <?php } else{ ?>
        <th style="color:white">Account</th>
        <?php  } ?>
       <th style="color:white">Nikname</th>
       <th style="color:white">Email</th>
     </thead>
     <tbody>
       <form>
         <tr>
          <td style="color:white"><?php echo $user->getName();?></td>
          <td style="color:white"><?php echo $user->getLastname(); ?></td>
          <?php if($user->getDni() != null){ ?>
          <td style="color:white"><?php echo $user->getDni();?></td>
          <?php } else{ ?>
            <td style="color:white">FaceBook</td>
          <?php  } ?>
          <td style="color:white"><?php echo $user->getNikname(); ?></td>
          <td style="color:white"><?php echo $user->getEmail();?></td>
          <?php if($user->getDni() != null){?>
          <td> 
           <a class="btn btn-warning" href="<?php echo URL ?>/view/modifyaccount/">Modify</a> 
         </td>
       <?php  } ?>
       </tr>
     </form>
   </tbody>
 </table>
 <?php if ($_SESSION["rol"] == 3) { 
    if($user->getDni() != null){ ?>
  <script type="text/javascript">
    function valida(dato) {
      var ok = true;
      var msg = "I don't enter any key:\n";
      if(dato.elements["dato"].value == "")
      {
        msg += "Put a key\n";
        ok = false;
      }
      if(dato.elements["dato"].value == "l")
      {
        msg += "Put a key\n";
        ok = false;
      }

      if(ok == false)
        alert(msg);
      return ok;
    }

  </script>
  <table class="table bg-light-alpha">
    <thead>
     <th>Enter key to be a member</th>
   </thead>
   <tbody>
    <form method="post" onsubmit="return valida(this)" action="<?php echo URL ?>/user/change_priority/">
     <tr>
      <td>
        <input style="color:black" name="dato" type="Text"/>     
        <input class="btn btn-success" type="submit" value="Send" style="border:none;"/>   
      </form> 
    </td>
  </tr>
</form>
</tbody>
</table>
<?php } } ?>
</div>
</div>
</section>