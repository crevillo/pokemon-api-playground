<?php

namespace App\Pokemons\Application;

interface PokemonRetriever
{
    public function getPokemon(int $pokemonId): array;
}
