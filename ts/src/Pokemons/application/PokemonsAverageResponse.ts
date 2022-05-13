export class PokemonsAverageResponse {
    readonly weight: number;
    readonly height: number;

    constructor({weight, height}: {weight: number, height: number}) {
        this.weight = weight;
        this.height = height;
    }
}
