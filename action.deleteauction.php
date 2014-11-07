<?php
if (!isset($gCms)) exit;


$auction_id = '';
if (isset($params['auction_id']))
  {
    $auction_id = $params['auction_id'];
  }

//news_admin_ops::delete_article($auction_id);
$query = "DELETE FROM ".cms_db_prefix()."module_dev4auctions_auctions WHERE auction_id = ?";
$result = $db->Execute($query, array($auction_id));

$params = array('tab_message'=> 'articledeleted', 'active_tab' => 'articles');
$this->Redirect($id, 'defaultadmin', $returnid, $params);
?>
