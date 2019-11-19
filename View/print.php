<!-- Section Intro Slider
  ================================================== -->
  <!DOCTYPE html>
  <html>


  <head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>

  </head>

  <body>
    <div class="container">
      <div class="container lower-box box-primary">
        <div class="row">
          <div class="col-md-12">
            <?php  if(!empty($tiket)){
              foreach ($tiket as $tik) { 
                foreach($tik as $t ){
                ?>
                <div class="row">
                  <div class="col-md-3">
                    <div class="ticket">
                      <img src="<?= $t->getQr();?>" alt="QR">
                      <?php if(!empty($funct)){
                      foreach ($funct as $fun) { ?>
                      <p class="centrado">Cinema: <?=$fun->getFunction()->getRoom()->getCinema()->getNombre(); ?> 
                      <br>Room: <?=$fun->getFunction()->getRoom()->getNameRoom(); ?> 
                      <br>Day <?php $fecha = date("d/m/Y", strtotime($fun->getFunction()->getDia())); echo $fecha?>
                      Hour: <?= $fun->getFunction()->getHora()?>
                    </p>
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="cantidad">M:</th>
                          <th class="producto"><?= $fun->getFunction()->getMovie()->getTitle();?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="cantidad">Language:</td>
                          <td class="producto"><?= $fun->getFunction()->getMovie()->getLanguage();?></td>
                        </tr>
                        <tr>
                          <td class="cantidad">Duration:</td>
                          <td class="producto"><?= $fun->getFunction()->getMovie()->getDuration();?></td>
                        </tr>
                      <?php } } ?>
                        <tr>
                          <td class="cantidad">NUMBER</td>
                          <td class="producto"><?=$t->getNumbre()?></td>
                        </tr>
                      </tbody>
                    </table>
                    <p class="centrado">¡ENJOY THE MOVIE!
                      <br>Thank you for choosing Us</p>
                    </div>
                    <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
                  </div>
                </div>
              <?php } } } ?>
            </div>
          </div>
        </div>
      </div>
    </body>

    </html>
    <script type="text/javascript">
      function imprimir() {
        window.print();
      }
    </script>

    <style type="text/css">

      @media print {
        .oculto-impresion,
        .oculto-impresion * {
          display: none !important;
        }
      }

      * {
        font-size: 12px;
        font-family: 'Times New Roman';
      }

      td,
      th,
      tr,
      table {
        border-top: 1px solid black;
        border-collapse: collapse;
      }

      td.producto,
      th.producto {
        width: 100px;
        max-width: 100px;
      }

      td.cantidad,
      th.cantidad {
        width: 120px;
        max-width: 120px;
        word-break: break-all;
      }

      td.precio,
      th.precio {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
      }

      .centrado {
        text-align: center;
        align-content: center;
      }

      .ticket {
        width: 155px;
        max-width: 155px;
      }

      img {
        max-width: inherit;
        width: inherit;
      }

    </style>