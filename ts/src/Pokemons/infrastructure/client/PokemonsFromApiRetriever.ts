import {PokemonsRetriever} from "../../application/PokemonsRetriever";
import {Service} from "typedi";
import {PokemonFromApiRetriever} from "./PokemonFromApiRetriever";
const axios = require('axios').default;

@Service()
export class PokemonsFromApiRetriever implements PokemonsRetriever {

    constructor(private readonly pokemonRetriever: PokemonFromApiRetriever) {}

    async getPokemons(offset: number, limit: number): Promise<Array<{id: number, weight: number, height: number}>> {
        const pokemonRetriever = this.pokemonRetriever;
        return await this.getPokemonsFromApi(offset, limit).then(
            async function (response) {
                return await Promise.all(
                    response.map(async function (item) {
                        let pokemonId = item.url.split('/')[6];
                        return await pokemonRetriever.getPokemon(parseInt(pokemonId)).then(function (response) {
                            return response;
                        })
                    })
                ).then(function(response) {
                    return response;
                }).then(function(response){
                    return response;
                });
            });
    }

    private async getPokemonsFromApi(offset: number, limit: number): Promise<Array<{name: string, url: string}>> {
        try {
            return await axios.get("https://pokeapi.co/api/v2/pokemon", {
                params: {
                    offset: offset,
                    limit: limit
                }
            }).then(function(res: any) {
                     return res.data.results
            });
        } catch {
            console.log("error getting the pokemons");
        }
    }
}
