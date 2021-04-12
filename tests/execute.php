<?php
require_once('load.php');

$familyTreeData = json_decode(file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . "familyTree.json"));

foreach (glob(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inputFiles" . DIRECTORY_SEPARATOR . "*.txt") as $filename){
    // Rebuild family tree for each sample
    $familyTree = new FamilyTree($familyTreeData);
    echo PHP_EOL . PHP_EOL . "Starting test with input file: " . basename($filename) . PHP_EOL . PHP_EOL;
    $actions = explode(PHP_EOL, file_get_contents($filename));
    foreach($actions as $action){
        $familyTree->processAction($action);
    }
    echo PHP_EOL . PHP_EOL . "Completed test with input file: " . basename($filename) . PHP_EOL . PHP_EOL;
}

