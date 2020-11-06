# EpiTable

## How to start ?

> Assets generation ~1min 
```bash
$ make start
$ make init (just for first launch)
```

---

## Start dev
> Assets generation ~1min 
```bash
$ make dev
$ make init (just for first launch)
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
