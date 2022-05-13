export interface PokemonRetriever {
    getPokemon(id: number):  Promise<{id: number, weight: number, height:number}>
}
