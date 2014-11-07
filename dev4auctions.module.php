<?php

class Dev4auctions extends CMSModule {

    function GetName() {
        return 'Dev4Auctions';
    }

    function GetFriendlyName() {
        return $this->Lang('friendlyname');
    }

    function GetVersion() {
        return '1.0';
    }

    function GetHelp() {
        return $this->Lang('help');
    }

    function GetAuthor() {
        return 'Dev4online';
    }

    function GetAuthorEmail() {
        return 'steven@designtotal.nl';
    }

    function GetChangeLog() {
        return $this->Lang('changelog');
    }

    function IsPluginModule() {
        return true;
    }

    function HasAdmin() {
        return true;
    }

    function GetAdminSection() {
        return 'content';
    }

    function GetAdminDescription() {
        return $this->Lang('admindescription');
    }

    function VisibleToAdminUser() {
        return $this->CheckPermission('Use Dev4Auctions');
    }

    function GetDependencies() {
        return array();
    }

    function SetParameters() {
        $this->RegisterModulePlugin();
        
        $this->RestrictUnknownParams();

       $this->CreateParameter('auction_id', -1, $this->Lang('help_auction_id'));
       $this->SetParameterType('auction_id',CLEAN_INT);

       $this->CreateParameter('maxauctions', 0, $this->Lang('help_maxauctions'));
       $this->SetParameterType('maxauctions', CLEAN_INT);

       $this->CreateParameter('active', '', $this->Lang('help_active'));
       $this->SetParameterType('active', CLEAN_STRING);

    }
}


?>