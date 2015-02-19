<?php
/**
 *
 * This is an example of a method to save
 * database data.
 *
 * If the "skeleton_id" parameter is -1, it's a new record.
 * Otherwise, we're updating an old record.
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

   if(isset($params['auction_id'])) {

      $bidsforauctionq = 'SELECT * FROM '.cms_db_prefix().'module_dev4auctions_bids WHERE auction_id='.$params['auction_id'].' ORDER BY bprice DESC';
      $bidsforauctione = $db->Execute($bidsforauctionq);
      $bidsforauction = $bidsforauctione->FetchRow();

      $auction = 'SELECT * FROM '.cms_db_prefix().'module_dev4auctions_auctions WHERE auction_id='.$params['auction_id'];
      $runquery = $db->Execute($auction);
      $result = $runquery->FetchRow();

      $cmsmailer = $this->GetModuleInstance('CMSMailer');

      if($bidsforauction['bprice'] < $params['bprice']) {

            $smarty->assign('auction_link', $this->CreateLink($id, 'default', $returnid, $result['name'],array('auction_id' => $result['auction_id']), ''));

            $smarty->assign('title_overbod', $this->Lang('mail_overgeboden_title'));
            $smarty->assign('message_overbod', $this->Lang('mail_overgeboden_message'));
            $smarty->assign('name_overbod', $bidsforauction['bname']);
            $smarty->assign('email_overbod', $bidsforauction['bemail']);
            $smarty->assign('price_overbod', $bidsforauction['bprice']);
            
            $smarty->assign('title_nieuwbod', $this->Lang('mail_nieuwbod_title'));
            $smarty->assign('message_nieuwbod', $this->Lang('mail_nieuwbod_message'));
            $smarty->assign('name_nieuwbod', $params['bname']);
            $smarty->assign('email_nieuwbod', $params['bemail']);
            $smarty->assign('price_new', $params['bprice']);

            $cmsmailer->AddEmbeddedImage( 'uploads/veilingnpo/images/npo-logo.png', 'logo1', $name = 'NPO', $encoding = 'base64', $type = 'application/octent-stream' );
            $cmsmailer->AddAddress($bidsforauction['bemail'],$bidsforauction['bname']);
            $cmsmailer->AddBCC( 'veiling-ict@npo.nl', 'CMS Mail Veilingsite' );
            $cmsmailer->SetBody($this->ProcessTemplate('mail_overbod.tpl'));
            $cmsmailer->IsHTML(true);
            $cmsmailer->SetSubject($this->Lang('subject_overbod'));
            $cmsmailer->Send();

            $cmsmailer->ClearAddresses();
            $cmsmailer->AddAddress($params['bemail'],$params['bname']);
            $cmsmailer->SetBody($this->ProcessTemplate('mail_nieuwbod.tpl'));
            $cmsmailer->IsHTML(true);
            $cmsmailer->SetSubject($this->Lang('subject_nieuwbod'));
            $cmsmailer->Send();

      } elseif ($bidsforauction['bprice'] >= $params['bprice']) {
            
         $smarty->assign('auction_link', $this->CreateLink($id, 'default', $returnid, $result['name'],array('auction_id' => $result['auction_id']), ''));

         $smarty->assign('title_nieuwbod', "Bod te laag");
         $smarty->assign('message_nieuwbod', "Het geplaatste bod is lager dan het hoogste bod");
         $smarty->assign('name_nieuwbod', $params['bname']);
         $smarty->assign('email_nieuwbod', $params['bemail']);
         $smarty->assign('price_new', $params['bprice']);
         $smarty->assign('price_overbod', $bidsforauction['bprice']);
         
         $cmsmailer->AddEmbeddedImage( 'uploads/veilingnpo/images/npo-logo.png', 'logo1', $name = 'NPO', $encoding = 'base64', $type = 'application/octent-stream' );
         $cmsmailer->AddAddress($params['bemail'],$params['bname']);
         $cmsmailer->AddBCC( 'veiling-ict@npo.nl', 'CMS Mail Veilingsite' );
         $cmsmailer->SetBody($this->ProcessTemplate('automail.tpl'));
         $cmsmailer->IsHTML(true);
         $cmsmailer->SetSubject('Veiling NPOICT - Bod te laag');
         $cmsmailer->Send();
         
      }

      $sid = $db->GenID(cms_db_prefix().'module_dev4auctions_bids_seq');
      $query = 'INSERT INTO '.cms_db_prefix().'module_dev4auctions_bids (bid_id, bname, bemail, bprice, auction_id) VALUES (?,?,?,?,?)';
      $result = $db->Execute($query,array($sid,$params['bname'],$params['bemail'], $params['bprice'], $params['auction_id']));
      $params['module_message'] = $this->Lang('added_record');


   } else {
      $params['module_message'] = 'Error';
   }

   if ($result === false)
   {
      echo "Database error!";
      exit;
   }

unset($params['bid_id']);
// set a message and return to the page.
$this->Redirect($id, 'default', $returnid, $params);
?>