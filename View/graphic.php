<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gráfico de barrasL</title>

 

    <style>

    .chart-wrap {

        --chart-width:420px;

        --grid-color:#aaa;

        --bar-color:#000;

        --bar-thickness:40px;

        --bar-rounded: 3px;

        --bar-spacing:10px;

 

        font-family:sans-serif;

        width:var(--chart-width);

    }

 

    .chart-wrap .title{

        font-weight:bold;

        padding:1.8em 0;

        text-align:center;

        white-space:nowrap;

    }

 

    /* cuando definimos el gráfico en horizontal, lo giramos 90 grados */

    .chart-wrap.horizontal .grid{

        transform:rotate(-90deg);

    }

 

    .chart-wrap.horizontal .bar::after{

        /* giramos las letras para horizontal*/

        transform: rotate(45deg);

        padding-top:0px;

        display: block;

    }

 

    .chart-wrap .grid{

        margin-left:50px;

        position:relative;

        padding:5px 0 5px 0;

        height:100%;

        width:100%;

        border-left:2px solid var(--grid-color);

    }

 

    /* posicionamos el % del gráfico*/

    .chart-wrap .grid::before{

        font-size:0.8em;

        font-weight:bold;

        content:'0%';

        position:absolute;

        left:-0.5em;

        top:-1.5em;

    }

    .chart-wrap .grid::after{

        font-size:0.8em;

        font-weight:bold;

        content:'100%';

        position:absolute;

        right:-1.5em;

        top:-1.5em;

    }

 

    /* giramos las valores de 0% y 100% para horizontal */

    .chart-wrap.horizontal .grid::before, .chart-wrap.horizontal .grid::after {

        transform: rotate(90deg);

    }

 

    .chart-wrap .bar {

        width: var(--bar-value);

        height:var(--bar-thickness);

        margin:var(--bar-spacing) 0;

        background-color:var(--bar-color);

        border-radius:0 var(--bar-rounded) var(--bar-rounded) 0;

    }

 

    .chart-wrap .bar:hover{

        opacity:0.7;

    }

 

    .chart-wrap .bar::after{

        content:attr(data-name);

        margin-left:100%;

        padding:10px;

        display:inline-block;

        white-space:nowrap;

    }

 

    </style>

</head>

<body>

 

<div class="chart-wrap horizontal"> <!-- quitar el estilo "horizontal" para visualizar verticalmente -->

  <div class="title">Grafico con HTML y CSS que se puede visualizar horizontal o vertical</div>

 

  <div class="grid">
<?php $dad =22; ?>
      <div class="bar" style="--bar-value:<?=$dad?>%;" data-name="asdsad" title="Your Blog 85%"></div>

      <div class="bar" style="--bar-value:23%;" data-name="asd" title="Medium 23%"></div>

      <div class="bar" style="--bar-value:7%;" data-name="asd" title="Tumblr 7%"></div>

      <div class="bar" style="--bar-value:38%;" data-name="asd" title="Facebook 38%"></div>

      <div class="bar" style="--bar-value:35%;" data-name="YouasdsadTube" title="YouTube 35%"></div>

      <div class="bar" style="--bar-value:30%;" data-name="asdnkasdasdedIn" title="LinkedIn 30%"></div>

      <div class="bar" style="--bar-value:5%;" data-name="Twiasdsadasdr" title="Twitter 5%"></div>

      <div class="bar" style="--bar-value:20%;" data-name="asdsadr" title="Other 20%"></div>

  </div>

</div>

 

</body>

</html>