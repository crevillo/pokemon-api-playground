<?php

namespace App\Pokemons\Infrastructure\Client;

use App\Pokemons\Application\PokemonRetriever;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PokemonFromCacheRetriever implements PokemonRetriever
{
    private const CACHE_TTL = 1800; // 30 min @todo make this configurable

    private CacheInterface $cache;

    private PokemonRetriever $pokemonInnerRetriever;

    public function __construct(CacheInterface $cache, PokemonRetriever $pokemonRetriever)
    {
        $this->cache = $cache;
        $this->pokemonInnerRetriever = $pokemonRetriever;
    }

    public function getPokemon(int $pokemonId): array
    {
        return $this->cache->get(sprintf('pokemon-%d', $pokemonId), function (ItemInterface $item) use ($pokemonId) {
            $item->expiresAfter(self::CACHE_TTL);
            return $this->pokemonInnerRetriever->getPokemon($pokemonId);
        });
    }
}
