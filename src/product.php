<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$paused = $c->getAttribute('product_paused');
function debug($data){
  print_r('<pre>');
  print_r($data);
  print_r('</pre>');
}
if ($paused || $c->isEditMode()) :
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php
			$a = new GlobalArea('Gepauzeerd');
			$a->display();
			?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if (!$paused || $c->isEditMode()) { //advertentie is actief
$form = loader::helper('form');
global $u;
$logged_in = $u->isLoggedIn();
$page_id = $c->getCollectionId();
//user data
$ownerID = $c->getCollectionUserID();
$ui = UserInfo::getByID($ownerID);
$user_first_name = $ui->getAttribute('first_name');
$user_sir_name = $ui->getAttribute('sir_name');
//advertenties tellen
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
//opdrachten tellen
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
//privacy
$show_email = $ui->getAttribute('email_secret');
$show_phone = $ui->getAttribute('phone_secret');
$user_birth = new DateTime($ui->getAttribute('user_birth'));
$user_image = $ui->getAttribute('profile_image');
//parent page
$nh = loader::helper('navigation');
$parent_page_id = $c->getCollectionParentID();
$parent_page = page::getByID($parent_page_id);
$parent_page_name = $parent_page->getCollectionName();
$parent_page_url = $nh->getLinkToCollection($parent_page);

$gender = $ui->getAttribute('gender');

$user_facebook = $ui->getAttribute('facebook');
$user_website = $ui->getAttribute('website');

//add data
$description = $c->getAttribute('product_long_description');

$youtube = $c->getAttribute('product_youtube');

$user_mail = $c->getAttribute('product_email_address');
$user_phone = $c->getAttribute('product_phone_nr');

$averageScore = $c->getAttribute('average_rating_percentage')*0.85;

$product_city = $c->getAttribute('address_city');
$product_street = $c->getAttribute('address_street_name').' '.$c->getAttribute('address_street_nr');
$product_zip = $c->getAttribute('address_zip');
$show_address = $c->getAttribute('product_address_exact');
if ($show_address == 0 ) {
	$complete_address = '<i class="icon-location-1 blue"></i>'.$product_city;
} else {
	$complete_address.= '<ul class="address-list">';
	$complete_address.= '<li>'.$product_street.'</li>';
	$complete_address.= '<li>'.$product_zip.'</li>';
	$complete_address.= '<li>'.$product_city.'</li>';
	$complete_address.= '</ul>';
}
$product_lat = $c->getCollectionAttributeValue('product_location_long');
$product_long = $c->getCollectionAttributeValue('product_location_lat');
$product_location_lat_long = $product_long.','.$product_lat;
//$product_diploma = $c->getAttribute('product_diploma');
$product_education_level = $c->getAttribute('product_education_level');
$product_education_detail = $c->getAttribute('product_education_detail');
$product_education_level_custom = $c->getAttribute('product_education_level_custom');
$product_career_level = $c->getAttribute('product_career_level');
$product_career_level_custom = $c->getAttribute('product_career_level_custom');


$price_negotiation = $c->getAttribute('product_price_negotiation');
$price_value = $c->getAttribute('product_price_value');
$price_type = $c->getAttribute('product_price_setting');
$date = date('d-m-Y', strtotime($c->getCollectionDatePublic()));
//beschikbaarheid
$selected_days = $c->getAttribute('product_days');
$ak = CollectionAttributeKey::getByHandle('product_days');
$satc = new SelectAttributeTypeController(AttributeType::getByHandle('select'));
$satc->setAttributeKey($ak);
$all_days = $satc->getOptions();
if ($selected_days) {
	foreach ($selected_days as $day) {
		$days[] = $day->value;
	}
}
//contactvoorkeur
$contact_pref = $c->getAttribute('product_contact_prefs');
$product_contact_name = $user_first_name.' '.$user_sir_name; //aangepast na drama over namen bij advertenties
//helper favorieten
loader::helper ('favorites');
$fh = new FavoritesHelper();
//beveiliging
if ($_GET['favorite'] && $_GET['favorite'] == $page_id ) {
	$fh->set_favs($page_id);
}
$this->inc('elements/breadcrumbs.php'); ?>

<div class="save-button">
  <?php
  if ($logged_in && !in_array($page_id,$fh->get_favs())) { ?>
    <form method="get">
      <button type="submit" class="btn btn-block btn-red">Bewaar</button>
      <?php print $form->hidden('favorite',$page_id);?>
    </form>
    <?php }
    elseif ($logged_in) { ?>
      <form method="get">
        <a class="red" href="<?php echo $this->url('mijn_fgn/favorieten');?>" title="Favorieten beheren">Bewaard</a>
      </form>
    <?php
    } else { ?>
      <a href="<?php echo $this->url('/login/forward/'.$page_id);?>">Log in om op te slaan</a>
    <?php } ?>
</div>

<div class="row extra-margin-top">
  <?php
  $user_first_name = $ui->getAttribute('first_name');
  $user_sir_name = $ui->getAttribute('sir_name');
  $uh = Loader::helper('url');
  $ih = Loader::helper('image');
  $nh = Loader::helper('navigation');
  $fullName = $ui->getAttribute('first_name') . ' ';
  if($ui->getAttribute('name_extra')){
    $fullName .= $ui->getAttribute('name_extra') . ' ';
  }
  $fullName .= $ui->getAttribute('sir_name');
  $user = array(
    "userName" => $ui->getAttribute('first_name'),
    "sirName" => $ui->getAttribute('sir_name'),
    "userBirth" => date('d/m/Y', strtotime($ui->getAttribute('birth'))),
    "info" => $ui->getAttribute('user_about'),
    "fullName" => $fullName,
  );
  ?>
  <section class="user_profile columns small-full medium-third">
    <div class="user_profile-container">
      <div class="user_profile-image" style="background-image: url('<?php echo $thumb->src;?>')" alt="<?php echo $user_name; ?>">
        <span class="user_profile-image-score">123</span>
      </div>
      <h2><?php echo $user['fullName']; ?></h2>
      <p>
        <?php
        $text = $userAbout;
        if(strlen($text) > 130){
          $text = substr($text, 0, 130) . '...';
        }
        echo $text;
        ?>
      </p>
      <?php
        $a = new GlobalArea('Gebruiker Sidebar');
        $a->display();
      ?>
      <?php  if ($user_website) : ?>
        <a href="<?php echo $user_website; ?>" title="Bezoek de website van <?php echo $user_first_name;?>" target="_blank">Bezoek de website van <?php echo $user_first_name;?></a>
      <?php endif;?>
      <?php if ($userFacebook):?>
        <?php echo $userFacebook;?>
      <?php endif;?>
    </div>
  </section>
  <section class="add-page columns small-full medium-two-third">
    <div class="add-page-container">
      <div class="add-page_header">
        <div class="add-page_header-image">
          <?php
          $ai = new AddImagesHelper();
          $ih = loader::helper('image');
          $image_attributes = $ai->attrHandles;
          $has_images = false;
          for($i = 0; $i < count($image_attributes); $i++){
            if ($c->getAttribute($image_attributes[$i])){
              if($i < 1){
                $product_thumb = $ih->getThumbnail($c->getAttribute($image_attributes[$i]), 9999, 9999);
                $has_images = true;
                ?>
                <span class="full-image" style="background-image: url('<?php echo $product_thumb->src; ?>')">

                </span>
                <?php
              }
              else{
                ?>
                <span class="small-image" style="background-image: url('<?php echo $product_thumb->src; ?>')">

                </span>
                <?php
              }
                ?>
              <?php
            }
          }
          ?>
        </div>
        <div class="add-page_header-content">
          <h2>
            <span>
              <?php
              $price = 'gratis';
               if($price_value == 0){
                echo 'gratis'; }
              else{
                echo '€ ' . $price_value;
              }?>
            </span>
            <?php echo $c->getCollectionName();?>
          </h2>
          <div class="add-page_header-content-category">
            <a href="#"><?php echo $parent_page_name;?></a> <p>in</p> <a href="#"><?php echo $product_city;?></a>
          </div>
          <p>
            <p>
              <?php $text = $c->getAttribute('product_long_description');
              if(strlen($text) > 150){
                $text = substr($text, 0, 150) . '...';
              }
              echo $text;
              ?>
            </p>
          </p>
          <p class="add-page_header-content-date">
            Geplaatst op <?php echo $date; ?>
          </p>
        </div>
      </div>
      <div class="add-page_footer">
        <h2>Omschrijving</h2>
        <p>
          <?php echo $c->getAttribute('product_long_description');?>
        </p>
        <ul>
          <li><span>Opleidingsniveau: </span><?php if (!empty(strval($product_education_level)) && $product_education_level != 'Anders...'): echo $product_education_level; elseif ($product_education_level_custom) : echo $product_education_level_custom; else : echo 'Onbekend'; endif;?></li>
          <li><span>Opleidingsrichting: </span><?php if ($product_education_detail && $product_education_level) : echo $product_education_detail; else :?>Onbekend<?php endif;?></li>
          <li><span>Carrièreniveau: </span><?php if ($product_career_level_custom) : echo $product_career_level_custom; elseif ($product_career_level != 'Anders...' && !empty(strval($product_career_level))) : echo $product_career_level; else : echo 'Onbekend'; endif;?></li>
          <li><span>Locatie: </span><?php echo $product_city;?></li>
          <li><span>Rubriek: </span><a class="aqua" href="<?php echo $parent_page_url;?>" title="Geplaats in de rubriek <?php echo $parent_page_name;?>"><?php echo $parent_page_name;?></a></li>
          <li><span>Geplaatst: </span><?php echo $date;?></li>
          <li><span>Advertentienummer: </span><?php echo $page_id;?></li>
        </ul>
        </div>
      </div>
    </div>
  </section>
</div>
  <!-- <div class="col-sm-4">
          <div class="bordered inner-xxs inner-left-xxs inner-right-xxs outer-bottom-xxs">
            <h3>
              <?php echo $user_first_name; ?>
              <?php if ($user_image) {
                $ih = loader::helper('image');
                $user_thumb = $ih->getThumbnail($user_image, 50, 50,true); 	?>
                <img class="img-circle pull-right" src="<?php echo $user_thumb->src ?>" alt="<?php echo $user_first_name; ?>" />
              <?php ;}?>
            </h3>
            <ul class="list-unstyled">
              <li>
                <?php if ($user_mail) { ?>
                  <a class="aqua" href="mailto:<?php echo $user_mail;?>"><i class="icon-mail-1"></i> <?php echo $user_mail;?></a>
                <?php } else { ?>
                  <i class="icon-mail-1 blue">(E-mail is geheim)</i>
                  <?php ;} ?>
                </li>
                <li><i class="icon-mobile blue"></i>
                  <?php if ($user_phone) {?>
                    <?php echo $user_phone;?>
                  <?php } else {;?>
                    (Telefoonnummer is geheim)
                    <?php ;} ?>
                  </li>
                  <li><?php echo $complete_address;?></li>
                  <?php if ($user_website) :?>
                    <li><a class="aqua" href="<?php echo $user_website;?>"><i class="icon-globe"></i> Bezoek de website</a></li>
                  <?php endif;?>
                  <?php if ($user_facebook) :?>
                    <li> <a class="aqua" href="<?php echo $user_facebook;?>"><i class="icon-facebook"></i> Bezoek de Facebook pagina</a></li>
                  <?php endif;?>
                </ul>
                <?php if($hasMoreThanOneAdd) :?>
                  <a class="aqua small block" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>&tab=advertenties"><i class="icon-plus"></i> Bekijk alle advertenties van <?php echo $user_first_name; ?></a> <?php endif;?>
                  <?php if($hasMoreThanOneRequest) :?>
                    <a class="aqua small block" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>&tab=opdrachten"><i class="icon-plus"></i> Bekijk alle opdrachten van <?php echo $user_first_name; ?></a> <?php endif;?>
                    <a class="btn btn-block" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>">Profiel <?php echo $user_first_name; ?></a>
                  </div>
                  $a = new GlobalArea('Product Sidebar');
                  $a->display();
                  ?> -->
<?php } ?>
<?php  $this->inc('elements/footer.php'); ?>
