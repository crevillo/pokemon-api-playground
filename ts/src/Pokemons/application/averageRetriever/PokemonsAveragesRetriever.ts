import {PokemonsAverageResponse} from "../PokemonsAverageResponse";
import {PokemonsCollection} from "../../domain/PokemonsCollection";
import {Service} from "typedi";
import {PokemonsFromApiRetriever} from "../../infrastructure/client/PokemonsFromApiRetriever";

@Service()
export class PokemonsAveragesRetriever {
    constructor(private readonly pokemonsRetriever: PokemonsFromApiRetriever) {}

    async getAverages(offset: number, limit: number): Promise<PokemonsAverageResponse> {
        return await this.pokemonsRetriever.getPokemons(offset, limit).then(function(response) {
            let pokemons = new PokemonsCollection(response);
            return pokemons.averages();
        });
    }
}
