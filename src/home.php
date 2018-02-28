<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$bg = $c->getAttribute('header_image');
?>
<?php
$ih = loader::helper('image');
$bg_src = $ih->getThumbnail($bg, 1920, 9999, true);
?>
<!-- <section id="pattern-background-3" class="img-bg-soft raleway" style="background-image: url(<?php echo $bg_src->src ?>);"> -->
  <!-- <div class="container inner-xxs">
    <div class="row">
      <div class="col-sm-12">
        <?php
    	  $a = new Area('Main');
  	    $a->display($c); ?>
      </div>
       -->
<section class="landingPage">
  <h2 class="title">Geld verdienen kan slimmer!</h2>
  <form>
    <input placeholder="Zoek een FeelGood dienst" type="text"/>
    <button class="search-page">Zoeken</button>
  </form>
</section>
<?php  require('elements/whyFGN.php'); ?>
<?php  require('elements/join_fgn.php'); ?>
<?php  require('elements/uitgelichte_profielen.php'); ?>

<section class="recentAdds">
  <div class="row-small">
    <h4 class="title">Uitgelichte profielen van aanbieders</h4>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </div>
  <div class="row">
    <?php
    for ($x = 0; $x < 3; $x++) {
    ?>
    <div class="columns small-full medium-two-third recentAdds-container">
      <div class="recentAdds-element">
        <a class="full_url" href="#"></a>
        <div class="recentAdds-element_image">
          <span class="recentAdds-element_image-number">123</span>
        </div>
        <div class="recentAdds-element_info">
          <div class="recentAdds-element_info-header">
            <div class="recentAdds-element_info-header-top">
              <span class="recentAdds-elements_info-header-cost">Gratis</span>
              <h2 class="recentAdds-elements_info-header-title">FeelGood opdracht gevraagd</h2>
            </div>
            <div class="recentAdds-element_info-header-linkInfo">
              <p class="recentAdds-element_info-header-links">
                <a href="#" class="recentAdds-element_info-header-url category">Categorie</a> in <a href="#" class="recentAdds-element_info-header-url place">plaatsnaam</a>
              </p>
            </div>
          </div>
          <div class="recentAdds-element_info-text">
            <p class="recentAdds-element_info-text_information">
              <?php $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
              if(strlen($text) > 150){
                $text = substr($text, 0, 150) . '...';
              }
              echo $text;
              ?>
            </p>
            <p class="recentAdds-element_info-text_date">
              Geplaatst op 1-1-2018
            </p>
          </div>
        </div>
      </a>
      </div>
    </div>
  <?php } ?>
    <a class="all_profiles button" href="#">Naar alle opdrachten</a>
  </div>
</section>
<?php  $this->inc('elements/footer.php'); ?>
