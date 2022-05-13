<?php

namespace App\Pokemons\Infrastructure\Client;

use App\Pokemons\Application\PokemonRetriever;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokemonFromApiRetriever implements PokemonRetriever
{
    private const BASE_URI = 'https://pokeapi.co/api/v2/pokemon';

    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getPokemon(int $pokemonId): array
    {
        $result = $this->httpClient->request('GET', sprintf("%s/%d", self::BASE_URI, $pokemonId));
        $data = json_decode($result->getContent());

        return ['id' => $data->id, 'weight' => $data->weight, 'height' => $data->height];
    }
}
