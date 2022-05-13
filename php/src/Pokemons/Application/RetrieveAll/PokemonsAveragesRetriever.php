<?php

namespace App\Pokemons\Application\RetrieveAll;

use App\Pokemons\Application\PokemonsAverageResponse;
use App\Pokemons\Application\PokemonsRetriever;
use App\Pokemons\Domain\PokemonsCollection;

class PokemonsAveragesRetriever
{
    private PokemonsRetriever $pokemonsRetriever;

    public function __construct(PokemonsRetriever $pokemonsApiClient)
    {
        $this->pokemonsRetriever = $pokemonsApiClient;
    }

    public function getAverages(int $offset, int $limit = 0): PokemonsAverageResponse
    {
        $pokemons = $this->pokemonsRetriever->getPokemons($offset, $limit);
        $pokemonsCollection = PokemonsCollection::fromPrimitives($pokemons);

        return PokemonsAverageResponse::fromPrimitives($pokemonsCollection->averages()->weight(), $pokemonsCollection->averages()->height());
    }
}
