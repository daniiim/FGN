<?php 
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); 
$title = $c->getCollectionName();
$article_intro = $c->getCollectionAttributeValue('info_article_intro');
$article = $c->getCollectionAttributeValue('info_article');
$header_image = $c->getCollectionAttributeValue('header_image');
if ($header_image): 
?>

<section class="backstretch-section img-bg shadow-in-bottom" style="background-image: url(<?php echo $bg->src;?>);">
  <div class="container inner-top-sm">
    <div class="row">
      <div class="col-md-12">
        <?php 
	echo '<h1 class="inner-bottom-xs text-center shadow-text inner-left inner-right">'.$title. '</h1>';
	echo '<div class="inner-xs inner-left-xs inner-right-xs tint-bg" id="article-intro">';
	echo $article_intro;
	echo '</div>';
;?>
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
		if (!$bg) {
		echo '<h1>'.$title. '</h1>';
			if ($article_intro) {
				echo '<div class="inner-xs inner-left-xs inner-right-xs tint-bg outer-bottom-xs" id="article-intro">';
				echo $article_intro;
				echo '</div>';
				}
		}
		if ($article) {
			echo '<div id="article-main" class="article-main">'. $article .'</div>';
		}
	  	$a = new Area('Main');
		$a->display($c);
	  	?>
         <?php
			$a = new GlobalArea('Info Main Onder');
			$a->display();
		?>
        <?php 
		$related_pages = $c->getAttribute('related_content', 'pageArray');
		if ($related_pages) :
		$nh     = Loader::helper('navigation');
		$count = count ($related_pages);		
		?>
        <section class="light-bg inner-xs inner-left-xs inner-right-xs related">
          <div class="row">
            <div class="col-md-12">
              <h3>Gerelateerde pagina's</h3>
            </div>
            <?php foreach ($related_pages as $related_page) :
			$title = $related_page->getCollectionName();
			$description = $related_page->getCollectionDescription();
			$url = $nh->getLinkToCollection($related_page);
			?>
            <ul>
              <li><a href="<?php echo $url;?>" title="<?php echo $title;?>"><?php echo $title;?></a></li>              
            </ul>
            <?php endforeach;?>
          </div>
        </section>
        <?php endif;?>
      </div>
      <div class="col-lg-4">
        <?php
			$a = new GlobalArea('Sidebar Statisch A');
			$a->display();
		?>
        <?php 
	  	$a = new Area('Sidebar');
		$a->display($c);
	  ?>
      <?php
			$a = new GlobalArea('Sidebar Statisch B');
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
		?></section>
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
<?php if ($article && !$article_intro) :?>
<script>
$(document).ready(function () {	
	$('.article-main').readmore({
	speed: 300,
	collapsedHeight: 60,
	moreLink: '<div class="text-right"><a class="btn-read-more" href="#"><i class="icon-plus-1"></i> Lees meer</a></div>',
	lessLink: '<div class="text-right"><a class="btn-read-more" href="#"><i class="icon-minus-1"></i> Lees minder</a></div>'
	});
	
});
</script>
<?php endif;?>