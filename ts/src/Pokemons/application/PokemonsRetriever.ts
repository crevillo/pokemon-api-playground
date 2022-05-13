export interface PokemonsRetriever {
    getPokemons(offset: number, limit: number): Promise<Array<{id: number, weight: number, height: number}>>
}
