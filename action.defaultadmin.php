<?php
/**
 * DisplayAdminPanel($id, $params, $returnid, $message)
 * NOT PART OF THE MODULE API
 * 
 * This is an example of a simple method to present an Admin
 * panel.
 * 
 * It sets smarty tag values, and then calls the
 * code necessary to render the template.   
 */

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */ 
if (!isset($gCms)) exit;


/** 
 * For separated methods, you won't be able to do permission checks in
 * the DoAction method, so you'll need to do them as needed in your
 * method:
*/ 
if (! $this->CheckPermission('Use Dev4Auctions')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

/**
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the DisplayAdminPanel() method in the module body.
 */
 
// Tab Infrastructure for Admin Area -- create two tabs, one of which
// is only accessible if permissions are right
if (FALSE == empty($params['active_tab']))
  {
    $tab = $params['active_tab'];
  } else {
  $tab = '';
 }

// Start Auctions tab
$querylistauctions = "SELECT * FROM ".cms_db_prefix()."module_dev4auctions_auctions";
$results = $db->Execute($querylistauctions);

$rowclass = 'row1';

while ($results && $row = $results->FetchRow()) {
  $onerow = new stdClass();

  $onerow->id = $row['auction_id'];
  $onerow->title = $this->CreateLink($id, 'editauction', $returnid, strip_tags($row['name']), array('auction_id'=>$row['auction_id']));
  $onerow->desc = $row['description'];
  $onerow->product = $row['product_id'];
  $onerow->expire =  $row['end_date'];
  $onerow->editlink = $this->CreateLink($id, 'editauction', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('auction_id'=>$row['auction_id']));
  $onerow->deletelink = $this->CreateLink($id, 'deleteauction', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('auction_id'=>$row['auction_id']), $this->Lang('areyousure'));
  $onerow->rowclass = $rowclass;

  $entryarray[] = $onerow;

  ($rowclass=="row1"?$rowclass="row2":$rowclass="row1");  
}

//End Auctions tab


//Start Product Tab
$querylistproducts = "SELECT * FROM ".cms_db_prefix()."module_dev4auctions_products";
$resultproducts = $db->Execute($querylistproducts);

$rowclass = 'row1';

while ($resultproducts && $row = $resultproducts->FetchRow()) {
  $onerow = new stdClass();

  $onerow->id = $row['product_id'];
  $onerow->title = $this->CreateLink($id, 'editproduct', $returnid, strip_tags($row['pname']), array('product_id' => $row['product_id']));
  $onerow->desc = $row['pdescription'];
  $onerow->image = $row['productimage'];
  $onerow->editlink = $this->CreateLink($id, 'editproduct', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('product_id'=>$row['product_id']));
  $onerow->deletelink = $this->CreateLink($id, 'deleteproduct', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('product_id'=>$row['product_id']), $this->Lang('areyousure'));
  $onerow->rowclass = $rowclass;

  $entryarrayproducts[] = $onerow;

  ($rowclass=="row1"?$rowclass="row2":$rowclass="row1");  
}

//End Product Tab


//Start Bids Tab
if (isset($params['auction_id'])) {
  $querylistbids = "SELECT * FROM ".cms_db_prefix()."module_dev4auctions_bids WHERE auction_id=".$params['auction_id']." ORDER BY bprice DESC";
  $resultbids = $db->Execute($querylistbids);
} else {
  $querylistbids = "SELECT * FROM ".cms_db_prefix()."module_dev4auctions_bids ORDER BY auction_id DESC";
  $resultbids = $db->Execute($querylistbids);
}


$getauctions = 'SELECT auction_id, name from '.cms_db_prefix().'module_dev4auctions_auctions';
$auctions = $db->Execute($getauctions);  
$auctionslist = array();
while ($auctions && $row = $auctions->FetchRow()) {
   $auctionslist[$row['name']] = $row['auction_id'];
   $auctionsbyid[$row['auction_id']] = $row['name'];
}

$smarty->assign('start_form', $this->CreateFormStart($id, 'defaultadmin', $returnid));
$smarty->assign('title_auctionfilter', $this->Lang('title_bids_back_auctionfilter'));
$smarty->assign('auction_id',$this->CreateInputDropdown($id,'auction_id', $auctionslist, -1));
$smarty->assign('submit', $this->CreateInputHidden($id,'active_tab','bids').$this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('end_form', $this->CreateFormEnd());

$rowclass = 'row1';

while ($resultbids && $row = $resultbids->FetchRow()) {
  $onerow = new stdClass();

  $onerow->id = $row['bid_id'];
  $onerow->title = $this->CreateLink($id, 'editbid', $returnid, strip_tags($row['bname']), array('bid_id' => $row['bid_id']));
  $onerow->email = $row['bemail'];
  $onerow->price = $row['bprice'];
  $onerow->auctionid = $auctionsbyid[$row['auction_id']];
  $onerow->editlink = $this->CreateLink($id, 'editbid', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('bid_id'=>$row['bid_id']));
  $onerow->deletelink = $this->CreateLink($id, 'deletebid', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('bid_id'=>$row['bid_id']), $this->Lang('areyousure'));
  $onerow->rowclass = $rowclass;

  $entryarraybids[] = $onerow;

  ($rowclass=="row1"?$rowclass="row2":$rowclass="row1");  
}

//End Bids Tab



$tab_header = $this->StartTabHeaders().$this->SetTabHeader('general',$this->Lang('title_general'),('general' == $tab)?true:false);
$tab_header .= $this->SetTabHeader('products', $this->Lang('title_products'), ('products' == $tab)?true:false);
$tab_header .= $this->SetTabHeader('bids', $this->Lang('title_bids'), ('bids' == $tab)?true:false);

$this->smarty->assign('start_general_tab',$this->StartTab('general', $params));
$this->smarty->assign('products_tab',$this->StartTab('products', $params));
$this->smarty->assign('bids_tab',$this->StartTab('bids', $params));

$this->smarty->assign('tabs_start',$tab_header.$this->EndTabHeaders().$this->StartTabContent());
$this->smarty->assign('tab_end',$this->EndTab());
$this->smarty->assign('tabs_end',$this->EndTabContent());

$smarty->assign('addlink', $this->CreateLink($id, 'editauction', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addauction'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'editauction', $returnid, $this->Lang('addauction'), array(), '', false, false, 'class="pageoptions"'));
$smarty->assign('addlinkproduct', $this->CreateLink($id, 'editproduct', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addproduct'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'editproduct', $returnid, $this->Lang('addproduct'), array(), '', false, false, 'class="pageoptions"'));
$smarty->assign('addlinkbid', $this->CreateLink($id, 'editbid', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addbid'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'editbid', $returnid, $this->Lang('addbid'), array(), '', false, false, 'class="pageoptions"'));

// translated strings
$smarty->assign('welcome_text',$this->Lang('welcome_text'));
$smarty->assign_by_ref('items', $entryarray);
$smarty->assign_by_ref('products', $entryarrayproducts);
$smarty->assign_by_ref('bids', $entryarraybids);


echo $this->ProcessTemplate('adminpanel.tpl');
/**
 * You might also want to look at other modules that have done this :)
 *  (News and Questions are good examples)
 */

?>