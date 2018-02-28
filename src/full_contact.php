<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
?>
<div class="container inner-xxs">
  <div class="row">
    <div class="col-lg-12"><?php  $this->inc('elements/breadcrumbs.php'); ?>
      <?php 
	  	$a = new Area('Main');
		$a->display($c);
	  ?>
    </div>
  </div>
</div>
<section id="help-form-section" class="darker-bg">
  <div class="container inner-xs">
    <div class="row">
      <div class="col-sm-8">
      <section class="light-bg inner-xs inner-left-xs inner-right-xs">

        <?php
			$a = new GlobalArea('Contact Help Form');
			$a->display();
		?></section>
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
