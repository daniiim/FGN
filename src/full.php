<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
?>

<div class="container inner-xs">
  <div class="row">
    <div class="col-lg-12">
  	<?php  $this->inc('elements/breadcrumbs.php'); ?>
  	<?php
  	$a = new Area('Main');
  	$a->display($c);
  	?>
  	</div>
  </div>
</div>
<?php  $this->inc('elements/footer.php'); ?>
