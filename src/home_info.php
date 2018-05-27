<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
$title = $c->getCollectionName();
?>

<div class="inner-xxs">
  <div class="container">
    <div class="row">
    <div class="col-sm-12"> <?php  $this->inc('elements/breadcrumbs.php'); ?></div>
      <div class="col-sm-6 center-block">
        <?php
			$a = new GlobalArea('Sidebar Faq Home kop');
			$a->display();
		?>
      </div>
    </div>
  </div>
</div>
<div class="inner-xs">
  <div class="container">
    <div class="row">
     
      <div class="col-sm-12"> 
        <?php
			$a = new GlobalArea('Faq Home Statisch B');
			$a->display();
		?>
      </div>
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
