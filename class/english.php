<?php

class English extends Subject{
    public $sub1;
    public $sub2;

    public function __construct($name,$table,$sub1,$sub2){
        parent:: __construct($name,$table);
        $this->sub1 = $sub1;
        $this->sub2 = $sub2;
    }

    function getSub1(){
        return $this->sub1;
    }
    function getSub2(){
        return $this->sub2;
    }
}