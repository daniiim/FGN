<?php
defined('C5_EXECUTE') or die("Access Denied.");
$fh = Loader::helper('filter');

?>

<div class="contentblock clearfix">
  <div class="contentblock-heading">
    <h3>Filters</h3>
  </div>
  <div class="contentblock-body">
  <form class="" action="<?php
echo $fh->getCurrentUrl();
?>" method="get">
    <?php
if ($_GET['product_days']) {
    $expanded      = 'true';
    $css_link      = null;
    $css_container = 'in';
} else {
    $expanded      = 'false';
    $css_link      = 'collapsed';
    $css_container = null;
}

?>
    <div class="filterblock-sidebar"><a class="<?php
echo $css_link;
?>" role="button" data-toggle="collapse" href="#beschikbaarheid" aria-expanded="<?php
echo $expanded;
?>"><span class="fa fa-calendar"></span> Beschikbaarheid <span class="fa 
fa-angle-double-down pull-right"></span> </a>
      <div class="collapse <?php
echo $css_container;
?>" id="beschikbaarheid" aria-expanded="<?php
echo $expanded;
?>">
        <?php
$days = $fh->getWeekdays();
foreach ($days as $day):;
    $day_short = substr($day, 0, 2);
    if (is_array($_GET['product_days']) && in_array($day, $_GET['product_days'])) {
        $checked = 'checked="checked"';
    } else {
        $checked = NULL;
    }
?>
        <label>
          <input type="checkbox" <?php
    echo $checked;
?> name="product_days[]" value="<?php
    echo $day;
?>">
          <?php
    echo $day_short;
?>
        </label>
        <?php
endforeach;
?>
          <p class="small>">Exact zoeken</p>
          <input type="radio" name="product_days_exact" <?php
if (!$fh->getvar_days_exact()) {
    echo 'checked="checked"';
}
?>  value="0">
          Uit
          </label>
          <input type="radio" name="product_days_exact" <?php
if ($fh->getvar_days_exact()) {
    echo 'checked="checked"';
}
?>  value="1">
          Aan
          </label>
      </div>
    </div>
    <?php
if ($fh->getvar_sex()) {
    $expanded      = 'true';
    $css_link      = null;
    $css_container = 'in';
} else {
    $expanded      = 'false';
    $css_link      = 'collapsed';
    $css_container = null;
}

?>
    <div class="filterblock-sidebar"><a class="<?php
echo $css_link;
?>" role="button" data-toggle="collapse" href="#geslacht" aria-expanded="<?php
echo $expanded;
?>"><span class="fa fa-venus-mars"></span> Geslacht <span class="fa 
fa-angle-double-down pull-right"></span> </a>
      <div class="collapse <?php
echo $css_container;
?>" id="geslacht" aria-expanded="<?php
echo $expanded;
?>">
        <label>
          <input type="radio" name="user_sex" value="0" <?php
if (!$fh->getvar_sex()) {
    echo 'checked="checked"';
}
?>>
          Onbelangrijk </label>
        <?php
$items = $fh->getSexes();
foreach ($items as $item):
?>
        <?php
    if ($fh->getvar_sex() && $fh->getvar_sex() == $item) {
        $checked = 'checked="checked"';
    } else {
        $checked = NULL;
    }
?>
        <label>
          <input type="radio" name="user_sex" <?php
    echo $checked;
?>  value="<?php
    echo $item;
?>">
          <?php
    echo $item;
?>
        </label>
        <?php
endforeach;
?>
      </div>
    </div>
    <?php
if ($fh->getvar_diploma()) {
    $expanded      = 'true';
    $css_link      = null;
    $css_container = 'in';
} else {
    $expanded      = 'false';
    $css_link      = 'collapsed';
    $css_container = null;
}

?>
    <div class="filterblock-sidebar"><a class="<?php
echo $css_link;
?>" role="button" data-toggle="collapse" href="#diploma" aria-expanded="<?php
echo $expanded;
?>"><span class="fa fa-graduation-cap"></span> Diploma <span class="fa 
fa-angle-double-down pull-right"></span> </a>
      <div class="collapse <?php
echo $css_container;
?>" id="diploma" aria-expanded="<?php
echo $expanded;
?>">
        <p><small>Geef aan of u wilt dat de aanbieder van de dienst gediplomeerd is</small></p>
        <?php

if ($fh->getvar_diploma()) {
    $checked = 'checked="checked"';
    
    ;
} else {
    $checked = NULL;
    
}
?>
        <label>
          <input type="checkbox" <?php
echo $checked;
?> name="product_diploma" value="1">
          Ja </label>
      </div>
    </div>
    <?php
if ($fh->getvar_price_negotiation()) {
    $expanded      = 'true';
    $css_link      = null;
    $css_container = 'in';
} else {
    $expanded      = 'false';
    $css_link      = 'collapsed';
    $css_container = null;
}

?>
    <div class="filterblock-sidebar"><a class="<?php
echo $css_link;
?>" role="button" data-toggle="collapse" href="#prijs" aria-expanded="<?php
echo $expanded;
?>"><span class="fa fa-euro"></span> Prijs <span class="fa 
fa-angle-double-down pull-right"></span> </a>
      <div class="collapse <?php
echo $css_container;
?>" id="prijs" aria-expanded="<?php
echo $expanded;
?>">
        <p><small>Geef uw voorkeuren aan</small></p>
        <?php

if ($fh->getvar_price_negotiation()) {
    $checked = 'checked="checked"';
    
    ;
} else {
    $checked = NULL;
    
}
?>
        <label>
          <input type="checkbox" <?php
echo $checked;
?> name="product_price_negotiation" value="1">
          Flexibel (ik wil kunnen onderhandelen over de prijs) </label>
        <script src="<?php
echo $this->getThemePath();
?>/assets/js/jquery-ui.min.js"></script> 
        <script>
  $(function() {
    $( "#slider-range-max" ).slider({
      range: "max",
      min: 1,
      max: 100,
      value: 2,
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.value );
      }
    });
    $( "#amount" ).val( $( "#slider-range-max" ).slider( "value" ) );
  });
  </script>
        <p>
          <label for="amount">Maximale prijs &euro;</label>
          <input type="text" id="amount" name="test" size="3" readonly>
        </p>
        <div id="slider-range-max"></div>
      </div>
    </div>
    <?php
if ($fh->getvar_state()) {
    echo '<input type="hidden" name="product_location_state_nl" value="' . $fh->getvar_state() . '">';
}
if ($fh->getvar_city()) {
    echo '<input type="hidden" name="product_location_city" value="' . $fh->getvar_city() . '">';
}
?>
    <button class="btn btn-info btn-xl btn-block" type="submit">Zoek</button>
  </form>
</div>
</div>
