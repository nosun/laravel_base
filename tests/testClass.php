<?php

class A {

    protected $a;
    public function __construction(){
        echo __CLASS__;
    }

    public function test(){
        $b = new self;
        var_dump($this->a);die;
        return $b->a;
    }

    public function setA($a){
        $this->a = $a;
    }
}

class B extends A {

    public function test1(){

    }

}


$a = new B();
$a->setA(1);
$b = $a->test();
var_dump($b);

