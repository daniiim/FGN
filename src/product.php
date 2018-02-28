<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
$paused = $c->getAttribute('product_paused');
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
<?php if (!$paused || $c->isEditMode()) : //advertentie is actief
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
?>

<div class="container inner-xxs">
  <div class="row">
    <div class="col-md-12">
      <?php  $this->inc('elements/breadcrumbs.php'); ?>
    </div>
    <div class="col-sm-8">
      <?php 
	if ($_GET["method"]) {
		$info_tab = null;
		$review_tab = 'active';
	} else {
		$info_tab = 'active';
		$review_tab = null;
	}
	
	?>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php echo $info_tab;?>"><a href="#main" aria-controls="main" role="tab" data-toggle="tab"><i class="icon-info-circle blue"></i> <span class="hidden-sm hidden-xs"> Informatie</span></a></li>        
        <li role="presentation"><a href="#calendar" aria-controls="calendar" role="tab" data-toggle="tab"><i class="icon-calendar-1 blue"></i> <span class="hidden-sm hidden-xs"> Beschikbaarheid</span></a></li>
        <li role="presentation" class="<?php echo $review_tab;?>"><a id="tab-review" href="#review" aria-controls="review" role="tab" data-toggle="tab"><i class="icon-star blue"></i> <span class="hidden-sm hidden-xs"> Reviews <?php if ($averageScore) :?><div class="stars" style="width:<?php echo $averageScore;?>px"></div><?php endif;?></span></a></li>
        
      </ul>
      
      <!-- Tab panes -->
      <div class="tab-content tab-content-bordered">
        <div role="tabpanel" class="tab-pane <?php echo $info_tab;?>" id="main">
		
		<h1><span class="green">Aangeboden:</span> <?php echo $c->getCollectionName();?></h1>
		  <hr />
		
    <div class="row">
            <?php
	$ai = new AddImagesHelper();
	$ih = loader::helper('image');
	$image_attributes = $ai->attrHandles;
	$has_images = false;
	foreach ($image_attributes as $image_attribute) {	
	
		if ($c->getAttribute($image_attribute)){
			$product_thumb = $ih->getThumbnail($c->getAttribute($image_attribute), 9999, 600); 
			$has_images = true;			
			echo '<div class="col-sm-3  add-images"><a class="product-thumb" href="'.$product_thumb->src.'" data-toggle="lightbox" data-gallery="multiimages" data-title="'.$c->getCollectionName().'"><img src="'.$product_thumb->src.'"  /></a></div>';
		} 
	}
	?>		
	<?php if ($has_images == false) :?>
		<div class="col-sm-3 add-images">
			<div class="product-thumb"><img alt="<?php  echo SITE?>" src="<?php echo $this->getThemePath()?>/assets/images/no-image-296.png"></div>
		</div>
		<?php endif;?>
	</div>
          
          <div class="alert alert-info">
            <p>Salarisniveau: €<?php if ($price_value > 0) : echo $price_value; endif;?> <?php if (!empty(strval($price_type))) : echo $price_type; else : echo 'Onbekend'; endif?></p>
          </div>
		  <h3>Omschrijving</h3>
		  <p class="add-description no-outer-bottom">
          <?php echo $c->getAttribute('product_long_description');?>
		  </p>          
		  <h3>Kenmerken</h3>
		  <ul class="list-def">			  
			  <li><span>Opleidingsniveau:</span><?php if (!empty(strval($product_education_level)) && $product_education_level != 'Anders...'): echo $product_education_level; elseif ($product_education_level_custom) : echo $product_education_level_custom; else : echo 'Onbekend'; endif;?></li> 
			  <li><span>Opleidingsrichting:</span><?php if ($product_education_detail && $product_education_level) : echo $product_education_detail; else :?>Onbekend<?php endif;?></li>
			  <li><span>Carrièreniveau:</span><?php if ($product_career_level_custom) : echo $product_career_level_custom; elseif ($product_career_level != 'Anders...' && !empty(strval($product_career_level))) : echo $product_career_level; else : echo 'Onbekend'; endif;?>
			  </li>
			  <li><span>Locatie:</span><?php echo  $product_city;?></li>
			  <li><span>Rubriek:</span><a class="aqua" href="<?php echo $parent_page_url;?>" title="Geplaats in de rubriek <?php echo $parent_page_name;?>"><?php echo $parent_page_name;?></a></li>
			  <li><span>Geplaatst:</span><?php echo $date;?></li>
			  <li><span>Advertentienummer:</span><?php echo $page_id;?></li>
		  </ul>
		 <?php if ($youtube) :	
		  
			  //schoonmaken youtube url
			  //http:// of https:// worden verwijderd uit het url
			  //watch?v= wordt vervangen door embed/
			    
			  $original = array("watch?v=", "https://", "http://");
			  $replacement   = array("embed/", "", "");
			  $youtube_url = str_replace($original, $replacement, $youtube);
			?>
          <div class="user-video">
            <iframe width="560" height="315" src="https://<?php echo $youtube_url;?>" frameborder="0" allowfullscreen></iframe>
          </div>
          <?php endif; ?>
		  
          <?php  if ($user_website) : ?><br />
          <a class="aqua" href="<?php echo $user_website; ?>" title="Bezoek de website van <?php echo $user_first_name;?>" target="_blank"><i class="icon-globe blue"></i> Bezoek de website van <?php echo $user_first_name;?></a>
          <?php endif;?>
		  <?php if ($userFacebook):?>
				<?php echo $userFacebook;?>
			<?php endif;?>
        </div>
        <div role="tabpanel" class="tab-pane" id="calendar">        
          <?php if (strval($selected_days)) :?>
          <table class="table table-calendar">
            <thead>
              <tr>
                <th></th>
                <th>Ma</th>
                <th>Di</th>
                <th>Woe</th>
                <th>Do</th>
                <th>Vr</th>
                <th>Za</th>
                <th>Zo</th>
              </tr>
            </thead>
            <tbody>
              <?php 
            $count = 1;
			
            foreach ($all_days as $options) {
				switch ($count) {
			case 1:
				echo '<tr><th>Ochtend</th>';
				break;
			case 8:
				echo '<tr><th>Middag</th>';
				break;
			case 15:
				echo '<tr><th>Avond</th>';
				break;
			case 22:
				echo '<tr><th>Nacht</th>';
				break;
				}
				if (in_array ($options->value, $days)) {
				echo  '<td class="green"><i class="icon-check"></i></td>';
				} else {
				echo  '<td></td>';
				}
				$count ++;
            }
            ?>
            </tbody>
          </table>
          <?php else : ?>
          <div class="alert alert-info clearfix"><p><i class="icon-attention-circle"></i>
			Er is geen beschikbaarheid opgegeven.</p>
		</div>
          <?php endif;?>
        </div>
        <div role="tabpanel" class="tab-pane <?php echo $review_tab;?>" id="review">
          <?php
			$a = new GlobalArea('Reviews');
			$a->display();				
			?>
        </div>       
      </div>
	  <div class="hidden-sm hidden-xs">
	  <?php if($hasMoreThanOneAdd || $hasMoreThanOneRequest || $c->isEditMode()) :?>
		  <div class="row">
		  <?php if($hasMoreThanOneAdd) :?>
			<div class="col-md-6">
				<a class="blue" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>&tab=advertenties"><i class="icon-plus"></i> Bekijk alle advertenties van <?php echo $user_first_name; ?></a>
			</div>
		  <?php endif;?>
		  <?php if($hasMoreThanOneRequest) :?>
			<div class="col-md-6">
				<a class="blue" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>&tab=opdrachten"><i class="icon-plus"></i> Bekijk alle opdrachten van <?php echo $user_first_name; ?></a>
			</div>
		  <?php endif;?>
		  </div>
		<?php
		if ($hasMoreThanOneAdd || $c->isEditMode()) {
		$a = new GlobalArea('Product Midden');
		$a->display();	
		}		
		?> 
      <?php endif;?>
      </div>
      </div>
    <div class="col-sm-4">
      <div class="outer-bottom-xxs">
        <?php 	
		if ($logged_in && !in_array($page_id,$fh->get_favs())) {?>
        <form method="get">
          <button type="submit" class="btn btn-block btn-red" style="margin-top:0;"><i class="icon-heart-1"></i> Bewaar</button>
          <?php print $form->hidden('favorite',$page_id);?>
        </form>
        <?php ;} elseif ($logged_in) { ?>
        <form method="get">
          <p><a class="red" href="<?php echo $this->url('mijn_fgn/favorieten');?>" title="Favorieten beheren"><i class="icon-heart-1"></i> Bewaard</a></p>
        </form>
        <?php ;} else { ?>
        <a class="aqua" href="<?php echo $this->url('/login/forward/'.$page_id);?>"><small><i class="icon-lock"></i> Log in om op te slaan</small></a>
        <button class="disabled btn btn-block btn-red"><i class="icon-heart-1"></i> Bewaar</button>
        <?php ;} ?>
      </div>
      <div class="bordered inner-xxs inner-left-xxs inner-right-xxs outer-bottom-xxs">
        <h3>
          <?php if ($product_diploma) :?>
          <i class="blue icon-graduation-cap"></i>
          <?php endif;?>         
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
		<hr />
		<a class="btn btn-block" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>">Profiel <?php echo $user_first_name; ?></a>
		</div>
      <?php
			$a = new GlobalArea('Product Sidebar');
			$a->display();				
			?>
    </div>
  </div>
</div>
<section id="help-form-section" class="darker-bg">
  <div class="container inner-xs">
    <div class="row">
		<div class="col-sm-8">
			<section class="light-bg inner-xs inner-left-xs inner-right-xs">
        <?php
			$a = new GlobalArea('Contact Help Form');
			$a->display();
		?>
			</section>
		</div>
      <div class="col-sm-4">
        <?php
			$a = new GlobalArea('Contact Help Intro');
			$a->display();
		?>
      </div>
    </div>
  </div>
</section>
<?php  $this->inc('elements/categories.php'); ?>

<script src="<?php echo $this->getThemePath()?>/assets/js/ekko-lightbox.min.js"></script> 
<script>
$(document).ready(function () {
	//$("#rating-average .ccm-rating").clone().insertAfter("h1");	
	function appendTextRating (rating) {
		$('#rating-average').append('<div class="text-rating">('+rating+')</div>');
	}
	var ratingValue = $('#rating-average .rating-star-on').length;
	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});
	
	$('.add-description').readmore({
	speed: 300,	
	moreLink: '<div class="text-right inner-xxs"><a class="btn-read-more" href="#"><i class="icon-plus-1"></i> Lees meer</a></div>',
	lessLink: '<div class="text-right inner-xxs"><a class="btn-read-more" href="#"><i class="icon-minus-1"></i> Lees minder</a></div>'
	});
	
});
</script>
<?php endif; ?>
<?php  $this->inc('elements/footer.php'); ?>
