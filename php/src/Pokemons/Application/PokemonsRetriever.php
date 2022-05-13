<?php

declare(strict_types=1);

namespace App\Pokemons\Application;

interface PokemonsRetriever
{
    public function getPokemons(int $offset = 0, int $limit = 20): array;
}
