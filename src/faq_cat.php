<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
$title = $c->getCollectionName();
?>
<div class="container inner-xs">
  <div class="row">
  <div class="col-sm-12"><?php  $this->inc('elements/breadcrumbs.php'); ?>
      <?php
			$a = new GlobalArea('Sidebar Faq Categorie kop');
			$a->display();
		?>
    </div>
    <div class="col-sm-4">
      <?php
			$a = new GlobalArea('Sidebar Faq Categorie Statisch A');
			$a->display();
		?>
    </div>
    <div class="col-sm-8">
    <h1><?php echo $title;?></h1>
      <?php
			$a = new GlobalArea('Faq Categorie Statisch');
			$a->display();
		?>
    </div>
  </div>
</div>
<?php  $this->inc('elements/categories.php'); ?>
<?php  $this->inc('elements/footer.php'); ?>
