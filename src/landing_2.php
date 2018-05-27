<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
?>
<?php 
if ($c->getAttribute('header_image')) {
	$ih = Loader::helper('image'); 
	$img = $c->getAttribute('header_image');
	$bg = $ih->getThumbnail($img, 1920, 9999);
?>

<section class="img-bg" style="background-image: url(<?php echo $bg->src;?>);">
<?php } else { ?>
<section class="tint-bg">
  <?php } ?>
  <div class="container inner-top">
    <div class="row">
      <div class="col-sm-12">
        <div class="tint-bg inner-xs inner-left-xs inner-right-xs">
          <?php 
  	$a = new Area('Main');
	$a->display($c);
	
?>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container inner-xxs">
    <div class="row">
    <div class="col-md-12 outer-bottom-xxs"><?php  $this->inc('elements/breadcrumbs.php'); ?></div>
      <div class="col-md-4">
        <?php 
  	$a = new Area('Sectie 1 A');
	$a->display($c);
?>
      </div>
      <div class="col-md-4">
        <?php 
  	$a = new Area('Sectie 1 B');
	$a->display($c);
?>
      </div>
      <div class="col-md-4">
        <?php 
  	$a = new Area('Sectie 1 C');
	$a->display($c);
?>
      </div>
    </div>
  </div>
</section>
<section style="background-image: url(<?php echo $this->getThemePath()?>/assets/images/art/pattern-background03.png);" class="dark-bg img-bg-softer" id="pattern-background-3">
  <div class="container inner-xs">
    <div class="row">
      <div class="col-md-12">
        <?php 
	  	$a = new Area('Sectie 2 A');
		$a->display($c);
	  ?>
      </div>
    </div>
  </div>
</section>
<section class="light-bg">
  <div class="container inner-xs">
  <div class="row">
    <div class="col-md-12">
      <?php 
	  	$a = new Area('Sectie 2 B');
		$a->display($c);
	  ?>
    </div>
    <div class="col-md-8 center-block">
      <?php
			$a = new GlobalArea('Lead 2');
			$a->display();
		?>
    </div>
  </div>
</section>
<?php 
if ($c->getAttribute('header_image')) {	
?>
<section class="img-bg img-bg-soft" style="background-image: url(<?php echo $bg->src;?>);">
<?php } else { ?>
<section class="tint-bg">
  <?php } ?>
  <div class="container inner-xs">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <?php 
			$a = new Area('Sectie 3');
			$a->display($c); 
		?>
      </div>      
    </div>   
  </div>  
</section>
<section id="help-form-section" class="darker-bg">
  <div class="container inner-xs">
    <div class="row">
      <div class="col-sm-8">
        <section class="light-bg inner-xs inner-left-xs inner-right-xs">
          <?php
			$a = new GlobalArea('Contact Help Form');
			$a->display();
		?>
        </section>
      </div>
      <div class="col-sm-4">
        <?php
			$a = new GlobalArea('Contact Help Intro');
			$a->display();
		?>
      </div>
    </div>
  </div>
</section>
<?php  $this->inc('elements/categories.php'); ?>
<?php  $this->inc('elements/footer.php'); ?>
