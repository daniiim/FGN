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
$cPage = Page::getCurrentPage();
$categoryPageId = $cPage->getCollectionParentID();
$categoryPage = page::getByID($categoryPageId);
$children = $categoryPage->getCollectionChildrenArray();
$array = array();
$uh = Loader::helper('url');
foreach ($children as $key) {
  $subPage = page::getByID($key);
  $childrenSubPage = $subPage->getCollectionChildrenArray();
  foreach ($childrenSubPage as $subChildren) {
    $subChildrenPage = page::getByID($subChildren);
    $ownerID = $subChildrenPage->getCollectionUserID();
    $ui = UserInfo::getByID($ownerID);
    $smallArray = array(
      "title" => $subChildrenPage->getCollectionName(),
      "key" => $subChildrenPage->getAttribute('add_or_request'),
      "userName" => $ui->getAttribute('first_name'),
      "sirName" => $ui->getAttribute('sir_name'),
      "userBirth" => date('d/m/Y', strtotime($ui->getAttribute('birth'))),
      "description" => $subChildrenPage->getAttribute('product_long_description'),

    );
    array_push($array, $smallArray);
  }
}
print_r($array);


if (!$_GET['search_type'] || $_GET['search_type'] == 'adds') {
	$default_tab = 'adds-tab-select';
} else if ($_GET['search_type'] == 'request') {
	$default_tab = 'request-tab-select';
}
?>

<?php  $this->inc('elements/footer.php'); ?>
