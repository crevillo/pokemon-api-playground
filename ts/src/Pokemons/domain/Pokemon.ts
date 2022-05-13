export class Pokemon {
    readonly id: number;
    readonly weight: number;
    readonly height: number;

    constructor({id, weight, height}: {id: number, weight: number, height: number}) {
        this.id = id;
        this.weight = weight;
        this.height = height;
    }
}
