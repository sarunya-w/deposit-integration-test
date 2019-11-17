<?php namespace Operation;

require_once(__DIR__.'../../outputs/Outputs.php');

require_once 'serviceAuthenticationStub.php';
require_once 'dbConnectorStub.php';

use Output\Outputs;
use Exception;
use AccountInformationException;
use serviceAuthenticationStub;
use dbConnectorStub;

class DepositServiceStub {

    private $accNo;

    public function __construct(string $accNo){
        $this->accNo = $accNo;
    }
    
    public function deposit($amount): Outputs {
        $result = new Outputs(); // my output
        $result->errorMessage = '';

        // validate 1. Amount must be numeric
        if(!preg_match('/^[0-9]*$/', $amount)){ //!preg_match('/^[0-9]*$/',$this->acctNum)
            $result->errorMessage = "Amount must be numeric!";
            
        } else if (strlen($this->accNo) != 10){ // validate 2. Account No. must have have 10 digit
            $result->errorMessage = "Amount must be numeric!";
            
        } else if (!preg_match('/^[0-9]*$/', $this->accNo)){ // validate 3. Account no. must be numeric
            $result->errorMessage = "Amount must be numeric!";

        } else { // validate 4. Account no. must have existing            
            try{
                // Service Authentication
                $accountInfo = ServiceAuthenticationStub::accountAuthenticationProvider($this->accNo);
                
                // Deposit
                $accNo = $accountInfo["accNo"];
                $currentBal = $accountInfo["accBalance"] + $amount;
                dbConnectorStub::saveTransaction($accNo, $currentBal);

                // Assign output
                $result->accountNumber = $accNo;
                $result->accountName = $accountInfo["accName"];
                $result->accountBalance = $currentBal;
                $billAmount = $accountInfo["accWaterCharge"] +  $accountInfo["accElectricCharge"] +  $accountInfo["accPhoneCharge"];
                $result->billAmount = $billAmount;
                $result->isError = false;
            }
            catch(AccountInformationException $e){
                $result->errorMessage = $e->getMessage();
            }
        }
        return $result;
    }
 }