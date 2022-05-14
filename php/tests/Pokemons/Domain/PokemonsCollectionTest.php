<?php

declare(strict_types=1);

namespace App\Tests\Pokemons\Domain;

use App\Pokemons\Application\ApiPokemonResponse;
use App\Pokemons\Domain\Pokemon;
use App\Pokemons\Domain\PokemonsCollection;
use PHPUnit\Framework\TestCase;

class PokemonsCollectionTest extends TestCase
{
    public function testWillThrowIfTheNumberOfPokemosIsNotGreaterThanZero(): void
    {
        $pokemons = new PokemonsCollection([]);

        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage("To calculate averages, number of pokemons must be greater than 0");

        $pokemons->averages();
    }

    /**
     * @return array<int, array<int, array<int, array<string, int>>|float|int>>
     */
    public function pokemonsDataProvider(): array
    {
        $pokemon1 = ['id' => 1, 'weight' => 10, 'height' => 10];
        $pokemon2 = ['id' => 2, 'weight' => 10, 'height' => 10];
        $pokemon3 = ['id' => 3, 'weight' => 5, 'height' => 15];
        $pokemon4 = ['id' => 4, 'weight' => 3, 'height' => 2];

        return [
            [[$pokemon1, $pokemon2], 10, 10],
            [[$pokemon1, $pokemon3], 7.5, 12.5],
            [[$pokemon1, $pokemon3, $pokemon4], 6, 9]
        ];
    }

    /**
     * @dataProvider pokemonsDataProvider
     *
     * @param array<int,int> $pokemons
     */
    public function testWillCalculateWeightAndHeightAverages(array $pokemons, float $expectedWeight, float $expectedHeight): void
    {
        $pokemonsCollection = new PokemonsCollection($pokemons);
        $this->assertEquals($pokemonsCollection->averages()->weight(), $expectedWeight);
        $this->assertEquals($pokemonsCollection->averages()->height(), $expectedHeight);
    }
}
