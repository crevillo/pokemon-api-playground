<?php

declare(strict_types=1);

namespace App;

use App\Pokemons\Application\PokemonRetriever;
use App\Pokemons\Infrastructure\Client\PokemonFromApiRetriever;
use App\Pokemons\Infrastructure\Client\PokemonFromCacheRetriever;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\PruneableInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services();
    $services
        ->defaults()
        ->autoconfigure()
        ->autowire()
    ;

    $services->instanceof(Command::class)->tag('console.command');

    $services->load(__NAMESPACE__.'\\', '../src/*');

    $services->get(Application::class)
        ->args([tagged_iterator('console.command')])
        ->public();

    $services->set('app.api.client.symfony', NativeHttpClient::class);

    $services->alias(HttpClientInterface::class, 'app.api.client.symfony');
    $services->alias(PokemonRetriever::class, PokemonFromApiRetriever::class);

    $services->set('app.cache', FilesystemAdapter::class)
        ->arg('$directory', __DIR__ . '/../var/cache');
    $services->alias(CacheInterface::class, 'app.cache');

    $services->get(PokemonFromCacheRetriever::class)
        ->decorate(PokemonFromApiRetriever::class);
};
