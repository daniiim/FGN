<?php 
   defined('C5_EXECUTE') or die("Access Denied.");
   $this->inc('elements/header.php');
   global $u;
   $paused = $c->getAttribute('product_paused');
if ($paused || $c->isEditMode()) :
?>
<div class="container inner-sm">
	<div class="row">
		<div class="col-md-12">
		<?php
			$a = new GlobalArea('Gepauzeerd opdrachten');
			$a->display();				
			?>
</div>
	</div>
</div>
<?php endif;?>
<?php if (!$paused || $c->isEditMode() || $u->isSuperUser()) : //advertentie is actief
   $form = loader::helper('form');
   
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
$upagesr = $uplr->get($itemsToGet = 2, $offset = 0) ;	//we willen weten of er meer als 1 advertentie is
$hasMoreThanOneRequest = false;
if (count($upagesr) > 0) {
$hasMoreThanOneRequest = true;	
}
   //datum advertentie
   $date = date('d-m-Y', strtotime($c->getCollectionDatePublic()));
   //privacy
   //$show_email = $ui->getAttribute('email_secret');
   //$show_phone = $ui->getAttribute('phone_secret');
   $user_birth = new DateTime($ui->getAttribute('user_birth'));
   $user_image = $ui->getAttribute('profile_image');
   $user_address_city = $ui->getAttribute('address_city');	
   $gender = $ui->getAttribute('gender');
   $user_education_level = $ui->getAttribute('education');
   $user_about = $ui->getAttribute('user_about');	
   $user_specialities	= $ui->getAttribute('user_specialities');	
   $user_mail = $ui->getUserEmail();	
   $user_facebook = $ui->getAttribute('facebook');	
   				 
   //add data
   $description = $c->getAttribute('product_long_description');
   $website = $c->getAttribute('product_website_url');
   $youtube = $c->getAttribute('product_youtube');
   
   $user_mail = $c->getAttribute('product_email_address');
   $user_phone = $c->getAttribute('product_phone_nr');
   
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
   $request_max_price = $c->getCollectionAttributeValue('request_max_price');
   $request_price_type = $c->getCollectionAttributeValue('request_price_type');
   //$request_price_discus = $c->getCollectionAttributeValue('request_price_discus');
   $request_start = $c->getCollectionAttributeValue('request_start');
   if ($c->getCollectionAttributeValue('request_specific_date')) {
	$request_specific_date = date("d-m-Y", strtotime($c->getCollectionAttributeValue('request_specific_date')));
   }
   $product_contact_name = $user_first_name.' '.$user_sir_name;
   $fh = new FavoritesHelper();
//beveiliging
	if ($_GET['favorite'] && $_GET['favorite'] == $page_id ) {
		$fh->set_favs($page_id);
	}
	//parent page
	$nh = loader::helper('navigation');
	$parent_page_id = $c->getCollectionParentID();
	$parent_page = page::getByID($parent_page_id);
	$parent_page_name = $parent_page->getCollectionName();
	$parent_page_url = $nh->getLinkToCollection($parent_page);
   ?>
<div class="container inner-xxs">
   <div class="row">
      <div class="col-md-12">
         <?php  $this->inc('elements/breadcrumbs.php'); ?>
      </div>
      <div class="col-sm-8">
		<div class="add-content">
         <h1><span class="green"><?php echo $user_first_name;?> zoekt:</span> <?php echo $c->getCollectionName();?></h1>
		 <hr />
         <div class="row">
            <?php
               $ai = new AddImagesHelper();
               $ih = loader::helper('image');
               $image_attributes = $ai->attrHandles;
               $has_images = false;
               foreach ($image_attributes as $image_attribute) {	
               
               	if ($c->getAttribute($image_attribute)){
               		$product_thumb = $ih->getThumbnail($c->getAttribute($image_attribute), 9999, 148); 
               		$has_images = true;			
               		echo '<div class="col-sm-3 add-images"><a href="'.$product_thumb->src.'" data-toggle="lightbox" data-gallery="multiimages" data-title="'.$c->getCollectionName().'" class="product-thumb"><img src="'.$product_thumb->src.'" /></a></div>';
               	} 
               }	
               
               ?>
			   <?php if ($has_images == false) :?>
		<div class="col-sm-3  add-images"><div class="product-thumb"><img alt="<?php  echo SITE?>" src="<?php echo $this->getThemePath()?>/assets/images/no-image-296.png"></div></div>
		<?php endif;?>
         </div>
		 <h3>Omschrijving</h3>
         <p class="add-description no-outer-bottom"><?php echo $description;?></p>
         <h3>Kenmerken</h3>
		 <ul class="list-def">		 
			<li><span>Vergoeding:</span><?php if ($request_price_type == "In overleg"):?>&euro; In overleg<?php else :?>&euro;<?php echo $request_max_price;?> <?php echo $request_price_type;?><?php endif;?>
			</li>
			<li><span>Startdatum:</span><?php if ($request_specific_date) { echo $request_specific_date; } else { echo $request_start; }?></li>
			<li><span>Locatie:</span><?php echo $product_city;?></li>
			<li><span>Rubriek:</span><a class="aqua" href="<?php echo $parent_page_url;?>" title="Geplaatst in de rubriek <?php echo $parent_page_name;?>"><?php echo $parent_page_name;?></a></li>
			<li><span>Geplaatst:</span><?php echo $date;?></li>
			<li><span>Opdrachtnummer:</span><?php echo $page_id;?></li>			
		</ul>
         </div>
		 <div class="hidden-sm hidden-xs">
		 <?php if($hasMoreThanOneAdd || $hasMoreThanOneRequest || $c->isEditMode()) :?>
		  <div class="row">		  
		  <?php if($hasMoreThanOneRequest) :?>
			<div class="col-md-6">
				<a class="blue" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>&tab=opdrachten"><i class="icon-plus"></i> Bekijk alle opdrachten van <?php echo $user_first_name; ?></a>
			</div>
		  <?php endif;?>
		  <?php if($hasMoreThanOneAdd) :?>
			<div class="col-md-6">
				<a class="blue" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>&tab=advertenties"><i class="icon-plus"></i> Bekijk alle advertenties van <?php echo $user_first_name; ?></a>
			</div>
		  <?php endif;?>
		  </div>
		<?php
		if ($hasMoreThanOneRequest || $c->isEditMode()) {
		$a = new GlobalArea('Opdracht Midden');
		$a->display();	
		}		
		?> 
		<?php endif;?>		
      </div></div>
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
            <i class="icon-mail-1"></i> <i>(E-mail is geheim)</i>
            <?php ;} ?>
          </li>
          <li>
            <?php if ($user_phone) {?>
            <i class="icon-mobile blue"></i> <?php echo $user_phone;?>
            <?php } else {;?>
            <i class="icon-mobile blue"></i> <i>(Telefoonnummer is geheim)</i>
            <?php ;} ?>
          </li>
		  <?php if ($userAge) :?>
		  <li>
			<i class="icon-clock blue"></i> <i><?php echo $userAge;?> jaar
		  </li>
		  <?php endif;?>
          <li><?php echo $complete_address;?></li>
          <?php if ($website) :?>
          <li><a class="aqua" href="<?php echo $website;?>"><i class="icon-globe"></i> Bezoek de website</a></li>
          <?php endif;?>
           <?php if ($user_facebook) :?>
           <li> <a class="aqua" href="<?php echo $user_facebook;?>"><i class="icon-facebook"></i> Bezoek de Facebook pagina</a></li>
            <?php endif;?>
          
        </ul><?php if($hasMoreThanOneRequest) :?>
        <a class="aqua small block" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>&tab=opdrachten"><i class="icon-plus"></i> Bekijk alle opdrachten van <?php echo $user_first_name; ?></a> <?php endif;?> 
		<?php if($hasMoreThanOneAdd) :?>
        <a class="aqua small block" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>&tab=advertenties"><i class="icon-plus"></i> Bekijk alle advertenties van <?php echo $user_first_name; ?></a> <?php endif;?>
		<hr />
		<a class="btn btn-block" href="<?php echo $this->url('/gebruiker');?>?gebruiker=<?php echo $ownerID;?>">Profiel <?php echo $user_first_name; ?></a> </div>
         <?php
            $a = new GlobalArea('Request Sidebar');
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
<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script> <!-- /.modal --> 
<script>
   $(document).ready(function () {	
   	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
   		event.preventDefault();
   		$(this).ekkoLightbox();
   	});

	$('.add-description').readmore({
	speed: 300,
	collapsedHeight: 80,
	moreLink: '<div class="text-right inner-xxs"><a class="btn-read-more" href="#"><i class="icon-plus-1"></i> Lees meer</a></div>',
	lessLink: '<div class="text-right inner-xxs"><a class="btn-read-more" href="#"><i class="icon-minus-1"></i> Lees minder</a></div>'
	});
});
</script>

<?php endif;?>
<?php  $this->inc('elements/footer.php'); ?>

