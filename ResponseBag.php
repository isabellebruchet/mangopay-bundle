<?php

namespace Betacie\Bundle\MangoPayBundle;

class ResponseBag
{

    protected $parameters;

    public function __construct(array $parameters = array())
    {
        $this->parameters = $parameters;
    }

    public function get($name, $default = null)
    {
        return array_key_exists($name, $this->parameters) ? $this->parameters[$name] : $default;
    }
    
    public function count() {
        return count($this->parameters);
    }

}
