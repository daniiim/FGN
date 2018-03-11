<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$nr_of_adds = 0;
$nr_of_requests = 0;
$nr_of_adds = $c->getAttribute('category_nr_adds');
$nr_of_requests = $c->getAttribute('category_nr_requests');
?>
<?php  $this->inc('elements/breadcrumbs.php'); ?>
<a class="no-wrap-ellipses" id="anchor-adds" href="#tab-adds"><span class="red"><i class="icon-search"></i> <span class="hidden-sm hidden-xs">Bekijk </span>advertenties</span></a>
<a class="no-wrap-ellipses" id="anchor_req" href="#tab-requests"><span class="blue"><i class="icon-search"></i> <span class="hidden-sm hidden-xs">Bekijk </span>opdrachten</span></a>
<a class="btn btn-red" href="<?php echo $this->url('/mijn_fgn/advertenties/advertentie_categorie');?>"><i class="icon-pencil"></i> Plaats advertentie</a>
<a class="btn btn-blue" href="<?php echo $this->url('/mijn_fgn/opdrachten/opdracht_categorie');?>"><i class="icon-pencil"></i> Plaats opdracht</a>
<?php
$a = new GlobalArea('Sub Categorieën Hoofd');
$a->display();
?>
<!--
<?php
if (!$_GET['search_type'] || $_GET['search_type'] == 'adds') {
	$default_tab = 'adds-tab-select';
} else if ($_GET['search_type'] == 'request') {
	$default_tab = 'request-tab-select';
}
?> -->

<?php  $this->inc('elements/footer.php'); ?>
