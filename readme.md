Défi graphique
===============

[![buddy pipeline](https://app.buddy.works/geoffreychameroy/defi-graphique/pipelines/pipeline/148965/badge.svg?token=eae23eb4a245269757ce999d67a5c00771d4cde3c953cf735a0287df6be29452 "buddy pipeline")](https://app.buddy.works/geoffreychameroy/defi-graphique/pipelines/pipeline/148965)

Installing Application
----------------

The easiest way to install this application is by using [Docker](https://www.docker.com/):

```bash
$> cp docker-compose.override.yml.dist docker-compose.override.yml
$> docker-compose up -d
```

After that you'll have to install dependencies and database

(on git bash on windows, you may have to add `winpty` before any docker command)
```bash
$> docker-compose exec app composer install
$> docker-compose exec app php bin/console database:schema:update
$> docker-compose exec app php bin/console doctrine:fixtures:load
```
