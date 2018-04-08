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
$i = 0;
foreach ($children as $value) {
  $ChildrenPage = page::getByID($value);
  $subChildren = $ChildrenPage->getCollectionChildrenArray(1);
  $category = $ChildrenPage->getCollectionName();
  foreach ($subChildren as $subChildrenP) {
    $subChildrenPage = page::getByID($subChildrenP);
    $lastPage = $subChildrenPage->getCollectionChildrenArray(1);
    foreach ($lastPage as $lastPageSub) {
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
<section class="featured_profile dark">
  <div class="row-small">
    <h4 class="title">Uitgelichte profielen van aanbieders</h4>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </div>
  <div class="row">
    <?php
    $i = 0;
    $userArray = array();
    foreach ($sortedArray as $key => $value) {
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
        <?php
        }
      }
    }
    ?>
    <a class="all_profiles button" href="<?php echo $url_categorie; ?>">Naar alle profielen</a>
  </div>
</section>

<section class="recentAdds">
  <div class="row-small">
    <h4 class="title">Uitgelichte profielen van aanbieders</h4>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </div>
  <div class="row">
    <?php
    $i = 0;
    foreach ($sortedArray as $key => $value) {
      $i++;

      if($i < 4){
        $name = $value['category'];
        $nameArray = explode(" ", $name);
        $name2 = strtolower($nameArray[0]);
        ?>
        <div class="columns small-full medium-two-third recentAdds-container <?php echo $name2; ?>">
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
    <?php
      }
    } ?>
    <a class="all_profiles button" href="<?php echo $url_categorie; ?>">Naar alle opdrachten</a>
  </div>
</section>
<?php  $this->inc('elements/footer.php'); ?>
