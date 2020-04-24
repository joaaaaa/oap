<?php
require_once './oap6/Gym.php';
$rl = null;
$gym = new Gym();
echo "\e[H\e[J";
getHelp();

while ($rl !== '-q') {
    $rl = readline('> ');
    $response = explode(' ', $rl);
    switch ($response[0]) {
        case '-add';
            if (isset($response[1]) && ctype_digit($response[1])) {
                for ($i = 0; $i < (int)$response[1]; $i++) {
                    $rl = readline('CLIENT ' . ($i + 1) . '> ');
                    if ($gym->addClient($rl)) {
                        echo 'Client ' . ($i + 1) . ' added!' ;
                    } else {
                        echo 'Can\'t add client. Try again.';
                        --$i;
                    }
                    echo PHP_EOL;
                }
            } else {
                echo "\033[1;33mYou need to input valid number of clients. \e[0m" . PHP_EOL;
            }
            break;
        case '-min':
            $old = $gym->getYoungest();
            if ($old !== false) {
                echo 'Youngest client is ' . $old . ' years old.' . PHP_EOL;
            } else {
                echo "\033[1;33mThere is no clients. See -add COUNT to add clients.\e[0m" . PHP_EOL;
            }
            break;
        case '-max':
            $old = $gym->getOldest();
            if ($old !== false) {
                echo 'Oldest client is ' . $old . ' years old.' . PHP_EOL;
            } else {
                echo "\033[1;33mThere is no clients. See -add COUNT to add clients.\e[0m" . PHP_EOL;
            }
            break;
        case '-avg':
            $old = $gym->getAverage();
            if ($old !== false) {
                echo 'Average client age is ' . $old . '.' . PHP_EOL;
            } else {
                echo "\033[1;33mThere is no clients. See -add COUNT to add clients.\e[0m" . PHP_EOL;
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
    echo "\t-add COUNT -> Add some amount of client. You need to enter their age one by one after that;" . PHP_EOL;
    echo "\t-max       -> Outputs oldest client age;" . PHP_EOL;
    echo "\t-min       -> Outputs youngest client age;" . PHP_EOL;
    echo "\t-avg       -> Outputs average client age;" . PHP_EOL;
    echo "\t-h         -> Outputs this list;" . PHP_EOL;
    echo "\t-q         -> Quit program;" . PHP_EOL . PHP_EOL;
}

