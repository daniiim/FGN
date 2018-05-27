<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
?>
<section class="discover">
  <?php  $this->inc('elements/breadcrumbs.php'); ?>
  <?php
  $a = new Area('Main');
  $a->display($c);
  ?>
</section>
<?php  $this->inc('elements/footer.php'); ?>
