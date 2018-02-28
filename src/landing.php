<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
?>
<?php 
if ($c->getAttribute('header_image')) {
	$ih = Loader::helper('image'); 
	$img = $c->getAttribute('header_image');
	$bg = $ih->getThumbnail($img, 1920, 9999);
	$blocks_main_1 = $c->getBlocks('Main 1');
	$blocks_main_2 = $c->getBlocks('Main 2');
	$blocks_main_3 = $c->getBlocks('Main 3');
	global $u;
?>

<section class="img-bg" style="background-image: url(<?php echo $bg->src;?>);">
<?php } else { ?>
<section class="tint-bg">
  <?php } ?>
  <div class="container inner-top-xs">
    <div class="row">
    <div class="col-sm-12 outer-bottom-xs">
      <?php 
  	$a = new Area('Main');
	$a->display($c);	
	?>    
      </div>
	  <?php if ($blocks_main_1 || $blocks_main_2 || $blocks_main_3 || $u->isLoggedIn()):?>
	  <div class="row">
      <div class="col-sm-6 col-md-4">	  
        <?php 
		$a = new Area('Main 1');
		$a->display($c);	
		?>
		</div>
		<div class="col-sm-6 col-md-4"> 
        <?php 
		$a = new Area('Main 2');
		$a->display($c);?>
		</div>
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-0">
		<?php 
		$a = new Area('Main 3');
		$a->display($c);
		?>
		</div>
		</div>
		<?php endif;?>
		<div class="col-sm-8 center-block">
		<?php 
		$a = new Area('Main 4');
		$a->display($c);
		?>
		</div>
    </div>
  </div>
</section>
<section id="main-section">
  <div class="container inner-xxs">
    <div class="row">
      <div class="col-md-12"><?php  $this->inc('elements/breadcrumbs.php'); ?>
        <?php 
  	$a = new Area('Sectie 1');
	$a->display($c);
?>
      </div>
    </div>
  </div>
</section>
<section class="tint-bg" id="main-section-2">
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
<section class="light-bg" id="main-section-3">
  <div class="container inner-xs">
    <div class="row">     
      <div class="col-md-12">
        <?php 
	  	$a = new Area('Sectie 2 B');
		$a->display($c);
	  ?>     
    </div>
       
  </div>
</section>
<?php 
if ($c->getAttribute('header_image')) {	
?>
<section class="img-bg" style="background-image: url(<?php echo $bg->src;?>);"  id="main-section-4">
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
