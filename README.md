# WordPress Project Template

Repository to kickstart a new WordPress project.

## Development flow

Following DSLK-flavored Git flow, you branch out of `development` branch into feature branches, then submit PRs from them into `development`. Once PRs are merged into `development`, you sync with it and branch out again. `master` is updated from `development` branch with a PR before a production deployment. Direct pushes into `master` and `development` are forbidden by repository policy.

Files protected from changes (to be edited by DevOps team only):

* `.drone.yml` - contains current pipelines to build and deploy different environments (development, QA, production)
* `Dockerfile` - Docker build recipe
* `docker-compose.yml` and `docker-compose.local.yml` (these are deployment manifests used for all the environments)

### Development deployments

Submitting a PR to `development` triggers CI build to check the project. Merging a PR into `development` triggers a pipeline that builds new image and updates development environment at `https://<projectname>.dsstaging1.com` so you can see your changes right away.

### QA deployments

Development environment can be cloned as QA environment by deploying any successful development build from [Drone CI interface](https://ci.dsstaging1.com): click _Deploy_ button, type `qa` into _Target_ field and hit _Deploy_. QA environment will be available at `https://<projectname>qa.dsstaging1.com` when the deployment is finished.

> **Pro tip**: during subsequent deployments, you can set `WIPE_DB` parameter to `true` to recreate QA DB from development one.

## Local setup

> Prerequisites:
> * [Docker](https://docs.docker.com/get-docker/)
> * [`docker-compose`](https://docs.docker.com/compose/install/)
> * access to DigitalOcean DSLK container registry (ask DevOps team)

Create `.env` file in the root of the repository, fill these variables:

```bash
COMPOSE_PROJECT_NAME=projectname
SITE_NAME=localhost
MYSQL_PASSWORD=securepassword
MYSQL_ROOT_PASSWORD=verysecurepassword
```

Copy `docker-compose.local.yml` into [`docker-compose.override.yml`](https://docs.docker.com/compose/extends/#adding-and-overriding-configuration):

```bash
cp docker-compose.local.yml docker-compose.override.yml
```

Start your local stack:

```bash
docker-compose up --build -d
```

Your WordPress instance will be available at `http://localhost:8080` (you can edit your `docker-compose.override.yml` to your preference).

To destroy the setup, run `docker-compose down --volumes` - note, this will remove your local database!

> **Pro Tip**: you can configure PHP-FPM and Nginx with environment variables in your `docker-compose.override.yml`, see the docs of the corresponding Docker images:
> * [PHP variables](https://git.dsstaging1.com/infra/docker-php/src/branch/master/README.md#user-content-environment-variables)
> * [WP variables](https://git.dsstaging1.com/infra/docker-wordpress/src/branch/master/README.md#user-content-environment-variables)

### Adding submodules from another repository

If you want to replicate a list of submodules from another repository without running same commands all over again, use `add-submodules.sh` script. Copy `.gitmodules` file from another repo, then run the script (Windows users, you can use Git Bash, it works there):

```bash
./add-submodules.sh
```
