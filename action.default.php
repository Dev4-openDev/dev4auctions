<?php
/**
 *
 * This is an example of a simple method to display
 * database data on page using a template.
 *
 * If the "skeleton_id" parameter is set, this page will
 * display only that single record. Otherwise, it will display
 * one page worth of records. This is really silly in this case,
 * because the view is identical. If you have a more complex
 * record though, you could do something useful.
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

$db = $gCms->GetDb();
$query = 'SELECT * from '.cms_db_prefix().'module_dev4auctions_auctions';
/**
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the action.
 */

// get our records from the database

if (isset($params['auction_id'])) {
   $query .= ' JOIN '.cms_db_prefix().'module_dev4auctions_products ON '.cms_db_prefix().'module_dev4auctions_auctions.product_id='.cms_db_prefix().'module_dev4auctions_products.product_id WHERE auction_id='.$params['auction_id'];

   $result = $db->Execute($query);
   $list = array();

   $mediaclass = 'media-left';

   while ($result != false && $row=$result->FetchRow() ) {

      $onerow = new stdClass();
      $onerow->id = $row['auction_id'];
      $onerow->name = $row['name'];
      $onerow->pname = $row['pname'];
      $onerow->image = $row['productimage'];
      $onerow->active = $row['active'];
      $onerow->pdesc = $row['pdescription'];
      $onerow->adesc = $row['description'];



      $getbids = 'SELECT * from '.cms_db_prefix().'module_dev4auctions_bids where auction_id=? ORDER BY bprice ';
      $return = $db->Execute($getbids, array($row['auction_id']));

      $bids = array();
      while ($return !=false && $row = $return->FetchRow()) {
         
         $bids['bid_id']=$row['bid_id'];
         $bids['bname']=$row['bname'];
         $bids['bemail']=$row['bemail'];
         $bids['bprice']=$row['bprice'];
              
      }

      $onerow->bids = $bids;
      $onerow->class = $mediaclass;

      array_push($list, $onerow);

      ($mediaclass=="media-left"?$mediaclass="media-right":$mediaclass="media-left");  
   }

   $this->smarty->assign('list', $list);
   echo $this->ProcessTemplate('single_auctions.tpl');

} elseif(isset($params['items'])) {
   $query .= ' JOIN '.cms_db_prefix().'module_dev4auctions_products ON '.cms_db_prefix().'module_dev4auctions_auctions.product_id='.cms_db_prefix().'module_dev4auctions_products.product_id ORDER BY auction_id DESC LIMIT '.$params['items'];

   $result = $db->Execute($query);
   $list = array();

   $mediaclass = 'media-left';

   while ($result != false && $row=$result->FetchRow() ) {

      $onerow = new stdClass();
      $onerow->id = $row['auction_id'];
      $onerow->name = $row['name'];
      $onerow->pname = $row['pname'];
      $onerow->image = $row['productimage'];
      $onerow->active = $row['active'];
      $onerow->pdesc = $row['pdescription'];
      $onerow->adesc = $row['description'];



      $getbids = 'SELECT * from '.cms_db_prefix().'module_dev4auctions_bids where auction_id=? ORDER BY bprice ';
      $return = $db->Execute($getbids, array($row['auction_id']));

      $bids = array();
      while ($return !=false && $row = $return->FetchRow()) {
         
         $bids['bid_id']=$row['bid_id'];
         $bids['bname']=$row['bname'];
         $bids['bemail']=$row['bemail'];
         $bids['bprice']=$row['bprice'];
              
      }

      $onerow->bids = $bids;
      $onerow->class = $mediaclass;

      array_push($list, $onerow);

      ($mediaclass=="media-left"?$mediaclass="media-right":$mediaclass="media-left");  
   }

   $this->smarty->assign('list', $list);
   echo $this->ProcessTemplate('front_auctions.tpl');

} else {
   $query .= ' JOIN '.cms_db_prefix().'module_dev4auctions_products ON '.cms_db_prefix().'module_dev4auctions_auctions.product_id='.cms_db_prefix().'module_dev4auctions_products.product_id ';

   $result = $db->Execute($query);
   $list = array();

   $mediaclass = 'links';

   while ($result != false && $row=$result->FetchRow() ) {

      $onerow = new stdClass();
      $onerow->id = $row['auction_id'];
      $onerow->name = $row['name'];
      $onerow->pname = $row['pname'];
      $onerow->active = $row['active'];
      $onerow->pdesc = $row['pdescription'];
      $onerow->adesc = $row['description'];



      $getbids = 'SELECT * from '.cms_db_prefix().'module_dev4auctions_bids where auction_id=? ORDER BY bprice ';
      $return = $db->Execute($getbids, array($row['auction_id']));

      $bids = array();
      while ($return !=false && $row = $return->FetchRow()) {
         
         $bids['bid_id']=$row['bid_id'];
         $bids['bname']=$row['bname'];
         $bids['bemail']=$row['bemail'];
         $bids['bprice']=$row['bprice'];
              
      }

      $onerow->bids = $bids;
      $onerow->image = $row['productimage'];
      $onerow->class = $mediaclass;

      array_push($list, $onerow);

      ($mediaclass=="links"?$mediaclass="rechts":$mediaclass="links");  
   }

   $this->smarty->assign('list', $list);
   echo $this->ProcessTemplate('list_auctions.tpl');
}

/*

$db = $gCms->GetDb();

$query = 'SELECT * from '.cms_db_prefix().
   'module_dev4auctions_auctions';

if (isset($params['auction_id']))
   {
   // *ALWAYS* use parameterized queries with user-provided input
   // to prevent SQL-Injection attacks!
   $query .= ' where auction_id = ?';
   $result = $db->Execute($query,array($params['auction_id']));
   $mode = 'detail'; // we're viewing a single record
   }
else
   {
   // we're not getting a specific record, so show 'em all. Probably should paginate.
   $result = $db->Execute($query);
   $mode = 'summary'; // we're viewing a list of records
   }
   
$records = array();
while ($result !== false && $row=$result->FetchRow())
   {
   // create a new object for every record that we retrieve
   $rec = new stdClass();
   $rec->id = $row['auction_id'];
   $rec->name = $row['name'];
   $rec->description = $row['description'];

   // create attributes for rendering "view" links for the object.
   // $id and $returnid are predefined for us by the module API
   // that last parameter is the Pretty URL link
   $rec->view = $this->CreateFrontendLink($id, $returnid, 'default', $this->Lang('link_view'),
      array('auction_id'=>$rec->id),'',false,true,'',false,'skeleton/view/'.$rec->id.'/'.$returnid);
   $rec->edit = $this->CreateFrontendLink($id, $returnid, 'add_edit', $this->Lang('edit'),
      array('auction_id'=>$rec->id),'',false,true,'',false,'skeleton/edit/'.$rec->id.'/'.$returnid);
   array_push($records,$rec);
   } else {
      $rec = new stdClass();
      $rec->id = 12;
      $rec->name = 'something';
      $rec->description = 'whent wrong';

      // create attributes for rendering "view" links for the object.
      // $id and $returnid are predefined for us by the module API
      // that last parameter is the Pretty URL link

      array_push($records,$rec);
   }

// Expose the list to smarty.
$this->smarty->assign('records',$records);

// Tell Smarty which mode we're in
$this->smarty->assign('mode',$mode);

// and a count of records
$this->smarty->assign('title_num_records',$this->Lang('title_num_records',array(count($records))));

if ($this->GetPreference('allow_add',1) == 1)
   {
   $this->smarty->assign('add', $this->CreateFrontendLink($id, $returnid, 'add_edit',
      $this->Lang('add_record'),array(),'',false,true,'',false,'skeleton/add/'.$returnid));

   }
else
   {
   $this->smarty->assign('add', '');
   }

if (isset($params['module_message']))
   {
   $this->smarty->assign('module_message',$params['module_message']);
   }
else
   {
   $this->smarty->assign('module_message','');
   }

// Display the populated template
*/

?>