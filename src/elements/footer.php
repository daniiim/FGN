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
        <h2>Ontdekken</h2>
        <ul class="footer_head-sub">
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Bekijk profielen</a></li>
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Bekijk opdrachten</a></li>
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Bekijk advertenties</a></li>
        </ul>
      </li>
      <li class="footer_head-about">
        <h2>Over FeelGood</h2>
        <ul class="footer_head-sub">
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Over ons</a></li>
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Hoe werkt het</a></li>
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Overzicht kosten</a></li>
        </ul>
      </li>
      <li class="footer_head-participate">
        <h2>Meedoen</h2>
        <ul class="footer_head-sub">
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Wordt gratis lid</a></li>
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Plaats advertentie</a></li>
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Plaats een opdracht</a></li>
        </ul>
      </li>
      <li class="footer_head-support">
        <h2>Support</h2>
        <ul class="footer_head-sub">
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Online kennisbank</a></li>
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Veel gestelde vragen</a></li>
          <li class="footer_head-item"><a href="#" class="footer_head-item_url">Uw chat starten</a></li>
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
<?php Loader::element('footer_required'); ?>
</body></html>
