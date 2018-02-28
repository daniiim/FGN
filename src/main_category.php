<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
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
$categories_home_page = page::getByID(997);			
$total_adds 	= $categories_home_page->getAttribute('nr_adds');
$total_requests = $categories_home_page->getAttribute('nr_requests');

?>

<section>
  <div class="container inner-xxs">
    <div class="row">
   <div class="col-md-12"><?php  $this->inc('elements/breadcrumbs.php'); ?>
   <div class="row">
		<div class="col-md-6 text-center-mobile">
		
			<a class="hidden-sm hidden-xs btn red btn-light-gray-bordered no-outer-bottom" href="<?php echo $this->url('zoek_resultaten');?>"><i class="icon-search"></i> Bekijk advertenties  (<?php echo $total_adds;?>)</a>
			
			<a class="hidden-md hidden-lg red no-wrap-ellipses" href="<?php echo $this->url('/zoek_resultaten');?>"><i class="icon-search"></i> Advertenties (<?php echo $total_adds;?>)</a>
			
			<a class="hidden-sm hidden-xs btn blue btn-light-gray-bordered no-outer-bottom" href="<?php echo $this->url('zoek_resultaten?search_type=request');?>"><i class="icon-search"></i> Bekijk Opdrachten (<?php echo $total_requests;?>)</a>
			
			<a class="hidden-md hidden-lg blue no-wrap-ellipses" href="<?php echo $this->url('/zoek_resultaten?search_type=request');?>"><i class="icon-search"></i> Opdrachten (<?php echo $total_requests;?>)</a>
			
		</div>
		<div class="col-md-6 text-right"><a class="btn btn-red btn-block-mobile no-outer-bottom" id="request-button" href="<?php echo $this->url('/mijn_fgn/advertenties/advertentie_categorie');?>"><i class="icon-pencil"></i> Plaats advertentie <?php if ($u->isLoggedIn()): echo '('.$total_available.')'; endif;?></a>
			<a class="btn no-outer-bottom btn-block-mobile" href="<?php echo $this->url('/mijn_fgn/opdrachten/opdracht_categorie');?>"><i class="icon-pencil"></i> Plaats opdracht</a>
		</div>
	</div> 
   
   </div>
    

	<div class="col-md-12">
    <hr class="hr-sm"/>
	<a class="btn btn-block btn-border btn-collpase-categories-sidebar" data-toggle="collapse" data-target=".collapse-categories-sidebar"><i class="icon-layout"></i> Blader door categorieën</a>
   </div>
   
      <div class="col-md-3 collapse collapse-categories-sidebar">
        <?php
			$a = new GlobalArea('Categorieën Sidebar');
			$a->display();
		?>
      </div>
      <div class="col-md-9">
      <div class="row">
		<div class="col-md-7">
			
			<h1 class="small">Rubrieken binnen de categorie <?php echo $c->getCollectionName();?></h1>
		</div>
		<div class="col-md-5 text-right small">
		<a class="red outer-right-xxs" id="add-total-button" href="<?php echo $this->url('/zoek_resultaten?path='.$path);?>"><i class="icon-search"></i> Advertenties </a>
			<a class="blue" id="request-total-button" href="<?php echo $this->url('/zoek_resultaten?search_type=request&path='.$path);?>"><i class="icon-search"></i> Opdrachten </a>
		</div>
            </div>
       <?php		 
        $a = new GlobalArea('Categorieën Hoofd');
		$a->display();
		?>

    </div>
  </div>
  </div>
</section>
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
<?php  $this->inc('elements/footer.php'); ?>
