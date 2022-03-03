## Job-Scan

Find the jobs most relevant to the skills of a software engineer.

See the video example:

[![Watch the video](https://i9.ytimg.com/vi/Tpj7JBSDI5M/mq1.jpg?sqp=CJCzhJEG&rs=AOn4CLCAi_zbwNQNa-JrMyGPWNO8UDArnA)](https://youtu.be/Tpj7JBSDI5M)


### This Repo

This Laravel project provides a back-end API to manage a data set of jobs, job skills, and job descriptions. You can view the documentation at https://jobscantakehomeprojectapi.docs.apiary.io/, which is generated from [this file](openapi.yaml).

It has included a front-end based on Vue components; handling states with Vuex; and navigation as SPA thanks to Vue-Route.
Everything compiles optimally with Laravel/Mix.
Bootstrap 5.1 based css components

### Setup

This repo is configured with [Laravel Sail](https://laravel.com/docs/8.x/sail), if you have docker installed, you can set it up by running the `build.sh` script in this repo, this will setup the containers in docker (and run them) and install composer dependencies, and run the DB migrations, after this you can use the `vendor/bin/sail` script for future interactions with the repo.

We have a CSV file included and an artisan command to import the CSV file into the DB table

`vendor/bin/sail artisan populate:jobs`

#### Without Docker

If you don't have docker installed, you'll need PHP8 and composer and will have to install composer and node dependencies yourself.

### Unit Testing

Unit tests are in place which you can run with `vendor/bin/sail artisan test`, but they rely on the data being loaded, so be sure to run the populate:jobs artisan command first.

