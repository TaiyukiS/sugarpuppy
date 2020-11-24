# SugarPuppy
This is a college project aiming to increase the pet adopters. This app will able many people to virtually adopt the same pets with a small fee each, just like a community shared pet care.
## Manual of Use
**Quick question:** are you a dev and  want to set it up locally? If that's the case, please checkout the [Installing](#installing) section first.

First, access the application on: https://sugarpuppy.azurewebsites.net/
Then...

## Installing
You'll just need:
 - Some HTTP Server
 -- I reccomend [Apache](https://www.apache.org/), easier to setup with [XAMPP](https://www.apachefriends.org/).
 - [PHP](https://www.php.net/)
 - [NodeJs](https://nodejs.org/)
### Installation
```sh
$ git clone https://github.com/jbrneto/sugarpuppy.git
$ cd api
$ php composer.phar update
$ cd ../frontend
$ npm install -g @quasar/cli
$ cd frontend
$ npm install
```
**Important:** Remember that you got to create a symbolic link from the apache `htdocs` to the app `api`.
### Running
*Considering you are in* `frontend`:
```sh
$ quasar dev
```
And that's it, time to play, jump to [Manual of Use](#manual-of-use) section.
