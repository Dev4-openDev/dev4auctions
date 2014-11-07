<?php
if (!isset($gCms)) exit;


$auction_id = '';
if (isset($params['product_id']))
  {
    $product_id = $params['product_id'];
  }

//news_admin_ops::delete_article($auction_id);
$query = "DELETE FROM ".cms_db_prefix()."module_dev4auctions_products WHERE product_id = ?";
$result = $db->Execute($query, array($product_id));

$params = array('tab_message'=> 'productdeleted', 'active_tab' => 'Products');
$this->Redirect($id, 'defaultadmin', $returnid, $params);
?>
