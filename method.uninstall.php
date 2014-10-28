<?php
#-------------------------------------------------------------------------
# Module: Skeleton - a pedantic "starting point" module
# Version: 1.3, SjG
# Method: Uninstall
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/skeleton/
#
#-------------------------------------------------------------------------

/**
 * For separated methods, you'll always want to start with the following
 * line which check to make sure that method was called from the module
 * API, and that everything's safe to continue:
 */ 
if (!isset($gCms)) exit;


/** 
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the Uninstall() method in the module body.
 */

$db = $gCms->GetDb();

// remove the database table
$dict = NewDataDictionary( $db );

	// remove tables
	$sqlarrayproducts = $dict->DropTableSQL( cms_db_prefix()."module_dev4auctions_products", $products, $taboptarray);
	$sqlarraybids = $dict->DropTableSQL( cms_db_prefix()."module_dev4auctions_bids", $bids, $taboptarray);
	$sqlarrayauctions = $dict->DropTableSQL( cms_db_prefix()."module_dev4auctions_auctions", $auctions, $taboptarray);

	$dict->ExecuteSQLArray($sqlarrayproducts);
	$dict->ExecuteSQLArray($sqlarraybids);
	$dict->ExecuteSQLArray($sqlarrayauctions);

	// remove the sequence
	$db->DropSequence(cms_db_prefix()."module_dev4auctions_products_seq");
	$db->DropSequence(cms_db_prefix()."module_dev4auctions_bids_seq");
	$db->DropSequence(cms_db_prefix()."module_dev4auctions_auctions_seq");

// remove the permissions
	$this->RemovePermission('Use Dev4Auctions', 'Use Dev4Auctions');
	$this->RemovePermission('Set Dev4Auctions Prefs','Set Dev4Auctions Prefs');
// remove the preference
	$this->RemovePreference("allow_add", true);


// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));

?>