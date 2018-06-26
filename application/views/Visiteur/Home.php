<?php echo img("Panneau.png"); ?>
<h1> SITE EN CONSTRUCTION !!!!!</h1>

<div class="container Pub">
  <h2>Nos chantiers</h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php
    $i=0;
    foreach ($Chantiers as $value) {
      if($value['IMAGEAVANT'] && $value['IMAGEAPRES'])
      {
        if($i==0)
        {
          echo '<li data-target="#myCarousel" data-slide-to="' . $i . '" class="active"></li>';
        }
        else
        {
          echo '<li data-target="#myCarousel" data-slide-to="' . $i . '"></li>';
        }
        $i+=1;
      }
    }
    ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner Images">
    <?php
    $i=0;
    foreach ($Chantiers as $value) {
      if($value['IMAGEAVANT'] && $value['IMAGEAPRES'])
      {
        if($i==0)
        {
          echo '<div class="item active">';
          echo img($value['IMAGEAPRES'], 'Après', array('class'=>'ImageApres'));
          echo '</div>';
        }
        else
        {
          echo '<div class="item">';
          echo img($value['IMAGEAPRES'], 'Après', array('class'=>'ImageApres'));
          echo '</div>';
        }
        $i+=1;
      }
    }
    ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>