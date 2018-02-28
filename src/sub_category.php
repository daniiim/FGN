<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
$nr_of_adds = 0;
$nr_of_requests = 0;
$nr_of_adds = $c->getAttribute('category_nr_adds');
$nr_of_requests = $c->getAttribute('category_nr_requests');
?>
	<section>
		<div class="container inner-xxs">
			<div class="row">
				<div class="col-md-12">
					<?php  $this->inc('elements/breadcrumbs.php'); ?>
					<div class="tabs tabs-top tab-container" id="search-tabs">					
						<ul class="etabs">
							<li class="tab"  id="adds-tab-select">
								<a class="no-wrap-ellipses" id="anchor-adds" href="#tab-adds"><span class="red"><i class="icon-search"></i> <span class="hidden-sm hidden-xs">Bekijk </span>advertenties</span></a>
							</li>
							<li class="tab"  id="request-tab-select">
								<a class="no-wrap-ellipses" id="anchor_req" href="#tab-requests"><span class="blue"><i class="icon-search"></i> <span class="hidden-sm hidden-xs">Bekijk </span>opdrachten</span></a>
							</li>							
						</ul>
						
						<div class="panel-container">
						<div class="create-add-buttons">						
						<a class="btn btn-red" href="<?php echo $this->url('/mijn_fgn/advertenties/advertentie_categorie');?>"><i class="icon-pencil"></i> Plaats advertentie</a>
						<a class="btn btn-blue" href="<?php echo $this->url('/mijn_fgn/opdrachten/opdracht_categorie');?>"><i class="icon-pencil"></i> Plaats opdracht</a>						
						</div>

							<div class="tab-content" id="tab-adds">
								<?php
								$a = new GlobalArea('Sub Categorieën Hoofd');
								$a->display();
								?>
							</div><!-- /.panel-container -->
						</div>
					
					<div class="tab-content active" id="tab-requests">
						<?php $a = new GlobalArea('Sub Categorieën Hoofd 2');
						$a->display();
						?>
					</div></div>
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

<?php 
if (!$_GET['search_type'] || $_GET['search_type'] == 'adds') {
	$default_tab = 'adds-tab-select';
} else if ($_GET['search_type'] == 'request') {
	$default_tab = 'request-tab-select';
}
?>
<script>	
$(document).ready(function () {		
	$('#search-tabs').easytabs({
		animationSpeed: 200,
		updateHash: false,
		defaultTab:  '#<?php echo $default_tab;?>'
	});	
});
</script>
<?php  $this->inc('elements/footer.php'); ?>
