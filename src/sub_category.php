<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$nr_of_adds = 0;
$nr_of_requests = 0;
$nr_of_adds = $c->getAttribute('category_nr_adds');
$nr_of_requests = $c->getAttribute('category_nr_requests');
?>
<?php  $this->inc('elements/breadcrumbs.php');
$cPage = Page::getCurrentPage();
$categoryPageId = $cPage->getCollectionParentID();
$categoryPage = page::getByID($categoryPageId);
$categoryTopName = $categoryPage->getCollectionName();
$children = $categoryPage->getCollectionChildrenArray(1);
$array = array();
$uh = Loader::helper('url');
$ih = Loader::helper('image');
$nh = Loader::helper('navigation');
$aih = new AddImagesHelper();
$addsTotal = 0;
$reqTotal = 0;
function debug($data){
  print_r('<pre>');
  print_r($data);
  print_r('</pre>');
}
$allCategory = array();
$dontInclude = array();
$totalReq = 0;
$totalAdd = 0;
foreach ($children as $key) {
  $subPage = page::getByID($key);
  $childrenSubPage = $subPage->getCollectionChildrenArray();
  $category = $subPage->getCollectionName();
  $i = 0;
  $l = 0;
  if($category !== "Alle resultaten" ){
    foreach ($childrenSubPage as $subChildren) {
      $subChildrenPage = page::getByID($subChildren);
      $ownerID = $subChildrenPage->getCollectionUserID();
      $ui = UserInfo::getByID($ownerID);
      $uiImage = $ui->getAttribute('profile_image');
      $userUrl = $this->url('/gebruiker');
      $userUrl .= '?gebruiker=';
      $userUrl .= $ownerID;
      $ed = $ui->getAttribute('education');
      $carreerValues = array();
      if(is_object($subChildrenPage->getAttribute('product_career_level'))){
        $careeer = $subChildrenPage->getAttribute('product_career_level');
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
      $imgProduct = $aih->getFirstImageInSet($subChildren);
      $thumbProduct = $ih->getThumbnail($imgProduct, 9999, 9999, false);
      $fullName = $ui->getAttribute('first_name') . ' ';
      if($ui->getAttribute('name_extra')){
        $fullName .= $ui->getAttribute('name_extra') . ' ';
      }
      $fullName .= $ui->getAttribute('sir_name');
      $smallArray = array(
        "title" => $subChildrenPage->getCollectionName(),
        "key" => $subChildrenPage->getAttribute('add_or_request'),
        "id" => $subChildren,
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
        "description" => $subChildrenPage->getAttribute('product_long_description'),
        "activeDate" => $subChildrenPage->getAttribute('product_date_valid'),
        "place" => $subChildrenPage->getAttribute('address_city'),
        "date" => $subChildrenPage->getCollectionDateAdded('F j, Y'),
        "activeCategory" => $subChildrenPage->getCollectionName(),
        "category" => $category,
        "categoryTop" => $categoryTopName,
        "image" => $thumbProduct,
        "careerLvl" => $carreerValues,
        "url" => $nh->getLinkToCollection($subChildrenPage),
        "price" => $subChildrenPage->getAttribute('product_price_value')
      );
      if ($subChildrenPage->getAttribute('add_or_request') == 'Advertentie'){
        $addsTotal = $addsTotal + 1;
        $totalAdd++;
      }
      elseif($subChildrenPage->getAttribute('add_or_request') == 'Opdracht'){
        $reqTotal = $reqTotal + 1;
        $totalReq++;
      }
      array_push($array, $smallArray);
      if($subChildrenPage->getAttribute('add_or_request') === 'Opdracht'){
        $i++;
      }
      else{
        $l++;
      }
    }
    $categoryArray = array(
      "req" => $i,
      "add" => $l,
      "name" => $category,
    );
    array_push($allCategory, $categoryArray);
  }
}
$cak = CollectionAttributeKey::getByHandle('product_career_level');
$at = AttributeType::getByHandle('select');
$satc = new SelectAttributeTypeController($at);
$satc->setAttributeKey($cak);
$values = $satc->getOptions();
$values = $values->getOptions();
$careerLvls = array();
foreach ($values as $key) {
  array_push($careerLvls, $key->value);
}
?>
<div class="row">
  <section class="filter">
    <div class="filter-container">
      <div class="filter-header">
        <h4>Zoekfilters</h4>
        <button class="reset-filter">Reset filters</button>
      </div>
      <form>
        <fieldset class="rubic">
          <legend>
            Rubrieken
          </legend>
          <div class="fieldset_container">
            <?php foreach ($allCategory as $key){
              $name = str_replace(' ', '_', $key['name']);
              ?>
              <input id="<?php echo $name; ?>" type="checkbox" />
              <label for="<?php echo $name; ?>"><?php echo $key['name']; ?> (<span class="add active"><?php echo $key['add']; ?></span><span class="req"><?php echo $key['req']; ?></span>)</label>
          <?php } ?>
          </div>
        </fieldset>
        <fieldset class="level">
          <legend>
            Feelgood niveaeu
          </legend>
          <div class="fieldset_container">
            <?php foreach ($careerLvls as $key) {
              $name = str_replace(' ', '_', $key);
              ?>
              <input id="<?php echo $name; ?>" type="checkbox" />
              <label for="<?php echo $name; ?>"><?php echo $key; ?></label>
              <?php
            }
            ?>
          </div>
        </fieldset>
        <!-- <fieldset class="type">
          <legend>
            Type opdracht
          </legend>
          <div class="fieldset_container">
            <input type="checkbox" />
            <label>Checkbox</label>
            <input type="checkbox" />
            <label>Checkbox</label>
            <input type="checkbox" />
            <label>Checkbox</label>
          </div>
        </fieldset> -->
      </form>
      <div class="mobile">
        <a href="#" class="uitklap active">Zie alle filters</a>
        <a href="#" class="inklap">Verberg all filters</a>
      </div>
    </div>
  </section>
  <div class="results">
    <div class="results-header">
      <div class="navigation-results">
        <a href="#" class="profiles active">Profielen (<?php echo $totalAdd; ?>)</a>
        <a href="#" class="request">Opdrachten (<?php echo $totalReq; ?>)</a>
        <a href="#" class="adds">Advertentie (<?php echo $totalAdd; ?>)</a>
      </div>
      <a class="active add_add add_something" href="<?php echo $this->url('/mijn_fgn/advertenties/advertentie_categorie');?>">Advertentie</a>
      <a class="req_add add_something" href="<?php echo $this->url('/mijn_fgn/opdrachten/opdracht_categorie');?>">Opdracht</a>
    </div>
    <section class="no-result">
      <h1>Geen resultaat</h1>
    </section>
    <section class="featured_profile active">
      <?php
      foreach ($array as $keyUser) {
        if($keyUser['key'] == 'Advertentie'){
          $name = $keyUser['categoryTop'];
          $nameArray = explode(" ", $name);
          $name2 = strtolower($nameArray[0]);
          ?>
          <article class="user small-full medium-full large-half featured_profile-account columns id<?php echo $keyUser['id']; ?> <?php echo $name2; ?>">
            <div class="featured_profile-account-container">
              <a href="<?php echo $keyUser['user']['url']; ?>" class="user_url-full"></a>
              <div class="featured_profile-account-image" style="background-image: url('<?php echo $keyUser['user']['image']->src; ?>')">
                <span class="featured_profile-account-image-number">123</span>
              </div>
              <h3 class="featured_profile-account-name"><?php echo $keyUser['user']['fullName'];?></h3>
              <div class="featured_profile-account-infoText">
                <p>
                  <?php $text = $keyUser['description'];
                  if(strlen($text) > 150){
                    $text = substr($text, 0, 150) . '...';
                  }
                  echo $text;
                  ?>
                </p>
              </div>
              <a href="<?php echo $keyUser['user']['url']; ?>" class="featured_profile-account-url">Profiel bekijken</a>
            </div>
          </article>
        <?php
        }
      }
      ?>
    </section>
    <section class="request_section">
      <?php
      for ($x = 0; $x < count($array); $x++) {
        if($array[$x]['key'] == 'Opdracht'){
          $name = $array[$x]['categoryTop'];
          $nameArray = explode(" ", $name);
          $name2 = strtolower($nameArray[0]);
          ?>
          <article class="recentAdds-element id<?php echo $array[$x]['id']; ?>">
            <div class="recentAdds-element_container <?php echo $name2; ?>">
              <a class="full_url" href="<?php echo $array[$x]['url'];?>"></a>
              <div class="recentAdds-element_image" style="background-image: url('<?php echo $array[$x]['user']['image']->src; ?>')" >
                <span class="recentAdds-element_image-number">123</span>
              </div>
              <div class="recentAdds-element_info">
                <div class="recentAdds-element_info-header">
                  <div class="recentAdds-element_info-header-top">
                    <span class="recentAdds-elements_info-header-cost">
                      <?php
                      $price = 'gratis';
                       if($array[$x]['price'] == 0){
                        echo 'gratis'; }
                        else{
                          echo '€ ' . $array[$x]['price'];
                        }?>
                    </span>
                    <h2 class="recentAdds-elements_info-header-title"><?php echo $array[$x]['title']; ?></h2>
                  </div>
                  <div class="recentAdds-element_info-header-linkInfo">
                    <p class="recentAdds-element_info-header-links">
                      <a href="<?php echo $array[$x]['url']; ?>" class="recentAdds-element_info-header-url category"><?php echo $array[$x]["category"]; ?></a>
                    </p>
                  </div>
                </div>
                <div class="recentAdds-element_info-text">
                  <p class="recentAdds-element_info-text_information">
                    <?php $text = $array[$x]['description'];
                    if(strlen($text) > 150){
                      $text = substr($text, 0, 150) . '...';
                    }
                    echo $text;
                    ?>
                  </p>
                  <p class="recentAdds-element_info-text_date">
                    Geplaatst op <?php echo $array[$x]['date']; ?>
                  </p>
                </div>
              </div>
            </div>
          </article>
        <?php
        }
      }
      ?>
    </section>
    <section class="request_section add_section">
      <?php
      foreach ($array as $keyAdd) {
        if($keyAdd['key'] == 'Advertentie'){
          $name = $keyAdd['categoryTop'];
          $nameArray = explode(" ", $name);
          $name2 = strtolower($nameArray[0]);
          ?>
          <article class="recentAdds-element adds id<?php echo $keyAdd['id']; ?>">
            <div class="recentAdds-element_container <?php echo $name2; ?>">
              <a class="full_url" href="<?php echo $keyAdd['url'];?>"></a>
              <div class="recentAdds-element_image" style="background-image: url('<?php echo $keyAdd['image']->src; ?>')" >
                <span class="recentAdds-element_image-number">123</span>
              </div>
              <div class="recentAdds-element_info">
                <div class="recentAdds-element_info-header">
                  <div class="recentAdds-element_info-header-top">
                    <span class="recentAdds-elements_info-header-cost">
                      <?php
                      $price = 'gratis';
                       if($keyAdd['price'] == 0){
                        echo 'gratis'; }
                        else{
                          echo '€ ' . $keyAdd['price'];
                        }?>
                    </span>
                    <h2 class="recentAdds-elements_info-header-title"><?php echo $keyAdd['title']; ?></h2>
                  </div>
                  <div class="recentAdds-element_info-header-linkInfo">
                    <p class="recentAdds-element_info-header-links">
                      <a href="<?php echo $nh->getLinkToCollection($cPage);?>" class="recentAdds-element_info-header-url category"><?php echo $keyAdd["category"]; ?></a>
                    </p>
                  </div>
                </div>
                <div class="recentAdds-element_info-text">
                  <p class="recentAdds-element_info-text_information">
                    <?php $text = $keyAdd['description'];
                    if(strlen($text) > 150){
                      $text = substr($text, 0, 150) . '...';
                    }
                    echo $text;
                    ?>
                  </p>
                  <p class="recentAdds-element_info-text_date">
                    <?php echo $keyAdd['date']; ?>
                  </p>
                </div>
              </div>
            </div>
          </article>
        <?php
        }
      }
      ?>
    </section>
  </div>
</div>
<script>
  var allDataCategory = <?php echo json_encode($array); ?>;
  var currentPageCategory = "<?php echo $cPage->getCollectionName(); ?>";
  var topPage = "<?php echo $categoryTopName; ?>";
</script>
<?php  $this->inc('elements/footer.php'); ?>
