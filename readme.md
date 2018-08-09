Défi graphique
===============

[![Build Status](https://travis-ci.org/gchameroy/defi-graphique.svg?branch=master)](https://travis-ci.org/gchameroy/defi-graphique)

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
