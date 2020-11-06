# EpiTable
Rajout d’un service de restauration avec plusieurs créneaux à Epitech Nantes. Le projet sera un système de réservation de créneaux pour déjeuner.


## How to start ?

> Assets generation ~1min 
```bash
$ cp .env.example .env
$ make start
$ make init (just for first launch)
```
visit http://localhost:7516 <br />

Init method create 2 users
```text
admin@epitech.eu    password
student@epitech.eu  password
``` 
---

## Start dev
> Assets generation ~1min 
```bash
$ cp .env.example .env
$ make dev
$ make init (just for first launch)
```
visit http://localhost:7516 <br />

Init method create 2 users
```text
admin@epitech.eu    password
student@epitech.eu  password
``` 
---

## Makefile

```text
$ make help

dev                            Start dev server
fresh                          Database fresh & seed (docker-compose must be up)
init                           FirstTime initialisation (docker-compose must be up)
migrate                        Database migration (docker-compose must be up)
seed                           Database seed (docker-compose must be up)
start                          Start production server
stop                           Stop production server
```
