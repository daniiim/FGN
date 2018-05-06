<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
//orderinfo
$order_name = $c->getAttribute('pay_product_name');
$order_transaction_id = $c->getAttribute('pay_id');
$order_amount_raw = $c->getAttribute('pay_amount');
$order_amount = number_format($order_amount_raw, 2, '.', ' ');

$order_vat_amount_raw = ($order_amount/100) * 21;
$order_vat_amount = number_format((float)$order_vat_amount_raw, 2, '.', '');
$order_amount_ex_vat_raw = $order_amount - $order_vat_amount;
$order_amount_ex_vat = number_format((float)$order_amount_ex_vat_raw, 2, '.', '');

$order_status = $c->getAttribute('pay_status');

$order_date = date('d-m-Y', strtotime($c->getAttribute('pay_date')));
$order_date_completed = date('d-m-Y', strtotime($c->getAttribute('pay_date_completed')));
$order_date_valid = date('d-m-Y', strtotime($c->getAttribute('product_date_valid')));
$description = $c->getCollectionDescription();
//userinfo
$u        = new user();
$uID 		= $u->getUserID();
$ui       = UserInfo::getByID($uID);
$uName    = $ui->getAttribute('first_name');
$uSirName = $ui->getAttribute('sir_name');
$uStreet = $ui->getAttribute('address_street_name');
$uStreetNr = $ui->getAttribute('address_street_nr');
$uCity = $ui->getAttribute('address_city');
$uZip = $ui->getAttribute('address_zip');




?>

<div class="container">
  <div class="row inner-xs">
  <div class="col-md-8 center-block">
  <div class="light-bg inner-xs inner-left-xs inner-right-xs outer-bottom-xs">
    <table class="table table-no-borders" id="print">
      <thead>
        <tr>
          <th colspan="3"><img style="max-width: 189px;" class="img-responsive" alt="<?php  echo SITE?>" src="<?php echo $this->getThemePath()?>/assets/images/logo.png"><div style="border-bottom:1px solid #cccccc; margin-top:20px;"></span></th>

        </tr>
      </thead>
      <thead>
      <tr>
      <td colspan="2">
      <ul class="list-unstyled outer-bottom-xs">
	  <li><?php echo $uName;?> <?php echo $uSirName;?></li>
      <li><?php echo $uStreet;?> <?php echo $uStreetNr;?></li>
      <li><?php echo $uCity;?></li>
      <li><?php echo $uZip;?></li>
      </ul>
	  <ul class="list-def">
			  <li><span>Factuurdatum:</span><?php echo $order_date_completed;?></li>
			  <li><span>Factuurnummer:</span><?php echo $c->getCollectionName();?></li>
			  <li><span>Klantnummer:</span><?php echo $uID;?></li>
		  </ul>
      </td>
      </tr>
        <tr>
          <th colspan="3"><h3>Factuur FeelGoodNederland</H3> </th>

        </tr>
      </thead>
      <tbody>

        <tr>
          <td><?php echo $order_name;?></td>
          <td><?php echo $description;?> </td>
          <td></td>
        </tr>
         <tr>
		 <td><b>Totaal</b></td>
          <td class="text-right" colspan="2"><b>Totaal &euro; <?php echo $order_amount;?></b></td>

        </tr>
		<tr><td colspan="3"><div style="border-bottom:1px solid #cccccc; margin-top:20px;"></td></tr>
		<tr>

          <td colspan="3"><p>Dit bedrag is inclusief 21% btw. Het BTW bedrag is &euro; <?php echo $order_vat_amount;?></p></td>

        </tr>
      </tbody>
    </table>
    <input type="button" class="btn" onclick="printTable('print')" value="Afdrukken" />
    </div>
    </div>
    <div class="col-md-8 center-block">
       <?php
			$a = new GlobalArea('Bestel Historie');
			$a->display();
		?>
    </div>
  </div>
</div>
<script>
function printTable(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<?php  $this->inc('elements/footer.php'); ?>
