<?php
declare(strict_types = 1);

namespace Ppo\Model\Entity;

abstract class AbstractEntity
{
    protected $data;

    abstract protected function createData(): void;

    public function getData(): ?array
    {
        createData();
        return $data;
    }
}
 