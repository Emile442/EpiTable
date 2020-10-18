FROM node:12-alpine

RUN apk add --update --no-cache bash

WORKDIR /application

ENTRYPOINT npm install --silent --no-progress && npm run prod
