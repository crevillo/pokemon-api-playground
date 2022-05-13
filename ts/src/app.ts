import {analyzer} from "./Pokemons/infrastructure/cli/analyzer";
import {Container, Service} from "typedi";
import {performance} from "perf_hooks";
import {PokemonsAverages} from "./Pokemons/domain/PokemonsAverages";
import {PokemonsAverageResponse} from "./Pokemons/application/PokemonsAverageResponse";

@Service()
class App {
    constructor(private readonly analyzer: analyzer) {}

    async main(offset: number, limit: number): Promise<PokemonsAverages> {
        return await this.analyzer.execute(offset, limit).then(function(response: PokemonsAverageResponse) {
            return new PokemonsAverages({
                weight: parseFloat(response.weight.toFixed(2)),
                height: parseFloat(response.height.toFixed(2))
            });
        });
    }
}

const app = Container.get(App);

let start = performance.now();
let offset = parseInt(process.argv[2]) || 0;
let limit = parseInt(process.argv[3]) || 20;

app.main(offset, limit).then(function(response) {
    let time = performance.now() - start;
    response.setTime(time);
    console.table(response)
});
