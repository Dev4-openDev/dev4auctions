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



if (isset($params['auction_id'])) {
   $auction_id = $params['auction_id'];
}
$name = $this->Lang('bid_front_value_name');
$email = $this->Lang('bid_front_value_email');

// set up form for Smarty
$smarty->assign('start_form', $this->CreateFormStart($id, 'save_bid_front', $returnid));
// give Smarty translated field titles 
$smarty->assign('title_name',$this->Lang('bid_front_title'));
$smarty->assign('title_email',$this->Lang('bid_front_mail'));
$smarty->assign('title_price',$this->Lang('bid_front_price'));


// create inputs for the Form elements, and pass them to Smarty. You'd best look up the crazy long parameter
// lists for the Form API in lib/classes/class.module.inc.php
$smarty->assign('input_name',$this->CreateInputText($id,'bname',$name));
$smarty->assign('input_email',$this->CreateInputText($id,'bemail',$email));
$smarty->assign('auction_id',$this->CreateInputHidden($id,'auction_id', $auction_id));
$smarty->assign('input_price',$this->CreateInputNumber($id, 'bprice', 1));
// pass a hidden key value along with the submit button
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', 'Bied'));
$smarty->assign('end_form', $this->CreateFormEnd());

// Display the populated template
echo $this->ProcessTemplate('front_placebid.tpl');

?>