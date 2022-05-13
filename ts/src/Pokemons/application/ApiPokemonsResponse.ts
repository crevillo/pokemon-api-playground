import {ApiPokemonResponse} from "./ApiPokemonResponse";

export class ApiPokemonsResponse {
    pokemons: Array<ApiPokemonResponse>

    constructor({pokemons}: {pokemons: Array<ApiPokemonResponse>}) {
        this.pokemons = pokemons;
    }
}
