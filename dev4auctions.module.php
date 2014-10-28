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
}

?>