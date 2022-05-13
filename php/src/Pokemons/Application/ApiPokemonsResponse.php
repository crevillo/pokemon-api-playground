<?php

declare(strict_types=1);

namespace App\Pokemons\Application;

final class ApiPokemonsResponse
{
    private array $pokemons;

    public function __construct(array $pokemons)
    {
        $this->pokemons = $pokemons;
    }

    public function pokemons(): array
    {
        return $this->pokemons;
    }
}
