<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$ih = Loader::helper('image');
$nh = Loader::helper('navigation');
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
$page = Page::getCurrentPage();
$page->getCollectionID();
$children = $page->getCollectionChildrenArray(1);
?>
<section class="discover">
  <?php  $this->inc('elements/breadcrumbs.php'); ?>
	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 254.1 254.1" style="enable-background:new 0 0 254.1 254.1;" xml:space="preserve">
	<g id="Laag_2">
		<g id="Laag_1-2">
			<path class="st0" d="M127,0C56.9,0,0,56.9,0,127s56.9,127,127,127s127-56.9,127-127S197.1,0,127,0z M76.7,105H40.9v17.9h32.8v13.7
				H40.9v27.5H24.5V91.4h52.2L76.7,105z M120.9,150.5c4.4,0,9.6-1.6,14.2-3.9v-19.1h14.2v27.9c-7.7,5.6-19.4,9.4-29.5,9.4
				c-22,0-38.7-16-38.7-37.1s17-36.9,39.7-36.9c10.8,0,21.8,4.2,29.2,10.6l-9.2,11.7c-5.4-5-12.5-7.9-19.9-8.1
				c-12.5-0.2-22.9,9.7-23.1,22.3c-0.2,12.5,9.7,22.9,22.3,23.1C120.3,150.5,120.6,150.5,120.9,150.5L120.9,150.5z M214.6,164.1
				l-35.2-46.6v46.6h-15.7V91.4h15l35.3,46.7V91.4h15.6v72.7L214.6,164.1z"/>
		</g>
	</g>
	</svg>


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
        <?php foreach ($children as $childId) {
          $child = Page::getByID($childId);
          $urlChild  = $nh->getLinkToCollection($child);
          ?>
          <a href="<?php echo $urlChild; ?>" class="category-view_url"><?php echo $child->getCollectionName(); ?></a>
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
