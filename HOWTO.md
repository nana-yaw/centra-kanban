# HOW TO

This file contain instructions for help setup your local environment.

## Setting up
After unzipping the archive:

Create an Oauth App in your GitHub account; use this [link](https://docs.github.com/en/developers/apps/creating-an-oauth-app) to know how to.

Rename the file `.env.example` to `.env`.

Below is the definition for your environment variable...

* Get `GH_CLIENT_ID` value as `CLIENT ID` from newly created GitHub Oauth App.
* Get `GH_CLIENT_SECRET` value as `CLIENT SECRET` from newly created GitHub Oauth App.
* `GH_ACCOUNT` is your current GitHub username.
* `GH_REPOSITORIES` are names of your GitHub repos separated by a `|` character.

From your favorite cli, `cd` into the root of this project and run this command `php -S localhost:8000 -tsrc/public`.
In your browser visit [localhost:8000](localhost:8000).


## Demo Application
Visit this [demo](https://centrakanban.herokuapp.com/) to test deployed application.
