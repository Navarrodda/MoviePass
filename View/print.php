<!-- Section Intro Slider
  ================================================== -->
  <!DOCTYPE html>
  <html>


  <head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>

  </head>

  <body>
    <div class="ticket">
      <img src="https://yt3.ggpht.com/-3BKTe8YFlbA/AAAAAAAAAAI/AAAAAAAAAAA/ad0jqQ4IkGE/s900-c-k-no-mo-rj-c0xffffff/photo.jpg" alt="Logotipo">
      <p class="centrado">Mauto ponete las pilas dale 
        <br>Agus Murio en el Proyecto jajaja
        <br>19/11/2019 02:22 a.m.</p>
        <table>
          <thead>
            <tr>
              <th class="cantidad">CANT</th>
              <th class="producto">PRODUCTO</th>
              <th class="precio">$$</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="cantidad">1.00</td>
              <td class="producto">CHEETOS VERDES 80 G</td>
              <td class="precio">$8.50</td>
            </tr>
            <tr>
              <td class="cantidad">2.00</td>
              <td class="producto">KINDER DELICE</td>
              <td class="precio">$10.00</td>
            </tr>
            <tr>
              <td class="cantidad">1.00</td>
              <td class="producto">COCA COLA 600 ML</td>
              <td class="precio">$10.00</td>
            </tr>
            <tr>
              <td class="cantidad"></td>
              <td class="producto">TOTAL</td>
              <td class="precio">$28.50</td>
            </tr>
          </tbody>
        </table>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
          <br>parzibyte.me</p>
        </div>
        <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
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
          width: 75px;
          max-width: 75px;
        }

        td.cantidad,
        th.cantidad {
          width: 40px;
          max-width: 40px;
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