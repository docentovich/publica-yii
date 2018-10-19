<?php

namespace app\abstractions;


trait UpperCaseToUnderscoreGetter
{
    public function __get($name)
    {
        $underscore_name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));

        if(!isset($this->{$underscore_name})) {
            return parent::__get($name);
        }else{
            return parent::__get($underscore_name);
        }
    }
}