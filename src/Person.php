<?php

class Person
{
    /**
     * Name of the person
     * @var string
     */
    private $name;

    /**
     * Gender
     * @var string
     */
    private $gender;

    /**
     * Spouse of the person
     * @var Person
     */
    private $spouse;

    /**
     * Mother of the person
     * @var Person
     */
    private $mother;

    /**
     * Children of the person
     * @var array
     */
    private $children;

    /**
     * Constructor method
     */
    public function __construct($name, $gender)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->spouse = null;
        $this->children = [];
    }

        /**
     * Getter function for name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter function for gender
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Getter function for spouse
     * @return Person
     */
    public function getSpouse()
    {
        return $this->spouse;
    }

    /**
     * Getter function for mother
     * @return Person
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * Getter function for children
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * To mark another person as spuse and vice-versa
     * @param Person $person
     * @return void
     */
    public function marry(Person $person)
    {
        $this->spouse = $person;
        $person->spouse = $this;
    }

    /**
     * To add another person as a kid
     * @param Person $person
     * @return void
     */
    public function giveBirthTo(Person $person)
    {
        if($this->gender == 'Female'){
            $this->children[] = $person;
            $person->mother = $this;
            
            return true;
        }

        return false;
    }

    /**
     * To get related persons
     * @param $relationship
     * @return array
     */
    public function getRelationship($relationship)
    {
        switch($relationship){
            case 'Paternal-Uncle':
                return $this->getPaternalUncle();
                break;
            case 'Maternal-Uncle':
                return $this->getMaternalUncle();
                break;
            case 'Paternal-Aunt':
                return $this->getPaternalAunt();
                break;
            case 'Maternal-Aunt':
                return $this->getMaternalAunt();
                break;
            case 'Sister-In-Law':
                return $this->getSisterInLaw();
                break;
            case 'Brother-In-Law':
                return $this->getBrotherInLaw();
                break;
            case 'Son':
                return $this->getSon();
                break;
            case 'Daughter':
                return $this->getDaughter();
                break;
            case 'Siblings':
                return $this->getSiblings();
                break;
            default:
        }
    }

    /**
     * To get paternal uncle
     * @return array
     */
    private function getPaternalUncle()
    {
        $relations = [];
        if(isset($this->mother->spouse->mother->children)){
            foreach ($this->mother->spouse->mother->children as $person){
                if($person->gender == 'Male' && $person->name != $this->mother->spouse->name)
                    $relations[] = $person->name;
            }
        }

        return $relations;
    }

    /**
     * To get maternal uncle
     * @return array
     */
    private function getMaternalUncle()
    {
        $relations = [];
        if(isset($this->mother->mother->children)){
            foreach ($this->mother->mother->children as $person){
                if($person->gender == 'Male')
                    $relations[] = $person->name;
            }
        }

        return $relations;
    }

    /**
     * To get paternal aunt
     * @return array
     */
    private function getPaternalAunt()
    {
        $relations = [];
        if(isset($this->mother->spouse->mother->children)){
            foreach ($this->mother->spouse->mother->children as $person){
                if($person->gender == 'Female')
                    $relations[] = $person->name;
            }
        }

        return $relations;
    }

    /**
     * To get maternal aunt
     * @return array
     */
    private function getMaternalAunt()
    {
        $relations = [];
        if(isset($this->mother->mother->children)){
            foreach ($this->mother->mother->children as $person){
                if($person->gender == 'Female'  && $person->name != $this->mother->name)
                    $relations[] = $person->name;
            }
        }

        return $relations;
    }

    /**
     * To get sister in law
     * @return array
     */
    private function getSisterInLaw()
    {
        $relations = [];
        // Sisters of spouse
        if(isset($this->spouse->mother->children)){
            foreach ($this->spouse->mother->children as $person){
                if($person->gender == 'Female'  && $person->name != $this->spouse->name)
                    $relations[] = $person->name;
            }
        }
        // Wifes of siblings
        foreach($this->getSiblings(false) as $sibling){
            if($sibling->gender == 'Male')
                $relations[] = $sibling->spouse->name;
        }

        return $relations;
    }

    /**
     * To get brother in law
     * @return array
     */
    private function getBrotherInLaw()
    {
        $relations = [];
        // Brothers of spouse
        if(isset($this->spouse->mother->children)){
            foreach ($this->spouse->mother->children as $person){
                if($person->gender == 'Male' && $this->spouse->name != $person->name)
                    $relations[] = $person->name;
            }
        }
        // Husbands of siblings
        foreach($this->getSiblings(false) as $sibling){
            if($sibling->gender == 'Female')
                $relations[] = $sibling->spouse->name;
        }

        return $relations;
    }

    /**
     * To get son
     * @return array
     */
    private function getSon()
    {
        $relations = [];
        if($this->gender == 'Male' && isset($this->spouse->children))
            $children = $this->spouse->children;
        else if($this->gender == 'Female' && isset($this->children))
            $children = $this->children;
        if(isset($children)){
            foreach($children as $person){
                if($person->gender == 'Male')
                    $relations[] = $person->name;
            }
        }

        return $relations;
    }

    /**
     * To get daughter
     * @return array
     */
    private function getDaughter()
    {
        $relations = [];
        if($this->gender == 'Male' && isset($this->spouse->children))
            $children = $this->spouse->children;
        else if($this->gender == 'Female' && isset($this->children))
            $children = $this->children;
        if(isset($children)){
            foreach($children as $person){
                if($person->gender == 'Female')
                    $relations[] = $person->name;
            }
        }

        return $relations;
    }

    /**
     * To get siblings 
     * @param $returnNameArray
     * @return array
     */
    private function getSiblings($returnNameArray = true)
    {
        $relations = [];
        if(isset($this->mother->children)){
            foreach ($this->mother->mother->children as $person){
                if($person->name != $this->name)
                    $relations[] = $returnNameArray ? $person->name : $person;
            }
        }

        return $relations;
    }
}