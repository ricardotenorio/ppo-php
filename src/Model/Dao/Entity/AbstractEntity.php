<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

abstract class AbstractEntity
{
    protected $data;

    abstract protected function createData(): void;

    public function getData(): ?array
    {
        $this->createData();
        return $this->data;
    }

    protected function addToArray(object $obj, array &$array): bool
    {
        if(in_array($obj, $array)){
            return false;
        }
        
        $array[] = $obj;

        return true;
    }

    protected function removeFromArray(object $obj, array &$array): bool
    {
        $key = array_search($obj, $array);

        if($key === false){
            return false;
        }

        unset($array[$key]);

        return true;
    }
}
 