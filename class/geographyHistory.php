<?php

class GeographyHistory extends Subject{
    public $sub1;
    public $sub2;
    public $sub3;

    public function __construct($name,$table,$sub1,$sub2,$sub3){
        parent:: __construct($name,$table);
        $this->sub1 = $sub1;
        $this->sub2 = $sub2;
        $this->sub3 = $sub3;
    }

    function getSub1(){
        return $this->sub1;
    }
    function getSub2(){
        return $this->sub2;
    }
    function getSub3(){
        return $this->sub3;
    }
}