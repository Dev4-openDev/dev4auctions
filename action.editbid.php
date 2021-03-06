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


if (isset($params['bid_id']))
   {
   $query = 'SELECT * FROM '.cms_db_prefix().'module_dev4auctions_bids WHERE bid_id = ?';
   $result = $db->Execute($query,array($params['bid_id']));

   if ($result !== false)
      {
	  // load in the record if there was no error
      $row=$result->FetchRow();
      $sid = $row['bid_id']; // stupid -- we're passing the param, and then using the database version.
      $name = $row['bname'];
      $email = $row['bemail'];
      $price = $row['bprice'];
      $auction_id = $row['auction_id'];
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
   $desc = 'Some text describing this product';
   $name = 'some product';
   $email = 'some@npo.nl';
   $price = 1.00;
   $auction_id = 0;
  // $exp = '';
   }



$getauctions = 'SELECT auction_id, name from '.cms_db_prefix().'module_dev4auctions_auctions';
$auctions = $db->Execute($getauctions);  
$auctionslist = array();
while ($auctions && $row = $auctions->FetchRow()) {
   $auctionslist[$row['name']] = $row['auction_id'];
}



// set up form for Smarty
$smarty->assign('start_form', $this->CreateFormStart($id, 'save_bid', $returnid));
// give Smarty translated field titles 
$smarty->assign('titlename',$this->Lang('title_bid_name'));
$smarty->assign('title_description',$this->Lang('title_bid_description'));


// create inputs for the Form elements, and pass them to Smarty. You'd best look up the crazy long parameter
// lists for the Form API in lib/classes/class.module.inc.php
$smarty->assign('input_name',$this->CreateInputText($id,'bname',$name));
$smarty->assign('input_email',$this->CreateInputText($id,'bemail',$email));
$smarty->assign('auction_id',$this->CreateInputDropdown($id,'auction_id', $auctionslist, -1 ,$auction_id));
$smarty->assign('input_price',$this->CreateInputNumber($id, 'bprice', $price));
// pass a hidden key value along with the submit button
$smarty->assign('submit', $this->CreateInputHidden($id,'active_tab','bids').$this->CreateInputHidden($id,'bid_id',$sid).$this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('end_form', $this->CreateFormEnd());


// Display the populated template
echo $this->ProcessTemplate('add_edit_bid.tpl');

?>