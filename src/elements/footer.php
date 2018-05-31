<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>
</main>
<?php
global $u;
$path = str_replace("/concrete/concrete", "/concrete", $this->getThemePath());
?>
<footer>
  <div class="row">
    <ul class="footer_head">
      <li class="footer_head-discover">
        <ul class="footer_head-sub">
            <?php
          $a = new GlobalArea('Footer Discover');
          $a->display();
          ?>
        </ul>
      </li>
      <li class="footer_head-about">
        <ul class="footer_head-sub">
          <?php
          $a = new GlobalArea('Footer About');
          $a->display();
          ?>
        </ul>
      </li>
      <li class="footer_head-participate">
        <ul class="footer_head-sub">
          <?php
          $a = new GlobalArea('Footer Participate');
          $a->display();
          ?>
        </ul>
      </li>
      <li class="footer_head-support">
        <ul class="footer_head-sub">
          <?php
          $a = new GlobalArea('Footer Support');
          $a->display();
          ?>
        </ul>
      </li>
    </ul>
    <ul class="footer_bottom">
      <li class="footer_bottom-social">
        <ul class="footer_bottom-sub">
          <h2>Social media</h2>
          <div class="footer-logs">
            <li class="footer_bottom-social-item">
              <a href="#" class="facebook">Facebook</a>
            </li>
            <li class="footer_bottom-social-item">
              <a href="#" class="instagram">Instagram</a>
            </li>
            <li class="footer_bottom-social-item">
              <a href="#" class="twitter">Twitter</a>
            </li>
          </div>
        </ul>
      </li>
      <li class="footer_bottom-news">
        <ul class="footer_bottom-sub">
          <h2>Nieuwsbrief</h2>
          <input type="text" id="newsletter" placeholder="E-mailadres"/>
          <label for="newsletter">E-mailadres</label>
          <button type="submit">Meld je aan</button>
        </ul>
      </li>
    </ul>
    <ul class="extra_info">
      <li class="extra_info-items">
        <ul class="extra_info-sub">
          <li class="extra_info-sub_item"><a href="#" class="extra_info-sub_item_url">Voorwaarden</a></li>
          <li class="extra_info-sub_item"><a href="#" class="extra_info-sub_item_url">Privacy</a></li>
          <li class="extra_info-sub_item"><a href="#" class="extra_info-sub_item_url">Cookies</a></li>
        </ul>
      </li>
      <li class="extra_info-items">
        <ul class="extra_info-sub">
          <li class="extra_info-sub_item"><a class="extra_info-sub_item_url">Feelgood Nederland</a></li>
          <li class="extra_info-sub_item"><a class="extra_info-sub_item_url">Alle rechten voorbehouden</a></li>
        </ul>
      </li>
    </ul>
  </div>
</footer>
<script src="<?php echo $path; ?>/js/app.js"></script>
<!-- Begin of Chaport Live Chat code -->
<script type="text/javascript">
(function(w,d,v2){
w.chaport = { app_id : '5a5de79ea1e8df39a25639cc' };

v2=w.chaport;v2._q=[];v2._l={};v2.q=function(){v2._q.push(arguments)};v2.on=function(e,fn){if(!v2._l[e])v2._l[e]=[];v2._l[e].push(fn)};var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://app.chaport.com/javascripts/insert.js';var ss=d.getElementsByTagName('script')[0];ss.parentNode.insertBefore(s,ss)})(window, document);
</script>
<!-- End of Chaport Live Chat code -->
<?php Loader::element('footer_required'); ?>
</body></html>
