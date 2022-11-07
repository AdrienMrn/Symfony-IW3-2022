# Symfony Docker (PHP8 / Caddy / Postgresql)

A [Docker](https://www.docker.com/)-based installer and runtime for the [Symfony](https://symfony.com) web framework, with full [HTTP/2](https://symfony.com/doc/current/weblink.html), HTTP/3 and HTTPS support.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up` (the logs will be displayed in the current shell) or Run `docker compose up -d` to run in background
4. Check variable in .env : `DATABASE_URL="postgresql://symfony:ChangeMe@database:5432/app?serverVersion=13&charset=utf8"`
5. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
6. Run `docker compose down --remove-orphans` to stop the Docker containers.
7. Run `docker compose logs -f` to display current logs, `docker compose logs -f [CONTAINER_NAME]` to display specific container's current logs

## Commandes utiles
Lister l'ensemble des commandes existances `docker compose exec php bin/console`

#### Création de fichier vierge
Controller `docker compose exec php bin/console make:controller`

FormType `docker compose exec php bin/console make:form`

CRUD `docker compose exec php bin/console make:crud`

#### Debug
Supprimer le cache du navigateur `docker compose exec php bin/console cache:clear`

Voir les routes actives `docker compose exec php bin/console make:crud`

## Gestion des routes
[https://symfony.com/doc/current/routing.html](https://symfony.com/doc/current/routing.html)

## Autowiring & ParamConverter
Autowiring [https://symfony.com/doc/current/service_container/autowiring.html](https://symfony.com/doc/current/service_container/autowiring.html)

ParamConverter [https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html](https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html)

## Gestion de base de données

#### Commandes de création des fichiers entity/repository et d'ajout de champs
`docker compose exec php bin/console make:entity`

Documentation sur les relations entre les entités [https://symfony.com/doc/current/doctrine/associations.html](https://symfony.com/doc/current/doctrine/associations.html)

#### Mise à jour de la base de données via migration
Generation d'une migration `docker compose exec php bin/console make:migration`

Jouer les migrations `docker compose exec php bin/console doctrine:migration:migrate`

#### Mise à jour de la base de données via update de schema sans migration
Voir les requètes interprétées (sans mise à jour de la DB)

`docker compose exec php bin/console doctrine:schema:update --dump-sql`

Executer les requètes en DB

`docker compose exec php bin/console doctrine:schema:update --force`

## Gestion des formulaires

Documentation [https://symfony.com/doc/current/forms.html](https://symfony.com/doc/current/forms.html)
Types [https://symfony.com/doc/current/reference/forms/types.html](https://symfony.com/doc/current/reference/forms/types.html)