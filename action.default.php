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
	  $onerow->startdate =  $row['start_date'];
      $onerow->enddate =  $row['end_date'];
      $onerow->pdesc = $row['pdescription'];
      $onerow->adesc = $row['description'];
      $onerow->bieden = $this->CreateLink($id, 'placebid', $returnid, strip_tags('Bied'), array('auction_id' => $row['auction_id']), '', true);
	  $onerow->currentdate = time();


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
	  $onerow->startdate =  $row['start_date'];
      $onerow->enddate =  $row['end_date'];
      $onerow->pdesc = $row['pdescription'];
      $onerow->adesc = $row['description'];
      $onerow->bieden = $this->CreateLink($id, 'placebid', $returnid, strip_tags('Bied'), array('auction_id' => $row['auction_id']), '', true);
      $onerow->meerinfo = $this->CreateLink($id, 'default', $returnid, strip_tags('meerinfo'), array('auction_id' => $row['auction_id']), '', true);
	  $onerow->currentdate = time();



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
	  $onerow->startdate =  $row['start_date'];
      $onerow->enddate =  $row['end_date'];
      $onerow->pdesc = $row['pdescription'];
      $onerow->adesc = $row['description'];
      $onerow->image = $row['productimage'];
      $onerow->bieden = $this->CreateLink($id, 'placebid', $returnid, strip_tags('Bied'), array('auction_id' => $row['auction_id']), '', true);
      $onerow->meerinfo = $this->CreateLink($id, 'default', $returnid, strip_tags('meerinfo'), array('auction_id' => $row['auction_id']), '', true);
	  $onerow->currentdate = time();

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

      ($mediaclass=="links"?$mediaclass="rechts":$mediaclass="links");  
   }

   $this->smarty->assign('list', $list);
   echo $this->ProcessTemplate('listauctions.tpl');
}


?>