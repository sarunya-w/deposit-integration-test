<?php
require_once 'DBConnection.php';
// require_once './DBConnection.php';

class ServiceAuthenticationStub {
    
    public static function accountAuthenticationProvider(string $accNo): array {
        // return dbConnectorStub::getAccountInfo($accNo);
        return DBConnection::accountInformationProvider($accNo);
    }    
}

?>