<?php

require_once "DepositService.php";
use Operation\DepositService;

class MainDriver {
    private $accNo;
    private $amount;
    private $isTestAuthStub;
    private $isTestTxStub;

    function MainDriver() {
        $this->accNo = "0000000001";
        $this->amount = 300;
        $this->isTestAuthStub = false;
        $this->isTestTxStub = false;
    }

    public function test() {
        echo "--------------------<br/>";
        echo "::: Input :::<br/>";
        echo "Bank Account No. :".preg_replace('/(\d{1})\-?(\d{3})\-?(\d{3})\-?(\d{3})/', '$1-$2-$3-$4', $this->accNo)."<br/>";
        echo "Amount : ".$this->amount."<br/><br/>";
        echo "----On Processing---<br/>";

        // create an object
        $deposit = new DepositService($this->accNo, $this->isTestAuthStub, $this->isTestTxStub);

        // show object properties        
        $result = json_encode($deposit->deposit($this->amount));
        echo $result;
        echo "<br/>";

        $result = json_decode($result, true);
        if($result['errorMessage']) {
            echo "----Failed---";
        } else { // no error           
            echo "----Success---";
        }
        echo "<br/>";
    }        
}
echo "Deposit Service Start<br/>";

$result = new MainDriver();
$result->test();

echo "Finish<br/>";

?>
