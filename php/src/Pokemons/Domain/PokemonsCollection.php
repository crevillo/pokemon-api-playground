<?php

declare(strict_types=1);

namespace App\Pokemons\Domain;

class PokemonsCollection extends \ArrayObject
{
    public function offsetSet(mixed $key, mixed $value): void
    {
        if (!($value instanceof Pokemon)) {
            throw new \InvalidArgumentException("Must be a Pokemon");
        }

        parent::offsetSet($key, $value);
    }

    public function averages(): PokemonsAverages
    {
        $nElements = $this->getIterator()->count();
        if ($nElements <= 0) {
            throw new \InvalidArgumentException(
                sprintf("To calculate averages, number of pokemons must be greater than 0")
            );
        }

        $totals = [
            'weight' => 0,
            'height' => 0
        ];

        array_map(static function ($item) use (&$totals) {
            /** @var Pokemon $item */
            $totals['weight'] += $item['weight'];
            $totals['height'] += $item['height'];
        }, $this->getArrayCopy());

        return new PokemonsAverages(
            $totals['weight'] / $nElements,
            $totals['height'] / $nElements
        );
    }

    public static function fromPrimitives(array $pokemons): self
    {
        return new self($pokemons);
    }
}
