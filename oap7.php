<?php

require_once './oap7/Array3D.php';
$rl = null;
$arr = null;
echo "\e[H\e[J";
getHelp();

while ($rl !== '-q') {
    $rl = readline('> ');
    $response = explode(' ', $rl);
    switch ($response[0]) {
        case '-arr';
            if (isset($response[1])) {
                try {
                    $arr = new Array3D($response[1]);
                    echo 'Array created!' . PHP_EOL;
                } catch (Exception $e) {
                    echo "\033[1;33mYou need to input valid number of clients. \e[0m" . PHP_EOL . $e->getMessage() . PHP_EOL;
                }
            } else {
                echo "\033[1;33mYou need to input valid number of clients. \e[0m" . PHP_EOL;
            }
            break;
        case '-sum':

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
function getHelp()
{
    echo 'List of commands: ' . PHP_EOL . PHP_EOL;
    echo "\t-arr SIZE -> create 2 3D arrays with a given size;" . PHP_EOL;
    echo "\t-sum      -> Outputs oldest client age;" . PHP_EOL;
    echo "\t-sub BOOL     -> Outputs youngest client age;" . PHP_EOL;
    echo "\t-diff      -> Outputs average client age;" . PHP_EOL;
    echo "\t-comp      -> Outputs average client age;" . PHP_EOL;
    echo "\t-h        -> Outputs this list;" . PHP_EOL;
    echo "\t-q        -> Quit program;" . PHP_EOL . PHP_EOL;
}

