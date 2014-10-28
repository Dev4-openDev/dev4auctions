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

 $querylistauctions = "SELECT * FROM ".cms_db_prefix()."module_dev4auctions_auctions";

$results = $db->Execute($querylistauctions);
$row = $results->FetchRow();


$tab_header = $this->StartTabHeaders().$this->SetTabHeader('general',$this->Lang('title_general'),('general' == $tab)?true:false);
$tab_header .= $this->SetTabHeader('products', $this->Lang('title_products'), ('products' == $tab)?true:false);
$tab_header .= $this->SetTabHeader('settings', $this->Lang('title_settings'), ('settings' == $tab)?true:false);

$this->smarty->assign('start_general_tab',$this->StartTab('general', $params));
$this->smarty->assign('products_tab',$this->StartTab('products', $params));
$this->smarty->assign('settings_tab',$this->StartTab('settings', $params));

$this->smarty->assign('tabs_start',$tab_header.$this->EndTabHeaders().$this->StartTabContent());
$this->smarty->assign('tab_end',$this->EndTab());
$this->smarty->assign('tabs_end',$this->EndTabContent());

// translated strings
$smarty->assign('welcome_text',$this->Lang('welcome_text'));
var_dump($row);

echo $this->ProcessTemplate('adminpanel.tpl');
/**
 * You might also want to look at other modules that have done this :)
 *  (News and Questions are good examples)
 */

?>