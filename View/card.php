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
    <div class="col-md-8 col-md-offset-2 text-center marcbody">
      <?php if($card){?>
       <div class="checkout">
        <div class="credit-card-box">
          <div class="flip">
            <div class="front">
              <div class="chip"></div>
              <div class="logo">

                <h2><p class="fa fa-cc-visa"></p></h2>
              </div>
              <div class="number"></div>
              <div class="card-holder">
                <label>Card holder</label>
                <div></div>
              </div>
              <div class="card-expiration-date">
                <label>Expires</label>
                <div></div>
              </div>
            </div>
            <div class="back">
              <div class="strip"></div>
              <div class="logo">
               <h3>VISA</h3>
             </div>
             <div class="ccv">
              <label>CCV</label>
              <div></div>
            </div>
          </div>
        </div>
      <?php } else { ?>
             <div class="checkout">
        <div class="credit-card-box2">
          <div class="flip">
            <div class="front">
              <div class="chip"></div>
              <div class="logo">

                <h2><p class="fa fa-cc-mastercard"></p></h2>
              </div>
              <div class="number"></div>
              <div class="card-holder">
                <label>Card holder</label>
                <div></div>
              </div>
              <div class="card-expiration-date">
                <label>Expires</label>
                <div></div>
              </div>
            </div>
            <div class="back">
              <div class="strip"></div>
              <div class="logo">
               <h4>MASTER CARD</h4>
             </div>
             <div class="ccv">
              <label>CCV</label>
              <div></div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <form class="form" autocomplete="off" method="POST" action="<?php echo URL ?>/shopping/add/">
      <fieldset>
        <label for="card-number">Card Number</label>
        <input required name="cardnumber" type="num" min="0" id="card-number" class="input-cart-number" maxlength="4">
        <input required name="cardnumber1" type="num" min="0" id="card-number-1" class="input-cart-number" maxlength="4">
        <input required name="cardnumber2" type="num" min="0" id="card-number-2" class="input-cart-number" maxlength="4">
        <input required name="cardnumber3" type="num" min="0" id="card-number-3" class="input-cart-number" maxlength="4">
      </fieldset>
      <fieldset>
        <label for="card-holder">Card holder</label>
        <input required name="cardholder" type="text" id="card-holder">
      </fieldset>
      <fieldset class="fieldset-expiration">
        <label for="card-expiration-month">Expiration date</label>
        <div class="select">
          <select name="cardexpirationmonth" id="card-expiration-month">
            <option></option>
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
          </select>
        </div>
        <div class="select">
          <select name="cardexpirationyear" id="card-expiration-year">
            <option></option>
            <option>2016</option>
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
            <option>2020</option>
            <option>2021</option>
            <option>2022</option>
            <option>2023</option>
            <option>2024</option>
            <option>2025</option>
          </select>
        </div>
      </fieldset>
      <fieldset class="fieldset-ccv">
        <label for="card-ccv">CCV</label>
        <input name= "ccv" required type="text" id="card-ccv" maxlength="3">
      </fieldset>
      
      <?php if(!empty($discount)) {?>
        <p><input id ="idicount" name = "idicount" type = "hidden" value = "<?php  echo $discount[0]->getDisc();?>"></p>
      <?php } else {?> 
        <p><input id ="idicount" name = "idicount" type = "hidden" value = "0"></p>
      <?php } ?>
      <p><input id ="idfuction" name = "idfuction" type = "hidden" value = "<?php echo $fuction->getId(); ?>"></p>
      <p><input id ="quantity" name = "quantity" type = "hidden" value = "<?php  echo $quantity?>"></p>
      <p><input id ="card" name ="card" type ="hidden" value ="<?php echo $card?>" ></p>
      <p><input id ="view" name ="view" type ="hidden" value ="<?= $view ?>" ></p>

      <button class="btn6"><i class="fa fa-lock"></i> submit</button>
    </form>
  </div>
  <a class="the-most" target="_blank" href="https://codepen.io/2016/popular/pens/9/">

  </a>
</div>
</div>
</div>
<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
  $('.input-cart-number').on('keyup change', function(){
    $t = $(this);

    if ($t.val().length > 3) {
      $t.next().focus();
    }

    var card_number = '';
    $('.input-cart-number').each(function(){
      card_number += $(this).val() + ' ';
      if ($(this).val().length == 4) {
        $(this).next().focus();
      }
    })

    $('.credit-card-box .number').html(card_number);
    $('.credit-card-box2 .number').html(card_number);  
  });

  $('#card-holder').on('keyup change', function(){
    $t = $(this);
    $('.credit-card-box .card-holder div').html($t.val());
    $('.credit-card-box2 .card-holder div').html($t.val());
  });

  $('#card-holder').on('keyup change', function(){
    $t = $(this);
    $('.credit-card-box .card-holder div').html($t.val());
    $('.credit-card-box2 .card-holder div').html($t.val());
  });

  $('#card-expiration-month, #card-expiration-year').change(function(){
    m = $('#card-expiration-month option').index($('#card-expiration-month option:selected'));
    m = (m < 10) ? '0' + m : m;
    y = $('#card-expiration-year').val().substr(2,2);
    $('.card-expiration-date div').html(m + '/' + y);
  })

  $('#card-ccv').on('focus', function(){
    $('.credit-card-box').addClass('hover');
    $('.credit-card-box2').addClass('hover');
  }).on('blur', function(){
    $('.credit-card-box').removeClass('hover');
     $('.credit-card-box2').removeClass('hover');
  }).on('keyup change', function(){
    $('.ccv div').html($(this).val());
  });


/*--------------------
CodePen Tile Preview
--------------------*/
setTimeout(function(){
  $('#card-ccv').focus().delay(1000).queue(function(){
    $(this).blur().dequeue();
  });
}, 500);

/*function getCreditCardType(accountNumber) {
  if (/^5[1-5]/.test(accountNumber)) {
    result = 'mastercard';
  } else if (/^4/.test(accountNumber)) {
    result = 'visa';
  } else if ( /^(5018|5020|5038|6304|6759|676[1-3])/.test(accountNumber)) {
    result = 'maestro';
  } else {
    result = 'unknown'
  }
  return result;
}

$('#card-number').change(function(){
  console.log(getCreditCardType($(this).val()));
})*/
</script>
</section>