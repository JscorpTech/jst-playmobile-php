<?php

namespace Jscorptech;



class Timing
{
    public $start_at;
    public $end_at;
    public $evenly;

    public function __construct($start_at, $end_at, $evenly = false)
    {
        $this->start_at = $start_at;
        $this->end_at = $end_at;
        $this->evenly = $evenly;
    }
}