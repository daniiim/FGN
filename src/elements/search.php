<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php
global $u;
$group = $u->getUserGroups();
if (in_array('Administrators',$group)) {
	$isAdministrator = true; //misschien een functie voor maken, duh
}
$address = $_GET['address'];
$radius = $_GET['radius'];
$query = $_GET['query'];


Loader::model('page_list');
$pagehandles = array('main_category');
$pl = new PageList();
$pl->sortByName();
$pl->filterByCollectionTypeHandle($pagehandles);
$pages = $pl->get() ;
foreach ($pages as $page) {
		$main_categories [$page->getCollectionPath()] = $page->getCollectionName();
}

?>
<?php
$satc = new SelectAttributeTypeController(AttributeType::getByHandle('select'));
$ak = CollectionAttributeKey::getByHandle('sub_category_tags');
$satc->setAttributeKey($ak);
$values = $satc->getOptions();
foreach ($values as $v) {
	$sub_categories[] = $v;
}
?>
  <script>
$( document ).ready(function() {
	<?php if (!$isAdministrator) :?>
		$('.search-container').parsley();
	<?php endif;?>
	var substringMatcher = function(strs) {
		return function findMatches(q, cb) {
		var matches, substringRegex;

		// an array that will be populated with substring matches
		matches = [];

		// regex used to determine if a string contains the substring `q`
		substrRegex = new RegExp(q, 'i');

		// iterate through the pool of strings and for any string that
		// contains the substring `q`, add it to the `matches` array
		$.each(strs, function(i, str) {
		  if (substrRegex.test(str)) {
			matches.push(str);
		  }
		});

		cb(matches);
	  };
	};

	  var services = [
		<?php
		foreach ($sub_categories as $sub) {
			echo '"'.strval($sub).'",';
		}
		?>
	];
$('.typeahead').typeahead({
  hint: false,
  highlight: true,
  minLength: 2,
  classNames: {
	wrapper: "Wrapper-typeahead",
    input: 'Typeahead-input',
    hint: 'Typeahead-hint',
    selectable: 'Typeahead-selectable'
  }
},
{
  name: 'services',
  limit: 14,
  source: substringMatcher(services)
});

});
</script>
<form action="<?php echo $this->url( '/zoek_resultaten' )?>" method="get" class="search-container clearfix form-inline">
<div class="container">
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
      <?php if ($u->isLoggedIn()) {?>
		  <?php
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
		  ?>
      <a class="no-margin btn btn-green hidden-sm hidden-xs" href="<?php echo $this->url('/mijn_fgn/advertenties/advertentie_categorie')?>"><i class="icon-pencil"></i> Plaats advertentie (<?php echo $total_available;?>)</a>
		<?php ;} else {?>
		 <a class="no-margin btn btn-green hidden-sm hidden-xs" href="<?php echo $this->url('/mijn_fgn/advertenties/advertentie_categorie')?>"><i class="icon-pencil"></i> Plaats gratis advertentie</a>
	  <?php  }  ?>

      <div class="input-select-combo">
		<input name="query" type="text" placeholder="Wat zoek je?" value="<?php echo $query;?>" class="form-control typeahead delete-input open-collapse-mobile-search" />
	<button name="submit" type="submit" class="btn no-margin hidden-md hidden-lg btn-search-mobile"><i class="icon-search"></i> </button>
        <select name="category" class="form-control collapse-mobile-search">
          <?php
            if (!empty ($_GET['category'])) {
			echo '<option value="0">Alle Categorieën</option>';

            } else {
                echo '<option value="0" selected="selected">Alle Categorieën</option>';
            }?>
            <?php foreach ($main_categories as $path=>$title){ ?>

			<?php if ($_GET['category'] == $path) :?>
         <option selected="selected" value="<?php echo $path;?>"><?php echo $title;?></option>
		 <?php else :?>
		 <option value="<?php echo $path;?>"><?php echo $title;?></option>
		 <?php endif;?>
         <?php ;} ?>
        </select>
		</div>
		<span class="collapse-mobile-search">
        <input name="address" value="<?php echo $address;?>" type="text" placeholder="Postcode of plaatsnaam" class="form-control" />


        <?php
		$selectvalues = array (250,100,50,25,10,5);
		?>
        <select name="radius" class="form-control">
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


        <button name="submit" type="submit" class="btn no-margin"> <i class="icon-search"></i> Zoek</button>
      </span>
   </div>
</form>
<script>
$( ".open-collapse-mobile-search" ).focus(function() {
  $( ".collapse-mobile-search" ).show();
});

</script>
