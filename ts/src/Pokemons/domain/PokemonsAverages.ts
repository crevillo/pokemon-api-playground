export class PokemonsAverages {
    readonly weight: number;
    readonly height: number;
    private time: number;

    constructor({weight, height}: {weight: number, height: number}) {
        this.weight = weight;
        this.height = height;
    }

    setTime(time: number) {
        this.time = time
    }

    getTime(time: number): number {
        return this.time;
    }
}
