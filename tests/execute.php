<?php
require_once('load.php');

$familyTree = json_decode(file_get_contents('familyTree.json'));

$familyTree = new FamilyTree($familyTree);

foreach (glob(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inputFiles" . DIRECTORY_SEPARATOR . "*.txt") as $filename){
    echo PHP_EOL . PHP_EOL . "Starting test with input file: " . basename($filename) . PHP_EOL . PHP_EOL;
    $actions = explode(PHP_EOL, file_get_contents($filename));
    foreach($actions as $action){
        $familyTree->processAction($action);
    }
    echo PHP_EOL . PHP_EOL . "Completed test with input file: " . basename($filename) . PHP_EOL . PHP_EOL;
}

