<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>
<section class="featured_profile dark">
  <div class="row-small">
    <h4 class="title">Uitgelichte profielen van aanbieders</h4>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </div>
  <div class="row">
    <div class="columns small-full medium-third featured_profile-account">
      <div class="featured_profile-account-container">
        <div class="featured_profile-account-image">
          <span class="featured_profile-account-image-number">123</span>
        </div>
        <h3 class="featured_profile-account-name">John Doe</h3>
        <div class="featured_profile-account-accountInfo">
          <p>
            <a href="#" class="featured_profile-account-accountInfo_adds">2 advertenties</a> in <a href="#" class="featured_profile-account-accountInfo_place">plaatsnaam</a>
          </p>
        </div>
        <div class="featured_profile-account-infoText">
          <?php $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
          ?>
          <p>
            <?php if(strlen($text) > 80){
              $text = substr($text, 0, 80) . '...';
            }
            echo $text;
            ?>
          </p>
        </div>
        <a class="featured_profile-account-url" href="#">Profiel bekijken</a>
      </div>
    </div>
    <div class="columns small-full medium-third featured_profile-account">
      <div class="featured_profile-account-container">
        <div class="featured_profile-account-image">
          <span class="featured_profile-account-image-number">123</span>
        </div>
        <h3 class="featured_profile-account-name">John Doe</h3>
        <div class="featured_profile-account-accountInfo">
          <p>
            <a href="#" class="featured_profile-account-accountInfo_adds">2 advertenties</a> in <a href="#" class="featured_profile-account-accountInfo_place">plaatsnaam</a>
          </p>
        </div>
        <div class="featured_profile-account-infoText">
          <?php $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
          ?>
          <p>
            <?php if(strlen($text) > 80){
              $text = substr($text, 0, 80) . '...';
            }
            echo $text;
            ?>
          </p>
        </div>
        <a class="featured_profile-account-url" href="#">Profiel bekijken</a>
      </div>
    </div>
    <div class="columns small-full medium-third featured_profile-account">
      <div class="featured_profile-account-container">
        <div class="featured_profile-account-image">
          <span class="featured_profile-account-image-number">123</span>
        </div>
        <h3 class="featured_profile-account-name">John Doe</h3>
        <div class="featured_profile-account-accountInfo">
          <p>
            <a href="#" class="featured_profile-account-accountInfo_adds">2 advertenties</a> in <a href="#" class="featured_profile-account-accountInfo_place">plaatsnaam</a>
          </p>
        </div>
        <div class="featured_profile-account-infoText">
          <?php $text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
          ?>
          <p>
            <?php if(strlen($text) > 80){
              $text = substr($text, 0, 80) . '...';
            }
            echo $text;
            ?>
          </p>
        </div>
        <a class="featured_profile-account-url" href="#">Profiel bekijken</a>
      </div>
    </div>
    <a class="all_profiles button" href="#">Naar alle profielen</a>
  </div>
</section>
