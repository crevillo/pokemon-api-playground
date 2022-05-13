import {PokemonRetriever} from "../../application/PokemonRetriever";
import {Service} from "typedi";
import {default as axios} from "axios";

@Service()
export class PokemonFromApiRetriever implements PokemonRetriever {
    async getPokemon(id: number): Promise<{ id: number, weight: number, height: number }> {
        return await PokemonFromApiRetriever.getPokemonFromApi(id).then(function(pokemonFromApiResponse) {
            return {id: pokemonFromApiResponse.id, weight: pokemonFromApiResponse.weight, height: pokemonFromApiResponse.height};
        });
    };

    private static async getPokemonFromApi(id: number): Promise<any> {
        try {
            return await axios.get("https://pokeapi.co/api/v2/pokemon/" + id).then(function(res: any) {
                return res.data
            });
        } catch {
            console.log("error getting the pokemons");
        }
    }
}
