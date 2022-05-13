<?php

declare(strict_types=1);

namespace App\Pokemons\Application;

final class ApiPokemonResponse
{
    private int $id;

    private int $weight;

    private int $height;

    public function __construct(int $id, int $weight, int $height)
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
}
