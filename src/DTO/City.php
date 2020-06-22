<?php

namespace DTO\City;

class City
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $id;
    /**
     * @var array
     */
    private $propX;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return City
     */
    public function setName(string $name): City
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return City
     */
    public function setId(int $id): City
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getPropX(): array
    {
        return $this->propX;
    }

    /**
     * @param array $propX
     * @return City
     */
    public function setPropX(array $propX): City
    {
        $this->propX = $propX;
        return $this;
    }



}
