<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$ih = loader::helper('image');
$a = new Area('Header');
$a->display($c);
$a = new Area('Why FGN');
$a->display($c);
?>
<section class="joinFGN light">
  <div class="row-small">
    <?php
    $a = new Area('Join FGN Text');
    $a->display($c);
    ?>
  </div>
  <div class="row">
    <?php
    $a = new Area('Join FGN');
    $a->display($c);
    ?>
  </div>
</section>
<?php
$categories_home_page = page::getByID(997);
$nh = Loader::helper('navigation');
$url_categorie = $nh->getLinkToCollection($categories_home_page);
$children = $categories_home_page->getCollectionChildrenArray(1);
function debug($data){
  print_r('<pre>');
  print_r($data);
  print_r('</pre>');
}
$uh = Loader::helper('url');
$ih = Loader::helper('image');
$nh = Loader::helper('navigation');
$aih = new AddImagesHelper();
  // $ownerID = $subChildrenPage->getCollectionUserID();
  // $ui = UserInfo::getByID($ownerID);
$allPosts = array();
$sortedArray = $allPosts;
?>
<section class="featured_profile dark">
  <div class="row-small">
    <?php
    $a = new Area('Join FGN Text 2');
    $a->display($c);
    ?>
  </div>
  <div class="row">
    <?php
    $a = new Area('Home profiles');
    $a->display($c);
    ?>
    <a class="all_profiles button" href="<?php echo $url_categorie; ?>">Naar alle categorieen</a>
  </div>
</section>

<section class="recentAdds">
  <div class="row-small">
    <?php
    $a = new Area('Join FGN Text 3');
    $a->display($c);
    ?>
  </div>
  <div class="row">
    <?php
    $a = new Area('Home requests');
    $a->display($c);
    ?>
    <a class="all_profiles button" href="<?php echo $url_categorie; ?>">Naar alle categorieen</a>
  </div>
</section>
<section class="recentAdds dark">
  <div class="row-small">
    <?php
    $a = new Area('Join FGN Text 4');
    $a->display($c);
    ?>
  </div>
  <div class="row">
    <?php
    $a = new Area('Home adds');
    $a->display($c);
    ?>
    <a class="all_profiles button" href="<?php echo $url_categorie; ?>">Naar alle categorieen</a>
  </div>
</section>
<?php  $this->inc('elements/footer.php'); ?>
