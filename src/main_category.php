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
$uh = Loader::helper('url');
$ih = Loader::helper('image');
$nh = Loader::helper('navigation');
$aih = new AddImagesHelper();
$categories_home_page = page::getByID(997);
$total_adds 	= $categories_home_page->getAttribute('nr_adds');
$total_requests = $categories_home_page->getAttribute('nr_requests');
$page = Page::getCurrentPage();
$page->getCollectionID();
$children = $page->getCollectionChildrenArray(1);
$category = $page->getCollectionName();
$allPosts = array();
$i = 0;
foreach ($children as $key) {
  $p = page::getByID($key);
  $childrenP = $p->getCollectionChildrenArray(1);
  foreach ($childrenP as $lastPageSub) {
    $i++;
    if($i > -1){
      $last = page::getByID($lastPageSub);
      if($last->getAttribute('add_or_request') === "Advertentie"){
        $ownerID = $last->getCollectionUserID();
        $ui = UserInfo::getByID($ownerID);
        $uiImage = $ui->getAttribute('profile_image');
        $userUrl = $this->url('/gebruiker');
        $userUrl .= '?gebruiker=';
        $userUrl .= $ownerID;
        $ed = $ui->getAttribute('education');
        $carreerValues = array();
        if(is_object($last->getAttribute('product_career_level'))){
          $careeer = $last->getAttribute('product_career_level');
          foreach ($careeer as $key) {
            array_push($carreerValues, $key->value);
          }
        }
        if(is_object($ed)){
          $edOptions = $ed->getOptions();
          $edValues = array();
          foreach ($edOptions as $key) {
            array_push($edValues, $key->value);
          }
        }
        Loader::model('page_list');
        $upla = new PageList();
        $upla->filterByCollectionTypeHandle('product');
        $upla->filterByUserID($ownerID);
        $upla->filterByProductPaused(0);
        $upagesa = $upla->get($itemsToGet = 2, $offset = 0) ;	//we willen weten of er meer als 1 advertentie is
        $hasMoreThanOneAdd = false;
        if (count($upagesa) > 0) {
        $hasMoreThanOneAdd = true;
        }

        Loader::model('page_list');
        $uplr = new PageList();
        $uplr->filterByCollectionTypeHandle('request');
        $uplr->filterByUserID($ownerID);
        $uplr->filterByProductPaused(0);
        $upagesr = $uplr->get($itemsToGet = 2, $offset = 0) ;	//we willen weten of er meer als 1 advertentie is
        $hasMoreThanOneRequest = false;
        if (count($upagesr) > 0) {
        $hasMoreThanOneRequest = true;
        }
        $imgProduct = $aih->getFirstImageInSet($lastPageSub);
        $thumbProduct = $ih->getThumbnail($imgProduct, 9999, 9999, false);
        $fullName = $ui->getAttribute('first_name') . ' ';
        if($ui->getAttribute('name_extra')){
          $fullName .= $ui->getAttribute('name_extra') . ' ';
        }
        $fullName .= $ui->getAttribute('sir_name');
        $smallArray = array(
          "title" => $last->getCollectionName(),
          "key" => $last->getAttribute('add_or_request'),
          "id" => $lastPageSub,
          "user" => array(
            "userName" => $ui->getAttribute('first_name'),
            "tussen" => $ui->getAttribute('name_extra'),
            "sirName" => $ui->getAttribute('sir_name'),
            "fullName" => $fullName,
            "userBirth" => date('d/m/Y', strtotime($ui->getAttribute('birth'))),
            "info" => $ui->getAttribute('user_about'),
            "image" => $ih->getThumbnail($uiImage, 9999, 9999, false),
            "educaton" => $edValues,
            "url" => $userUrl,
            "adds_amount" => count($upagesa),
            "request_amount" => count($upagesr),
          ),
          "description" => $last->getAttribute('product_long_description'),
          "activeDate" => $last->getAttribute('product_date_valid'),
          "place" => $last->getAttribute('address_city'),
          "date" => $last->getCollectionDateAdded('F j, Y'),
          "activeCategory" => $last->getCollectionName(),
          "category" => $category,
          "categoryTop" => $categoryTopName,
          "image" => $thumbProduct,
          "careerLvl" => $carreerValues,
          "url" => $nh->getLinkToCollection($last),
          "price" => $last->getAttribute('product_price_value')
        );
        if ($last->getAttribute('add_or_request') == 'Advertentie'){
          $addsTotal = $addsTotal + 1;
          $totalAdd++;
        }
        elseif($last->getAttribute('add_or_request') == 'Opdracht'){
          $reqTotal = $reqTotal + 1;
          $totalReq++;
        }
        array_push($allPosts, $smallArray);
        if($last->getAttribute('add_or_request') === 'Opdracht'){
          $i++;
        }
        else{
          $l++;
        }
      }
    }
    else{
      break 2;
    }
  }
}
function debug($data){
  print_r('<pre>');
  print_r($data);
  print_r('</pre>');
}
function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

$sortedArray = array_sort($allPosts, 'date', SORT_DESC);
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
  <?php
  $allUrl = '';
  foreach ($children as $childId) {
    $child = Page::getByID($childId);
    if($child->getCollectionName() == "Alle resultaten"){
      $allUrl = $nh->getLinkToCollection($child);
    }
  }
  ?>
  <div class="row category no-margin">
    <div class="item small-full medium-two-third columns first">
      <div class="category_single">
        <a href="<?php echo $allUrl; ?>" class="full_url"></a>
        <div class="category_single-image"  style="background-image: url('<?php echo $thumb->src; ?>')">
        </div>
        <div class="category_single-footer">
          <div class="category_single-footer_icon <?php echo $pageName; ?>">
            <span class="icon"></span>
          </div>
          <div class="category_single-footer-text">
            <h3 class="category_single-footer-text-title"><?php echo $title; ?></h3>
            <a href="<?php echo $allUrl; ?>" class="category_single-footer-text-url">Categorie bekijken</a>
          </div>
        </div>
      </div>
    </div>
    <div class="side small-full medium-third columns hide-small">
      <div class="category-view">
        <h3>Rubrieken in <?php echo $title; ?></h3>
        <?php $i = 0; ?>
        <?php foreach ($children as $childId) {
          $i++;
          if($i < 10){
            $child = Page::getByID($childId);
            if($child->getCollectionName() !== "Alle resultaten"){
              $urlChild  = $nh->getLinkToCollection($child);
              ?>
              <a href="<?php echo $urlChild; ?>" class="category-view_url"><?php echo $child->getCollectionName(); ?></a>
              <?php
            }
          }
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
        <a href="<?php echo $allUrl; ?>" class="featured_profile-header-url">Categorie bekijken</a>
      </div>
    </div>
  </div>
  <div class="row no-margin">
    <?php
    $i = 0;
    $userArray = array();
    foreach ($sortedArray as $value) {
      if(!in_array($value['user']['fullName'], $userArray)){
        $i++;
        array_push($userArray, $value['user']['fullName']);
        if($i < 4){
          $name = $value['category'];
          $nameArray = explode(" ", $name);
          $name2 = strtolower($nameArray[0]);
          ?>
          <div class="columns small-full medium-third featured_profile-account <?php echo $name2; ?>">
            <div class="featured_profile-account-container">
              <a href="<?php echo $value['user']['url']; ?>" class="user_url-full"></a>
              <div class="featured_profile-account-image" style="background-image: url('<?php echo $value['user']['image']->src; ?>')">
                <span class="featured_profile-account-image-number">123</span>
              </div>
              <h3 class="featured_profile-account-name"><?php echo $value['user']['fullName'];?></h3>
              <div class="featured_profile-account-accountInfo">
                <p>
                  <a href="<?php echo $value['user']['url']; ?>" class="featured_profile-account-accountInfo_adds">
                    <?php echo $value['user']['adds_amount']; ?> advertenties</a>
                </p>
              </div>
              <div class="featured_profile-account-infoText">
                <p>
                  <?php $text = $value['description'];
                  if(strlen($text) > 150){
                    $text = substr($text, 0, 150) . '...';
                  }
                  echo $text;
                  ?>
                </p>
              </div>
              <a href="<?php echo $value['user']['url']; ?>" class="featured_profile-account-url">Profiel bekijken</a>
            </div>
          </div>
        <?php }
      }
    }
    ?>
  </div>
</section>
<section class="recentAdds-discover">
  <div class="row no-margin">
    <div class="columns small-full featured_profile-header">
      <div class="featured_profile-header_container">
        <p>
          Uitgelichte opdrachten in "<?php echo $title; ?>"
        </p>
        <a href="<?php echo $allUrl; ?>" class="featured_profile-header-url">Categorie bekijken</a>
      </div>
    </div>
  </div>
  <div class="row no-margin">
    <?php
    $i = 0;
    foreach ($sortedArray as $value) {
      $i++;
      if($i < 3){
        $name = $value['category'];
        $nameArray = explode(" ", $name);
        $name2 = strtolower($nameArray[0]);
        ?>
        <div class="columns small-full medium-half recentAdds-container <?php echo $name2; ?>">
          <div class="recentAdds-element">
            <a class="full_url" href="<?php echo $value['url'];?>"></a>
            <div class="recentAdds-element_image" style="background-image: url('<?php echo $value['image']->src; ?>')" >
              <span class="recentAdds-element_image-number">123</span>
            </div>
            <div class="recentAdds-element_info">
              <div class="recentAdds-element_info-header">
                <div class="recentAdds-element_info-header-top">
                  <span class="recentAdds-elements_info-header-cost">
                    <?php
                    $price = 'gratis';
                     if($value['price'] == 0){
                      echo 'gratis'; }
                      else{
                        echo '€ ' . $value['price'];
                      }?>
                  </span>
                  <h2 class="recentAdds-elements_info-header-title"><?php echo $value['title']; ?></h2>
                </div>
                <div class="recentAdds-element_info-header-linkInfo">
                  <p class="recentAdds-element_info-header-links">
                    <a href="<?php echo $value['url'];?>" class="recentAdds-element_info-header-url category"><?php echo $value['category']; ?></a>
                  </p>
                </div>
              </div>
              <div class="recentAdds-element_info-text">
                <p class="recentAdds-element_info-text_information">
                  <?php $text = $value['description'];
                  if(strlen($text) > 150){
                    $text = substr($text, 0, 150) . '...';
                  }
                  echo $text;
                  ?>
                </p>
                <p class="recentAdds-element_info-text_date">
                  <?php echo $value['date']; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      <?php }
    }?>
  </div>
</section>
<?php  $this->inc('elements/footer.php'); ?>
