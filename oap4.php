<?php
require_once './oap4/DepositCalc.php';
$rl = null;
$calc = null;
echo "\e[H\e[J";
getHelp();

while ($rl !== '-q') {
    $rl = readline('> ');
    $response = explode(' ', $rl);
    switch ($response[0]) {
        case '-deposit';
            try {
                $calc = new DepositCalc($response[1],$response[2]);
                echo 'Deposit created!' . PHP_EOL;
            } catch (Exception $e)
            {
                echo "\033[1;33mYou need to input valid amount and number of months. \e[0m" . PHP_EOL;
            }
            break;
        case '-total';
            if ($calc !== null) {
                echo 'Total amount: ' . $calc->getTotal() . '.' . PHP_EOL;
            } else
            {
                echo "\033[1;33mYou need to create deposit first. \e[0m" . PHP_EOL;
            }
            break;
        case '-monthly';
            if ($calc !== null) {
                echo 'Monthly profit: ' . $calc->getMonthlyProfit() . '.' . PHP_EOL;
            } else
            {
                echo "\033[1;33mYou need to create deposit first. \e[0m" . PHP_EOL;
            }
            break;
        case '-profit';
            if ($calc !== null) {
                echo 'Total profit: ' . $calc->GetProfit() . '.' . PHP_EOL;
            } else
            {
                echo "\033[1;33mYou need to create deposit first. \e[0m" . PHP_EOL;
            }
            break;
        case '-h':
            getHelp();
            break;
        case '-q':
            break;
        default:
            echo "\e[1;33mUndefined command  '$response[0]'. See -h to get list of commands.\e[0m" . PHP_EOL;
    }
}
function getHelp() {
    echo 'List of commands: ' . PHP_EOL . PHP_EOL;
    echo "\t-deposit AMOUNT MONTHS -> Create deposit;" . PHP_EOL . PHP_EOL;
    echo "\t-total   -> Outputs total amount of money you will get;" . PHP_EOL;
    echo "\t-monthly -> Outputs average amount of money you will get monthly;" . PHP_EOL;
    echo "\t-profit  -> Outputs profit;" . PHP_EOL . PHP_EOL;
    echo "\t-h       -> Outputs this list;" . PHP_EOL;
    echo "\t-q       -> Quit program;" . PHP_EOL . PHP_EOL;

}

