<?php

namespace App\Pokemons\Infrastructure\Client;

use App\Pokemons\Application\PokemonRetriever;
use App\Pokemons\Application\PokemonsRetriever;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokemonsFromApiRetriever implements PokemonsRetriever
{
    private HttpClientInterface $httpClient;

    private PokemonRetriever $pokemonRetriever;

    public function __construct(HttpClientInterface $httpClient, PokemonRetriever $pokemonRetriever)
    {
        $this->httpClient = $httpClient;
        $this->pokemonRetriever = $pokemonRetriever;
    }

    /*
     * @return array<array<any>>
     */
    public function getPokemons(int $offset = 0, int $limit = 20): array
    {
        $result = $this->httpClient->request('GET', 'https://pokeapi.co/api/v2/pokemon', [
            'query' => [
                'offset' => $offset,
                'limit' => $limit
            ]
        ]);

        $items = json_decode($result->getContent())->results;

        $pokemons = array_map(function ($item) {
            $urlParts = explode('/', $item->url);
            $pokemonId = $urlParts[6];

            return $this->pokemonRetriever->getPokemon((int)$pokemonId);
        }, $items);

        return $pokemons;
    }
}
