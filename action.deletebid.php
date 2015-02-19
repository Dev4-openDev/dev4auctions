<?php
if (!isset($gCms)) exit;


$auction_id = '';
if (isset($params['bid_id']))
  {
    $bid_id = $params['bid_id'];
  }

//news_admin_ops::delete_article($auction_id);
$query = "DELETE FROM ".cms_db_prefix()."module_dev4auctions_bids WHERE bid_id = ?";
$result = $db->Execute($query, array($bid_id));

$params = array('tab_message'=> 'biddeleted', 'active_tab' => 'Bids');
$this->Redirect($id, 'defaultadmin', $returnid, $params);
?>
