<?php
defined('C5_EXECUTE') or die("Access Denied.");
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
