import {Pokemon} from "./Pokemon";
import {PokemonsAverages} from "./PokemonsAverages";

export class PokemonsCollection {
    readonly pokemons: Array<{id: number, weight: number, height: number}>

    constructor(pokemons: Array<{id: number, weight: number, height: number}>) {
        this.pokemons = pokemons;
    }

    averages(): PokemonsAverages {
        let nElements = this.pokemons.length,
            totals = {
            'weight': 0,
            'height': 0
        }

        this.pokemons.map(function(pokemon: {id: number, weight: number, height: number}) {
            totals.weight += pokemon.weight
            totals.height += pokemon.height;
        })

        return new PokemonsAverages({'weight': totals.weight / nElements, 'height': totals.height / nElements});
    }
}
