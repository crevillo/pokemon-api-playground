<?php

declare(strict_types=1);

namespace App\Pokemons\Domain;

class Pokemon
{
    private int $id;

    private int $weight;

    private int $height;

    private function __construct(int $id, int $weight, int $height)
    {
        $this->id = $id;
        $this->weight = $weight;
        $this->height = $height;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function weight(): int
    {
        return $this->weight;
    }

    public function height(): int
    {
        return $this->height;
    }

    public static function fromPrimitives(int $id, int $weight, int $height)
    {
        return new self($id, $weight, $height);
    }
}
