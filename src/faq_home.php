<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
$title = $c->getCollectionName();
?>
<div class="light-bg shadow-in-top inner-xs">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 center-block">
        <?php
			$a = new GlobalArea('Sidebar Faq Home kop');
			$a->display();
		?>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php  $this->inc('elements/breadcrumbs.php'); ?>
    </div>    
    <div class="col-sm-8 center-block">
      <?php
			$a = new GlobalArea('Faq Home Statisch');
			$a->display();
		?>
    </div>
    
  </div>
</div>

<div class="light-bg inner-xs">
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
<?php  $this->inc('elements/categories.php'); ?>
<?php  $this->inc('elements/footer.php'); ?>
