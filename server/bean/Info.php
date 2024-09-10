<?php

class Info
{

    public function __construct($id, $color)
    {
        $this->color = $color;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getColor()
    {
        return $this->color;
    }

    private $id;
    private $color;

}


?>