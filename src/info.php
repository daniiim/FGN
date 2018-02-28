<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
$title = $c->getCollectionName();
$article_intro = $c->getCollectionAttributeValue('info_article_intro');
$article = $c->getCollectionAttributeValue('info_article');
$header_image = $c->getCollectionAttributeValue('header_image');
if ($header_image): {
	$ih = Loader::helper('image');
	$bg = $ih->getThumbnail($header_image, 1920, 9999);
}
?>
<section class="img-bg" style="background-image: url(<?php echo $bg->src;?>);">
  <div class="container inner-top-sm">
    <div class="row">
      <div class="col-md-12">
        <?php 
		$a = new Area('Title');
		$a->display($c);
		;?>
      </div>
	  <div class="col-md-8 col-md-offset-2">
     <?php
			$a = new GlobalArea('Lead 2');
			$a->display();
	?>
    </div>
    </div>
  </div>
</section>
<?php endif;?>
<section>
  <div class="container inner-xxs">
    <div class="row">
    <div class="col-md-12"><?php  $this->inc('elements/breadcrumbs.php'); ?></div>
	 
	 
      <div class="col-lg-8">
        <?php 
		if ($article) {
			echo '<div id="article-main" class="article-main">'. $article .'</div>';
		}
	  	$a = new Area('Main');
		$a->display($c);
	  	?>
        
        <?php 
		$related_pages = $c->getAttribute('related_content', 'pageArray');
		if ($related_pages) :
		$nh     = Loader::helper('navigation');
		$count = count ($related_pages);		
		?>
        
          <div class="related-pages">
           
              <h3>Gerelateerde pagina's</h3>
            <ul>
            <?php foreach ($related_pages as $related_page) :
			$title = $related_page->getCollectionName();
			$description = $related_page->getCollectionDescription();
			$url = $nh->getLinkToCollection($related_page);
			?>
            
              <li><a href="<?php echo $url;?>" title="<?php echo $title;?>"><?php echo $title;?></a></li>              
            
            <?php endforeach;?>
			</ul>
          </div>
        
        <?php endif;?>
      </div>
      <div class="col-lg-4">
        <?php
			$a = new GlobalArea('Sidebar Info Statisch A');
			$a->display();
		?>
        <?php 
	  	$a = new Area('Sidebar');
		$a->display($c);
	  ?>
      <?php
			$a = new GlobalArea('Sidebar Info Statisch B');
			$a->display();
		?>
         <?php 
	  	$a = new Area('Sidebar Onder');
		$a->display($c);
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
<?php if ($article) :?>
<script>
$(document).ready(function () {	
	$('.article-main').readmore({
	speed: 300,
	collapsedHeight: 460,
	moreLink: '<div class="text-right inner-xxs"><a class="btn-read-more" href="#"><i class="icon-plus-1"></i> Lees meer</a></div>',
	lessLink: '<div class="text-right inner-xxs"><a class="btn-read-more" href="#"><i class="icon-minus-1"></i> Lees minder</a></div>'
	});
	
});
</script>
<?php endif;?>