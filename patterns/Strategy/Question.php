<?php

namespace patterns\Strategy;

abstract class Question
{
    public function __construct(
        protected string $prompt,
        protected Marker $marker
    ){}

    public function mark($response): mixed
    {
        return $this->marker->mark($response);
    }
}
