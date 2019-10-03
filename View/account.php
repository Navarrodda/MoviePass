<?php  include(URL_VISTA . 'navbar.php') ?>

<section class="mb-4">
  <div class="container">
    <div class="row">
     <h2 class="col-md-12">Your Account</h2>
     <table class="table bg-light-alpha">
      <thead>
       <th>Name</th>
       <th>Lastname</th>
       <th>DNI</th>
       <th>Nikname</th>
       <th>Email</th>
     </thead>
     <tbody>
       <form>
         <tr>
          <td><?php echo $user->getName();?></td>
          <td><?php echo $user->getLastname(); ?></td>
          <td><?php echo $user->getDni();?></td>
          <td><?php echo $user->getNikname(); ?></td>
          <td><?php echo $user->getEmail();?></td>
          <td> 
           <a class="btn btn-warning" href="<?php echo URL ?>/view/modifyaccount/">Modify</a> 
         </td>
       </tr>
     </form>
   </tbody>
 </table>
 <?php if ($_SESSION["rol"] == 3) { ?>
  <script type="text/javascript">
    function valida(password) {
      var ok = true;
      var msg = "I don't enter any key:\n";
      if(password.elements["dato"].value != " ")
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
    <form method="post" onsubmit="return valida(this)" action="<?php echo URL ?>/registrer/change_priority/">
     <tr>
      <td>
        <input name="dato" type="Text"/>     
        <input class="btn btn-success" type="submit" value="Send" style="border:none;"/>   
      </form> 
    </td>
  </tr>
</form>
</tbody>
</table>
<?php } ?>
</div>
</div>
</section>