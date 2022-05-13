import 'reflect-metadata';
import {PokemonsAveragesRetriever} from "../../application/averageRetriever/PokemonsAveragesRetriever";
import {PokemonsAverageResponse} from "../../application/PokemonsAverageResponse";
import {Container, Service} from "typedi";

@Service()
export class analyzer {
    constructor(private readonly pokemonsAveragesRetriever: PokemonsAveragesRetriever) {}

    async execute(offset: number, limit: number): Promise<PokemonsAverageResponse> {
        return await this.pokemonsAveragesRetriever.getAverages(offset, limit).then(function(response) {
            return response;
        });
    }
}
