# SugarPuppy
This is a university build project to improve pet adoptions. The propose os this app is to able many people virtualy adopt the same pets with a small fee each, just like a comunity shared pet care.
## Installing
-----------
You'll just need:
 - Some HTTP Server
 -- I reccomend [Apache](https://www.apache.org/), easier to setup with [XAMPP](https://www.apachefriends.org/).
 - [PHP](https://www.php.net/)
### Installation
```sh
$ git clone https://github.com/jbrneto/sugarpuppy.git
$ cd api
$ php composer.phar update
```
**Important:** Remember that you got to create a symbolic link from the apache `htdocs` to the app `api`.
#### Want to develop?
**Yes?** great, so jump to the [I want to develop](#i-just-want-to-use) section.
**Nah?** ok, please jump to [I just want to use](#i-want-to-develop) section.
### I just want to use
Well, if thats the case, you are all setup, just run the `index.html` in the `frontend/dist` folder.
And thats it, time to play, just jump to [Using](#using) section.
### I want to develop
You'll just need:
 - [NodeJs](https://nodejs.org/)
 - [Vue](https://vuejs.org/)
 - Some HTTP Server
 -- I reccomend [Apache](https://www.apache.org/), easier to setup with [XAMPP](https://www.apachefriends.org/).
 - [PHP](https://www.php.net/)
#### Installation
```sh
$ git clone https://github.com/jbrneto/sugarpuppy.git
$ cd api
$ php composer.phar update
$ cd ../frontend
$ npm install
$ npm install -g @quasar/cli
```
**Important:** Remember that you got to create a symbolic link from the apache `htdocs` to the app `api`.
#### Running
*Considering you are in* `frontend`:
```sh
$ quasar dev
```
And thats it, time to play, just jump to [Using](#using) section.
## Using
-----------
Ok, now its time to use the app.

License
---------
MIT
