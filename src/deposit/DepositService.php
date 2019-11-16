<?php namespace Operation;

require_once(__DIR__.'../../outputs/Outputs.php');
require_once(__DIR__.'../../serviceauthentication/serviceauthentication.php');
require_once(__DIR__.'../../serviceauthentication/DBConnection.php');

use Output\Outputs;
use Exception;
use AccountInformationException;
use serviceauthentication;
use DBConnection;

class DepositService{

    private $accNo;

    public function __construct(string $accNo){
        $this->accNo = $accNo;
    }
    
    public function deposit($amount): array {
    // public function deposit($amount): Outputs {
        // $result = new Outputs(); // my output
        // $result["isError"] = true;
        $result = array("isError" => true);

        // validate 1. Amount must be numeric
        if(!preg_match('/^[0-9]*$/', $amount)){ //!preg_match('/^[0-9]*$/',$this->acctNum)
            // $output["errorMessage"] = "Amount must be numeric!";
            $result["errorMessage"] = "Amount must be numeric!";
        } else if (strlen($this->accNo) != 10){ // validate 2. Account No. must have have 10 digit
            // $output["errorMessage"] = "Account no. must have 10 digit!";
            $result["errorMessage"] = "Account no. must have 10 digit!";
        } else if (!preg_match('/^[0-9]*$/', $this->accNo)){ // validate 3. Account no. must be numeric
            // $output["errorMessage"] = "Account no. must be numeric!";
            $result["errorMessage"] = "Account no. must be numeric!";
        } else { // validate 4. Account no. must have existing            
            try{
                // Service Authentication
                $accountInfo = ServiceAuthentication::accountAuthenticationProvider($this->accNo);
                
                // Deposit
                $accNo = $accountInfo["accNo"];
                $currentBal = $accountInfo["accBalance"] + $amount;
                DBConnection::saveTransaction($accNo, $currentBal);
                
                // Assign output
                $result["accountNumber"] = $accNo;
                $result["accountName"] = $accountInfo["accName"];
                $result["accountBalance"] = $currentBal;
                $billAmount = $accountInfo["accWaterCharge"] +  $accountInfo["accElectricCharge"] +  $accountInfo["accPhoneCharge"];
                $result["billAmount"] = $billAmount;
                $result["isError"] = false;
            }
            catch(AccountInformationException $e){
                $result["errorMessage"] = $e->getMessage();
            }
        }
        return $result;
    }
 }