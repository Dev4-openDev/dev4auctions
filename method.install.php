<?php
	
	#checking if all is set.
	if (!isset($gCms)) exit;

	#requering DB Object
	$db = $gCms->GetDb();

	// mysql-specific, but ignored by other database
	$taboptarray = array( 'mysql' => 'TYPE=InnoDB' );

	#SQL Statemenst (CRUD)
	$dict = NewDataDictionary( $db );

	$products = "
			product_id I KEY,
			pname C(255),
			pdescription X,
			productimage C(255)
			";

	$auctions = "
			auction_id I KEY,
			name C(255),
			description X,
			active B,
			product_id I
			";

	$bids = "
		bid_id I KEY,
		bname C(255),
		bemail C(255),
		bprice F,
		auction_id I
		";

	$sqlarrayproducts = $dict->CreateTableSQL( cms_db_prefix()."module_dev4auctions_products", $products, $taboptarray);
	$sqlarraybids = $dict->CreateTableSQL( cms_db_prefix()."module_dev4auctions_bids", $bids, $taboptarray);
	$sqlarrayauctions = $dict->CreateTableSQL( cms_db_prefix()."module_dev4auctions_auctions", $auctions, $taboptarray);

	$dict->ExecuteSQLArray($sqlarrayproducts);
	$dict->ExecuteSQLArray($sqlarraybids);
	$dict->ExecuteSQLArray($sqlarrayauctions);

	$joinquery = "ALTER TABLE `".cms_db_prefix()."module_dev4auctions_auctions` ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;";
	$db->Execute($joinquery);

	$db->CreateSequence(cms_db_prefix()."module_dev4auctions_products_seq");
	$db->CreateSequence(cms_db_prefix()."module_dev4auctions_bids_seq");
	$db->CreateSequence(cms_db_prefix()."module_dev4auctions_auctions_seq");

	$this->CreatePermission('Use Dev4Auctions', 'Use Dev4Auctions');
	$this->CreatePermission('Set Dev4Auctions Prefs','Set Dev4Auctions Prefs');
	$this->SetPreference("allow_add", true);

	$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('installed') );

?>