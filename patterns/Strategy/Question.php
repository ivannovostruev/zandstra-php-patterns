<?php

namespace patterns\Strategy;

abstract class Question
{
    protected $prompt;

    protected Marker $marker;

    public function __construct($prompt, Marker $marker)
    {
        $this->prompt = $prompt;
        $this->marker = $marker;
    }

    public function mark($response)
    {
        return $this->marker->mark($response);
    }
}
