[php version](./php)

[typescript version](./ts)

### Requirements
To tests this, you need to have docker-compose and docker installed.

### Instructions to test

1.- Clone this repo
2.- cd to the folder where you have the code
3.- start containers with `docker-compose up`

#### php

Execute 
```shell
docker-compose run --rm app php bin/console app:pokemons-analyzer
```

You can also pass params to the script in the following way
```shell
docker-compose run --rm app php bin/console app:pokemons-analyzer --offset=20 --limit=50
```
Default values are `offset=0` and `limit=20`

Request to the api will return a set of pokemons. The pokemon data for each pokemon retrieved is
cached to disk, so in the following executions of the script, if the pokemon object is
in the list of cached pokemons we don't need to perform more calls to the API.


#### ts

```shell
docker-compose run --rm ts npm run pokemonsAnalyzer
```

You can also pass params to the script in the following way
```shell
docker-compose run --rm ts npm run pokemonsAnalyzer 3 8
```
being offset the first value after the command and limit the second. 
Default values are `offset=0` and `limit=20`

No caching added in this version 
