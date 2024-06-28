## Esta tudo dentro de um container do docker, deve ser facil de fazer rodar :)

Passo a passo:
criar .env
```
docker-compose up
```
Tudo deve funcionar agora :)

caso de algo errado roda um 
```
composer install
```
dentro do container

se der problema de permissão: da 
```
chmod 777 -R
```
na raiz do projeto (não é uma boa prática, mas como esse projeto é pessoal não tem perigo) 
