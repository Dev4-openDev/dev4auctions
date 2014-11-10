<?php
/**
 *
 * This is an example of a method to add
 * database data on page using a template.
 *
 * If the "skeleton_id" parameter is set, this page will
 * allow you to edit that record. Otherwise, it will let you
 * add a new record .
 *
 * Note that it uses a template, and is thus very powerful,
 * even if it's simple.
 */

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */
if (!isset($gCms)) exit;

// don't trust that this was safe, just because the link is hidden if the option is off!
// always code defensively! There are beasties that lurk and things go bump in the night.
if (! $this->GetPreference('allow_add',1) == 1) exit;

/**
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the action.
 */

// get our records from the database
$db = $gCms->GetDb();


if (isset($params['auction_id']))
   {
   $query = 'SELECT * FROM '.cms_db_prefix().'module_dev4auctions_auctions WHERE auction_id = ?';
   $result = $db->Execute($query,array($params['auction_id']));



   if ($result !== false)
      {
	  // load in the record if there was no error
      $row=$result->FetchRow();
      $sid = $row['auction_id']; // stupid -- we're passing the param, and then using the database version.
      $name = $row['name'];
      $desc = $row['description'];
      $product = $row['product_id'];
	  // we decode this next one, because it gets stored encoded, and the CreateTextArea API encodes as well, so
	  // if we didn't decode it, we'd get double encoding.
      //$exp = html_entity_decode($row['explanation']); 
      }
   else
      {
      // yeah, that's graceful :(
      echo "Database error!";
      exit;
      }
   }
else
   {
   // if we didn't retrieve a record, set some default values
   $sid = -1;
   $desc = 'Some text describing this auction';
   $name = 'some name';
   $product = '???';
  // $exp = '';
   }

$usedproduct = $this->GetPreference('default_product', '');
if (isset($product)) {
   $usedproduct = $product;
}


$productList = array();
$productquery = "SELECT product_id, pname FROM ".cms_db_prefix()."module_dev4auctions_products ORDER BY pname ASC";
$productresult = $db->Execute($productquery);

while ($productresult && $row = $productresult->FetchRow()) {
   $productList[$row['pname']] = $row['product_id'];
}

// set up form for Smarty
$smarty->assign('start_form', $this->CreateFormStart($id, 'save_auction', $returnid));
// give Smarty translated field titles 
$smarty->assign('titlename',$this->Lang('title_name'));
$smarty->assign('product',$this->Lang('title_product'));
$smarty->assign('title_description',$this->Lang('title_description'));


// create inputs for the Form elements, and pass them to Smarty. You'd best look up the crazy long parameter
// lists for the Form API in lib/classes/class.module.inc.php
$smarty->assign('input_name',$this->CreateInputText($id,'name',$name));
$smarty->assign('input_product', $this->CreateInputDropdown($id, 'product_id', $productList, -1, $usedproduct));
//$smarty->assign('input_product',$this->CreateInputText($id,'product',$product));
$smarty->assign('input_description',$this->CreateTextArea(true, $id, $desc, 'description', '', '', '', '', 40, 5));
// pass a hidden key value along with the submit button
$smarty->assign('submit', $this->CreateInputHidden($id,'auction_id',$sid).$this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('end_form', $this->CreateFormEnd());


// Display the populated template
echo $this->ProcessTemplate('add_edit.tpl');

?>