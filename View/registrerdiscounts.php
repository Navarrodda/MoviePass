<?php  include(URL_VISTA . 'navbar.php') ;
?>

<section class="register-account"> 
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h2 class="section-heading" style="color:white">Registrer Discounts</h2>
        <hr class="primary">
        <p>
          <strong style="color:white">
            Register! .
          </strong>
        </p>
        <div class="regularform">
          <div class="row">
            <div class="col-md-12 marcform1">
             <form class="form1" method="post" action="<?php echo URL ?>/discount/add/">
              <p class="p2" type="Discount:"><input required type="number" class="int" name="dis" style="color:white" placeholder="Enter in the Discount here.."></input></p>
              <p class="p2" type="Description:"><input required type="text" class="int" name="description" style="color:white" placeholder="It introduces the Description"></input></p>
              <p class="p2" type="Day:"><input required id="dat" min="<?=$current_date?>" class="int" type="date" name="day" style="color:white" placeholder="Enter the Days.."></input></p>
              <!--<script src="jquery-1.3.2.min.js" type="text/javascript">
                var array = <?php //echo json_encode($fecha);?>;
                $('#dat').datepicker({
                  beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('Y-m-d', date);
                    return [ array.indexOf(string) == -1 ]
                  }
                });
              </script>  -->
              <p class="p2" type="Hours:"><input required type="time" class="int" name="hours" style="color:white" placeholder="Enter the working hours of the discount.."></input></p>
              <button class="but">Save Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>


