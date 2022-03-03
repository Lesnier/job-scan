## Jobscan Take-home Exercise

You are trying to help a friend find jobs that are most relevant to their skillset as a software engineer. You have access to an API that provides some job postings and a list of required skills. Your friend will list their skills and rate themselves on each on a scale of 1 to 5 (5 being best).

### This Repo

This Laravel project provides a back-end API to manage a data set of jobs, job skills, and job descriptions. You can view the documentation at https://jobscantakehomeprojectapi.docs.apiary.io/, which is generated from [this file](openapi.yaml).

Unfortunately, there is no front-end, and there seems to be a bug in it!

### Setup

This repo is configured with [Laravel Sail](https://laravel.com/docs/8.x/sail), if you have docker installed, you can set it up by running the `build.sh` script in this repo, this will setup the containers in docker (and run them) and install composer dependencies, and run the DB migrations, after this you can use the `vendor/bin/sail` script for future interactions with the repo.

We have a CSV file included and an artisan command to import the CSV file into the DB table

`vendor/bin/sail artisan populate:jobs`

#### Without Docker

If you don't have docker installed, you'll need PHP8 and composer and will have to install composer dependencies yourself.

### Unit Testing

Unit tests are in place which you can run with `vendor/bin/sail artisan test`, but they rely on the data being loaded, so be sure to run the populate:jobs artisan command first.

### Tasks

-   **Front-end** We want to provide a web interface for your friend to view a list of relevant job opportunities based on their skills and this list of job postings. Vue.js is preferred, but you may use React or Angular as well. The application should...
    -   [ ] Allow your friend to select up to 10 skills from a list of skills. The list should include skills that appear in the provided list of job postings.
    -   [ ] Rate themself on each skill on a scale of 1-5.
    -   [ ] Display the most relevant job postings from the provided list based on your friend's skills along with a relevance score. The score of each job description should be an integer representing the sum of ratings for each of the matched skills.
    -   [ ] Display the list of job postings with the highest score first.
    -   [ ] Share your front-end project with us. Please include setup instructions!
-   **Back-end**
    -   Feel free to modify and extend the Laravel app to meet your needs.
    -   [ ] One of our unit tests is failing, investigate and adjust as necessary. Create a pull request to resolve the issue.

### Completing the Project

-   Please let us know right away if you run into any issues setting up the application.
-   This is intended to be an open-ended project, but please ask any clarifying questions you need.
-   We expect candidates to spend 3-5 hours on the project and return it within 1 week.
-   If you run out of time, include a list of improvements you would make if you had more time.
-   Provide your source code.
