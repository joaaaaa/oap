<?php
require_once './oap5/ATM.php';
$rl = null;
$atm = null;
echo "\e[H\e[J";
getHelp();

while ($rl !== '-q') {
    $rl = readline('> ');
    $response = explode(' ', $rl);
    switch ($response[0]) {
        case '-toStr':
            try {
                $atm = new ATM($response[1]);
                echo $atm->getString() . PHP_EOL;
            } catch (Exception $e)
            {
                echo "\033[1;33mYou need to input valid amount of money. \e[0m" . PHP_EOL;
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
    echo "\t-toStr AMOUNT -> Create deposit;" . PHP_EOL . PHP_EOL;
    echo "\t-h       -> Outputs this list;" . PHP_EOL;
    echo "\t-q       -> Quit program;" . PHP_EOL . PHP_EOL;

}

