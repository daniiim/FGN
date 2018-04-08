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
          <a href="<?php echo View::url('/'); ?>"><img alt="<?php  echo SITE?>" src="<?php echo $path; ?>/assets/images/logobg.svg"></a>
        </li>
        <div class="left">
          <?php
          $a = new GlobalArea('Navigatie');
          $a->display();
          ?>
        </div>
        <div class="right">
          <li class="search">
            <a class="search_icon">Search</a>
          </li>
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
                  <a class="dropdown_second-item_url adds"href="<?php echo $this->url('/advertenties')?>">Mijn advertenties</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url adds"href="<?php echo $this->url('/advertenties')?>">Mijn advertenties</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url assignment"href="<?php echo $this->url('/opdrachten')?>">Mijn opdrachten</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url favorite"href="<?php echo $this->url('/favorieten')?>">Mijn favorieten</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url user2"href="<?php echo $this->url('/account')?>">Mijn account</a>
                </li>
                <li class="dropdown_second-item super-split">
                  <a class="dropdown_second-item_url favorite"href="<?= View::url('/login','logout'); ?>">Account uitloggen</a>
                </li>
                <li class="dropdown_second-item">
                  <a class="dropdown_second-item_url settings"href="<?php echo $this->url('/wachtwoord_wijzigen')?>">Wachtwoord wijzigen</a>
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
  <!-- <div class="navbar-search">
    <?php  $this->inc('elements/search.php'); ?>
  </div> -->
</header>
<main>
