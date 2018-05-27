<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php
global $u;
if ($_GET['address']) {
    $address = $_GET['address'];
    setcookie('address', $address, time() + 3600, '/', 'morewithless.datact.nl');
} elseif ($_COOKIE['address']) {
    $address = $_COOKIE['address'];
}

if ($_GET['radius']) {
    $radius = $_GET['radius'];
    setcookie('radius', $radius, time() + 3600, '/', 'morewithless.datact.nl');
} elseif ($_COOKIE['radius']) {
    $radius = $_COOKIE['radius'];
}

$pagehandle = $c->getCollectionTypeHandle();
if ($pagehandle == 'sub_category' || $pagehandle == 'main_category') {
    $query = $c->getCollectionName();
	setcookie('query', $query, time() + 3600, '/', 'morewithless.datact.nl');
} else {
    if ($_GET['query']) {
        $query = $_GET['query'];
        setcookie('query', $query, time() + 3600, '/', 'morewithless.datact.nl');
    } elseif ($_COOKIE['query']) {
        $query = $_COOKIE['query'];
    }
}
?>

<form action="<?php echo $this->url( '/search' )?>" method="get" class="search-container clearfix">
  	<input type="hidden" value="<?php echo $_GET['diploma'];?>" name="diploma" />
    <input type="hidden" value="<?php echo $_GET['price'];?>" name="price" />
        
        <?php
		if (is_array($_GET['availibility'])) :
		foreach ($_GET['availibility'] as $day) : ?>
        	<input type="hidden" value="<?php echo $day;?>" name="availibility[]" />
        <?php 
		endforeach;
		endif;
		?>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      <?php if ($u->isLoggedIn()) {?>
      <a style="margin:0;" class="btn btn-orange btn-block" href="<?php echo $this->url('/mijn_fgn/advertenties/advertentie_categorie')?>"><i class="icon-pencil"></i> Plaats Advertentie</a>
      <?php ;} else {?>
		  <a style="margin:0;" class="btn btn-orange btn-block" href="<?php echo $this->url('/login/forward/1203/?message=Je moet ingelogd zijn om advertenties te kunnen plaatsen')?>"><i class="icon-pencil"></i> Plaats GRATIS Advertentie</a>
	  <?php  }  ?>
      
      </div>
      <div class="col-md-3" id="services">
        <input name="query" type="text" placeholder="Wat zoek je?" class="typeahead form-control" value="<?php echo $query;?>" class="form-control" />
      </div>
      <div class="col-md-2">
        <input name="address" value="<?php echo $address;?>" type="text" placeholder="Postcode of woonplaats...." class="form-control" class="form-control" />
      </div>
      <div class="col-md-2">
        <?php
	  $selectvalues = array (250,100,50,25,10,5);	  
	  ?>
        <select name="radius">
        <?php 
		if (empty ($_GET['radius'])) {
		echo '<option value="500" selected="selected">Alle afstanden</option>';		
		} else {
			echo '<option value="500">Alle afstanden</option>';	
		}?>
          <?php 
		foreach ($selectvalues as $value) {
			if ($value == $radius) {
				echo '<option value="'.$value.'" selected="selected">'.$value.' KM</option>';
			} else {
				echo '<option value="'.$value.'">'.$value.' KM</option>';
			}
			
		}
		?>
        </select>  
      </div>
      <div class="col-md-2">
        <button name="submit" type="submit" class="btn btn-block" style="margin:0;"> <i class="icon-search"></i> Zoek</button>
      </div>
    </div>
  </div>
</form>
