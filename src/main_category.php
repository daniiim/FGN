<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$ih = Loader::helper('image');
$title = $c->getCollectionName();
$path = $c->getCollectionPath();
if ($c->getCollectionAttributeValue('category_description')) {
	$description =	$c->getCollectionAttributeValue('category_description');
} else {
	$description =	'<p>'. $c->getCollectionDescription() .'</p>';
}
$query = $_GET['query'];
global $u;
$user_can_place_free_add 	= $_SESSION['user_can_place_free_add'];
$adds_left 					= $_SESSION['adds_left'];
if ($_SESSION['adds_left']) {
	$available_nr_of_adds = $adds_left;
} else {
	$available_nr_of_adds = '0';
}
if ($user_can_place_free_add) {
	$total_available = $available_nr_of_adds + 1;
} else {
	$total_available = $available_nr_of_adds;
}
$img = $c->getAttribute('header_image');
if($img){
    $thumb = $ih->getThumbnail($img, 9999, 9999, false);
  }
$categories_home_page = page::getByID(997);
$total_adds 	= $categories_home_page->getAttribute('nr_adds');
$total_requests = $categories_home_page->getAttribute('nr_requests');

?>
<section class="discover">
  <?php  $this->inc('elements/breadcrumbs.php'); ?>
  <img class="FGN_image" src="<?php echo $this->getThemePath();?>/assets/images/icoon-pi.svg" alt="logo"/>
  <div class="row header no-margin">
    <a href="<?php echo $this->url('/mijn_fgn/advertenties/advertentie_categorie');?>">Advertentie</a>
    <h2>Ontdekken in <?php echo $title; ?></h2>
    <a href="<?php echo $this->url('/mijn_fgn/opdrachten/opdracht_categorie');?>">Opdracht</a>
  </div>
  <div class="row category no-margin">
    <div class="item small-full medium-two-third columns first">
      <div class="category_single">
        <a href="<?php echo $url; ?>" class="full_url"></a>
        <div class="category_single-image"  style="background-image: url('<?php echo $thumb->src; ?>')">
        </div>
        <div class="category_single-footer">
          <div class="category_single-footer_icon <?php echo $pageName; ?>">
            <span class="icon"></span>
          </div>
          <div class="category_single-footer-text">
            <h3 class="category_single-footer-text-title"><?php echo $title; ?></h3>
            <a href="<?php echo $url; ?>" class="category_single-footer-text-url">Categorie bekijken</a>
          </div>
        </div>
      </div>
    </div>
    <div class="side small-full medium-third columns hide-small">
      <div class="category-view">
        <h3>Rubrieken in <?php echo $title; ?></h3>
        <?php for ($i = 0; $i < 6; $i++){
          ?>
          <a href="#" class="category-view_url">Therapie</a>
          <?php
        }?>
      </div>
    </div>
  </div>
</section>
<section class="featured_profile">
  <div class="row no-margin">
    <div class="columns small-full featured_profile-header">
      <div class="featured_profile-header_container">
        <p>
          Uitgelichte profilen in "<?php echo $title; ?>"
        </p>
        <a href="<?php echo $url; ?>" class="featured_profile-header-url">Categorie bekijken</a>
      </div>
    </div>
  </div>
  <div class="row no-margin">
    <div class="columns small-full medium-third featured_profile-account">
      <div class="featured_profile-account-container">
        <div class="featured_profile-account-image">
          <span class="featured_profile-account-image-number">123</span>
        </div>
        <h3 class="featured_profile-account-name">John Doe</h3>
        <div class="featured_profile-account-accountInfo">
          <p>
            <a href="#" class="featured_profile-account-accountInfo_adds">2 advertenties</a> in <a href="#" class="featured_profile-account-accountInfo_place">plaatsnaam</a>
          </p>
        </div>
        <div class="featured_profile-account-infoText">
          <?php $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
          ?>
          <p>
            <?php if(strlen($text) > 80){
              $text = substr($text, 0, 80) . '...';
            }
            echo $text;
            ?>
          </p>
        </div>
        <a class="featured_profile-account-url" href="#">Profiel bekijken</a>
      </div>
    </div>
    <div class="columns small-full medium-third featured_profile-account">
      <div class="featured_profile-account-container">
        <div class="featured_profile-account-image">
          <span class="featured_profile-account-image-number">123</span>
        </div>
        <h3 class="featured_profile-account-name">John Doe</h3>
        <div class="featured_profile-account-accountInfo">
          <p>
            <a href="#" class="featured_profile-account-accountInfo_adds">2 advertenties</a> in <a href="#" class="featured_profile-account-accountInfo_place">plaatsnaam</a>
          </p>
        </div>
        <div class="featured_profile-account-infoText">
          <?php $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
          ?>
          <p>
            <?php if(strlen($text) > 80){
              $text = substr($text, 0, 80) . '...';
            }
            echo $text;
            ?>
          </p>
        </div>
        <a class="featured_profile-account-url" href="#">Profiel bekijken</a>
      </div>
    </div>
    <div class="columns small-full medium-third featured_profile-account">
      <div class="featured_profile-account-container">
        <div class="featured_profile-account-image">
          <span class="featured_profile-account-image-number">123</span>
        </div>
        <h3 class="featured_profile-account-name">John Doe</h3>
        <div class="featured_profile-account-accountInfo">
          <p>
            <a href="#" class="featured_profile-account-accountInfo_adds">2 advertenties</a> in <a href="#" class="featured_profile-account-accountInfo_place">plaatsnaam</a>
          </p>
        </div>
        <div class="featured_profile-account-infoText">
          <?php $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
          ?>
          <p>
            <?php if(strlen($text) > 80){
              $text = substr($text, 0, 80) . '...';
            }
            echo $text;
            ?>
          </p>
        </div>
        <a class="featured_profile-account-url" href="#">Profiel bekijken</a>
      </div>
    </div>
  </div>
</section>
<section class="recentAdds-discover">
  <div class="row no-margin">
    <div class="columns small-full featured_profile-header">
      <div class="featured_profile-header_container">
        <p>
          Uitgelichte opdrachten in "<?php echo $title; ?>"
        </p>
        <a href="<?php echo $url; ?>" class="featured_profile-header-url">Categorie bekijken</a>
      </div>
    </div>
  </div>
  <div class="row no-margin">
    <?php
    for ($x = 0; $x < 2; $x++) {
    ?>
    <div class="columns small-full medium-half recentAdds-container">
      <div class="recentAdds-element">
        <a class="full_url" href="#"></a>
        <div class="recentAdds-element_image">
          <span class="recentAdds-element_image-number">123</span>
        </div>
        <div class="recentAdds-element_info">
          <div class="recentAdds-element_info-header">
            <div class="recentAdds-element_info-header-top">
              <span class="recentAdds-elements_info-header-cost">Gratis</span>
              <h2 class="recentAdds-elements_info-header-title">FeelGood opdracht gevraagd</h2>
            </div>
            <div class="recentAdds-element_info-header-linkInfo">
              <p class="recentAdds-element_info-header-links">
                <a href="#" class="recentAdds-element_info-header-url category">Categorie</a> in <a href="#" class="recentAdds-element_info-header-url place">plaatsnaam</a>
              </p>
            </div>
          </div>
          <div class="recentAdds-element_info-text">
            <p class="recentAdds-element_info-text_information">
              <?php $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
              if(strlen($text) > 150){
                $text = substr($text, 0, 150) . '...';
              }
              echo $text;
              ?>
            </p>
            <p class="recentAdds-element_info-text_date">
              Geplaatst op 1-1-2018
            </p>
          </div>
        </div>
      </a>
      </div>
    </div>
    <?php } ?>
  </div>
</section>
<?php  $this->inc('elements/footer.php'); ?>
