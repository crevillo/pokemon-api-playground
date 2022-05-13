<?php

namespace App\Pokemons\Application;

class PokemonsAverageResponse
{
    private float $weight;

    private float $height;

    private function __construct(float $weight, float $height)
    {
        $this->weight = $weight;
        $this->height = $height;
    }

    public static function fromPrimitives(float $weight, float $height)
    {
        return new self($weight, $height);
    }

    public function weight(): float
    {
        return $this->weight;
    }

    public function height(): float
    {
        return $this->height;
    }
}
