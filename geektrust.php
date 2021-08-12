<?php
require_once('load.php');

// Build family tree
$familyTreeData = json_decode(file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . "familyTree.json"));
$familyTree = new FamilyTree($familyTreeData);

// Read input file and process commands
$actions = explode(PHP_EOL, file_get_contents($argv[1]));
foreach($actions as $action){
    $familyTree->processAction($action);
}