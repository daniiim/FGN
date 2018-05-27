<?php  defined('C5_EXECUTE') or die("Access Denied.");
$page = Page::getCurrentPage();
$typeHandle = $page->getCollectionTypeHandle();
$pageID = $page->getCollectionID();
$pageName = $c->getCollectionName();
$path = str_replace("/concrete/concrete", "/concrete", $this->getThemePath());
$pageName = strtolower(str_replace(' ', '_', $pageName));
global $u;
if ($u->isLoggedIn()) {
	$ih = loader::helper('image');
	$uID = $u->getUserID();
	$ui = UserInfo::getByID($uID);
	$uName = $ui->getAttribute('first_name');
	$uImg = $ui->getAttribute('profile_image');
	$uThumb = $ih->getThumbnail($uImg, 30, 30, true);
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
	if ($uThumb) {
		$userIcon = '<img class="img-circle" src="'.$uThumb->src.'" >';
	} else {
		$userIcon = '<i class="icon-user"></i>';
	}
}
?>
<!DOCTYPE html>
<html lang="nl" class="<?php echo $typeHandle;  if ($u->isSuperUser()) { ?> logged-in<?php } ?><?php global $c; if ($c->isEditMode()) {   echo ' edit-mode';}?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link href="<?php echo $path; ?>/assets/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo $path; ?>/assets/images/favicon.ico">
<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
<?php
Loader::element('header_required');
?>
</head>
<body class="<?php echo $pageName;?>">
<header>
  <nav>
      <ul class="navigation">
        <li class="logo">
          <a href="<?php echo View::url('/'); ?>">
            <!-- <img alt="<?php  echo SITE?>" src="<?php echo $path; ?>/assets/images/logobg.svg"> -->
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 320 100" style="enable-background:new 0 0 320 100;" xml:space="preserve">
              <g>
                <path class="st0" d="M115,67.6c-3.7,0-6.8,2.9-6.8,6.6c0,3.7,3.1,6.7,6.8,6.7c3.7,0,6.7-3,6.7-6.7C121.8,70.5,118.7,67.6,115,67.6z"/>
                <path class="st0" d="M96.1,67.6c-3.7,0-6.8,2.9-6.8,6.6c0,3.7,3.1,6.7,6.8,6.7c3.7,0,6.7-3,6.7-6.7C102.9,70.5,99.8,67.6,96.1,67.6z"/>
                <path class="st0" d="M0.1,1.5v97.1H151V1.5H0.1z M23.3,69h-8.2v4.1h7.5v3.1h-7.5v6.3h-3.8V65.9h12L23.3,69z M38.4,82.5H25.5V65.9 h12.7V69h-8.9v3.6h8v3.1h-8v3.7h9.2V82.5z M54.3,82.5H41.4V65.9h12.7V69h-8.9v3.6h8v3.1h-8v3.7h9.2V82.5z M68.1,82.5H57.3V65.9H61 v13.4h7.1V82.5z M78.3,80.8c1.5,0,3.1-0.5,4.4-1.4v-5.1h1.7v6c-1.6,1.3-3.9,2.2-6.2,2.2c-4.8,0-8.7-3.7-8.7-8.4 c0-4.7,3.9-8.4,8.8-8.4c2.3,0,4.5,0.9,6.1,2.3l-1.1,1.4c-1.4-1.2-3.2-1.9-5-1.9c-3.8,0-6.8,2.9-6.8,6.6 C71.4,77.9,74.5,80.8,78.3,80.8z M96.1,82.6c-4.9,0-8.7-3.7-8.7-8.4c0-4.7,3.8-8.4,8.7-8.4c4.8,0,8.7,3.7,8.7,8.4 C104.8,78.9,101,82.6,96.1,82.6z M115,82.6c-4.9,0-8.7-3.7-8.7-8.4c0-4.7,3.8-8.4,8.7-8.4c4.8,0,8.7,3.7,8.7,8.4 C123.7,78.9,119.9,82.6,115,82.6z M133.8,82.5h-6.7V65.9h6.7c4.8,0,8.6,3.6,8.6,8.3C142.5,78.9,138.7,82.5,133.8,82.5z"/>
                <path class="st0" d="M133.9,67.6h-4.8v13.1h4.8c3.7,0,6.6-2.8,6.6-6.5C140.5,70.4,137.6,67.6,133.9,67.6z"/>
              </g>
              <g>
                <path class="st1" d="M235.4,69H232v5.6h3.5c2.1,0,3.3-1,3.3-2.9C238.7,69.9,237.5,69,235.4,69z"/>
                <path class="st1" d="M201.1,69h-3.2v10.3h3.4c2.8,0,4.8-2.1,4.8-5.1C206.1,71.1,203.9,69,201.1,69z"/>
                <polygon class="st1" points="263.1,76.2 268.4,76.2 265.8,69.8 	"/>
                <path class="st1" d="M151,1.5v97.1h169V1.5H151z M174.6,82.5h-3.4l-8.1-10.7v10.7h-3.6V65.9h3.4l8.1,10.7V65.9h3.6V82.5z M191.1,82.5h-12.9V65.9h12.7V69H182v3.6h8v3.1h-8v3.7h9.2V82.5z M201,82.5h-6.9V65.9h7.1c5.2,0,8.7,3.4,8.7,8.3 C209.9,79.1,206.2,82.5,201,82.5z M225.3,82.5h-12.9V65.9H225V69h-8.9v3.6h8v3.1h-8v3.7h9.2V82.5z M238.4,82.5l-2.6-4.8h-0.4H232 v4.8h-3.8V65.9h7.2c4.3,0,6.8,2.1,6.8,5.8c0,2.6-1.1,4.4-3.1,5.4l3.5,5.5H238.4z M256.3,82.5h-10.9V65.9h3.8v13.4h7.1V82.5z M270.9,82.5l-1.3-3.2h-7.7l-1.3,3.2h-3.9l7.2-16.6h3.9l7.1,16.6H270.9z M291.7,82.5h-3.4l-8.1-10.7v10.7h-3.6V65.9h3.4l8.1,10.7 V65.9h3.6V82.5z M302.3,82.5h-6.9V65.9h7.1c5.2,0,8.7,3.4,8.7,8.3C311.2,79.1,307.5,82.5,302.3,82.5z"/>
                <path class="st1" d="M302.4,69h-3.2v10.3h3.4c2.8,0,4.8-2.1,4.8-5.1C307.4,71.1,305.2,69,302.4,69z"/>
              </g>
            </svg>

          </a>
        </li>
        <div class="left">
          <?php
          $a = new GlobalArea('Navigatie');
          $a->display();
          ?>
        </div>
        <div class="right">
          <?php
          if (!$u->isLoggedIn()) {	?>
            <li class="login">
              <a class="icon-circle " href="<?php echo $this->url('/login')?>">Aanmelden</a>
            </li>
          <?php }
          else{
            ?>
            <li class="logedIn dropdown">
              <a class="icon-circle dropdown-url">Mijn FGN</a>
              <ul class="dropdown-container">
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url user" href="<?php echo $this->url('/mijn_fgn')?>">Mijn FGN Overzicht</a>
                </li>
                <li class="dropdown_second-item split">
                  <a class="dropdown_second-item_url adds"href="<?php echo $this->url('/mijn_fgn/advertenties')?>">Mijn advertenties</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url assignment"href="<?php echo $this->url('/mijn_fgn/opdrachten')?>">Mijn opdrachten</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url favorite"href="<?php echo $this->url('/mijn_fgn/favorieten')?>">Mijn favorieten</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url user2"href="<?php echo $this->url('/mijn_fgn/account')?>">Mijn account</a>
                </li>
                <li class="dropdown_second-item super-split">
                  <a class="dropdown_second-item_url favorite"href="<?= View::url('/login','logout'); ?>">Account uitloggen</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url settings"href="<?php echo $this->url('/mijn_fgn/wachtwoord_wijzigen')?>">Wachtwoord wijzigen</a>
                </li>
              </ul>
            </li>
            <?php
          } ?>
        </div>
      </ul>
      <a href="#" class="menu-mobile">
        <span class="menu-mobile_click">Close</span>
      </a>
      <a href="#" class="second-menu-back">
        Vorige
      </a>
  </nav>
  <div class="navbar-search">
    <?php  $this->inc('elements/search.php'); ?>
  </div>
</header>
<main>
