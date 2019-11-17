<?php

require_once "DepositServiceStub.php";

use Operation\DepositServiceStub;

class Main {
    private $accNo;
    private $amount;

    function Main() {
        $this->accNo = "9999999999";
        $this->amount = 30;
    }

    public function test() {
        // create an object
        $deposit = new DepositServiceStub($this->accNo);

        // show object properties
        echo json_encode($deposit->deposit($this->amount));
        echo "<br/>";
    }        
}
echo "Start<br/>";
$result = new Main();
$result->test();
echo "Finish<br/>";
?>
