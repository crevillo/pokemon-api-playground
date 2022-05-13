<?php

declare(strict_types=1);

namespace App\Pokemons\Domain;

class PokemonsAverages
{
    private float $weight;

    private float $height;

    public function __construct(float $weight, float $height)
    {
        $this->weight = $weight;
        $this->height = $height;
    }

    public function weight(): float
    {
        return $this->weight;
    }

    public function height(): float
    {
        return $this->height;
    }

    public static function fromPrimitives(float $weight, float $height)
    {
        return new self($weight, $height);
    }
}
