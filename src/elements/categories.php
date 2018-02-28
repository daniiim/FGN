<?php  defined('C5_EXECUTE') or die("Access Denied.");?>
<section class="light-bg">
<a class="btn-collapse-mobile" data-toggle="collapse" data-target=".section-categories"><i class="icon-layout"></i> Blader door rubrieken </a>
  <div class="container inner-xxs section-categories collapse">
    <div class="row">
      <div class="col-md-12">
        <?php
			$a = new GlobalArea('Categorien');
			$a->display();
		?>
      </div>
    </div>
  </div>
</section>