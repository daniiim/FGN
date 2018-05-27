<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php
global $u;
$group = $u->getUserGroups();
if (in_array('Administrators',$group)) {
	$isAdministrator = true; //misschien een functie voor maken, duh
}
$address = $_GET['address'];
$radius = $_GET['radius'];
$query = $_GET['query'];
$nh = Loader::helper('navigation');
$categories_home_page = page::getByID(997);
$children = $categories_home_page->getCollectionChildrenArray(1);
$sub_categories = array();
foreach ($children as $value) {
  $ChildrenPage = page::getByID($value);
  $subChildren = $ChildrenPage->getCollectionChildrenArray(1);
  $category = $ChildrenPage->getCollectionName();
  if($name !== 'Alle resultaten'){
    array_push($sub_categories, $category);
  }
  foreach ($subChildren as $subChildrenP) {
    $subChildrenPage = page::getByID($subChildrenP);
    $name = $subChildrenPage->getCollectionName();
    if($name !== 'Alle resultaten'){
      array_push($sub_categories, $name);
    }
  }
}
?>
<section class="search-popup">
  <form action="<?php echo $this->url( '/zoek_resultaten' )?>" method="get" class="search-container clearfix form-inline" autocomplete="off">
    <input required list="category" name="query" type="text" placeholder="Wat zoek je?" value="<?php echo $query;?>">
    <!-- <datalist id="category">
      <?php
      foreach ($sub_categories as $sub) {
        ?>
        <option value="<?php echo $sub; ?>">
        <?php
      }
      ?>
    </datalist> -->
    <button name="submit" type="submit" class="button">Zoeken</button>
  </form>
</section>
