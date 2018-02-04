<?php
/**
 * @author Sergey Naryshkin
 * @date 27.01.2018
 */
require_once 'vendor/autoload.php';

date_default_timezone_set("Europe/Moscow");
$usage = "Usage: {$argv[0]} dbname dbuser password\n";
if(count($argv) !== 4) {
    die($usage);

}

echo "SQL {$argv[1]} {$argv[2]} {$argv[3]} \n";

//echo "Enter "
//$db =readline();