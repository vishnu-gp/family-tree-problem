<?php

class FamilyTree
{
    /**
     * Root node of the tree
     * @var Person
     */
    private $root;

    /**
     * Constructor method
     * @param $familyTree
     */
    public function __construct($familyTree)
    {
        $this->root = $this->buildFamily($familyTree);
    }

    /**
     * To build family from the given tree data
     * @param $familyTree
     * @return Person
     */
    public function buildFamily($familyTree)
    {
        $person = new Person($familyTree->name, $familyTree->gender);
        if(isset($familyTree->spouse) && !is_null($familyTree->spouse)){
            $person->marry($this->buildFamily($familyTree->spouse));
        }
        if($familyTree->gender == 'Female' && isset($familyTree->children) && count($familyTree->children)){
            foreach($familyTree->children as $child){
                $person->giveBirthTo($this->buildFamily($child));
            }
        }
        
        return $person;
    }

    /**
     * To process a particalar action
     * @param $action
     * @return void
     */
    public function processAction($action)
    {
        $action = explode(' ', $action);
        switch($action[0]){
            case 'ADD_CHILD':
                echo $this->addChild($action[1], $action[2], $action[3]) . PHP_EOL;
                break;
            case 'GET_RELATIONSHIP':
                echo $this->getRelationship($action[1], $action[2]) . PHP_EOL;
                break;
            default:
        }
    }

    /**
     * To add a child
     * @param $motherName
     * @param $childName
     * @param $childGender
     * @return string
     */
    private function addChild($motherName, $childName, $childGender)
    {
        $mother = $this->searchFamilyPerson($motherName, $this->root);
        if($mother){
            $child = new Person($childName, $childGender);
            if($mother->giveBirthTo($child))
                $response = 'CHILD_ADDITION_SUCCEEDED';
            else
                $response = 'CHILD_ADDITION_FAILED';
        }
        else
            $response = 'PERSON_NOT_FOUND';

        return $response;
    }

    /**
     * To get a related person(s)
     * @param $personName
     * @param $relationship
     * @return string
     */
    private function getRelationship($personName, $relationship)
    {
        $person = $this->searchFamilyPerson($personName, $this->root, false);
        if($person){
            $relations = $person->getRelationship($relationship);
            if(count($relations))
                $response = implode(' ', $relations);
            else
                $response = 'NONE';
        }
        else
            $response = 'PERSON_NOT_FOUND';

        return $response;
    }

    /**
     * To search and find a person in the family
     * @param $personName
     * @param Person $treeParent
     * @param $femaleOnly | flag
     * @return mixed
     */
    private function searchFamilyPerson($personName, $treeParent, $femaleOnly = true)
    {
        if($treeParent->getGender() == 'Female'){
            if($treeParent->getName() == $personName)
                return $treeParent;
            else if(count($treeParent->getChildren())){
                foreach($treeParent->getChildren() as $child){
                    $result = $this->searchFamilyPerson($personName, $child, $femaleOnly);
                    if($result)
                        return $result;
                }
            }
        }
        else if($treeParent->getGender() == 'Male'){
            if(!$femaleOnly && $treeParent->getName() == $personName)
                return $treeParent;
            else if(!is_null($treeParent->getSpouse()))
                return $this->searchFamilyPerson($personName, $treeParent->getSpouse(), $femaleOnly);
        }
        return false;
    }
}