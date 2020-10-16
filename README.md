![Text](resources/assets/readme/monkey-face-simple-violet.png)


![Travis Status](https://img.shields.io/static/v1?label=version&message=v0.1.0&color=blue)

## Game Aplication

Application written in hexagonal architecture. This is a little game of transformation.

We will use docker for the virtualization of the application.


## Description

We will send messages to the server by post request with an attached XML in which we will send a user and a message.

An email with the request will be sent to the user's email address and we will respond with the pertinent response to the user's request in an XML format.

## Deploy

![Travis Status](https://img.shields.io/static/v1?label=DEPLOY&message=UP&color=blue)  To up the application we will use the command:

~~~
make up
~~~

![Travis Status](https://img.shields.io/static/v1?label=DEPLOY&message=PAUSE&color=blue) To stop the application we will use the command:

~~~
make pause
~~~
![Travis Status](https://img.shields.io/static/v1?label=DEPLOY&message=DESTROY&color=blue)  To destroy all the container we will use the command:

~~~
make down
~~~
![Travis Status](https://img.shields.io/static/v1?label=DEPLOY&message=INIT&color=blue)  To execute any command with [webpack](https://webpack.js.org/) we will use the command:

~~~
make init
~~~

## Package Manager

![Travis Status](https://img.shields.io/static/v1?label=PACKAGE&message=ARTISAN&color=success)  To execute any command with artisan we will use the command:

~~~
make artisan command=xxxxx
~~~

![Travis Status](https://img.shields.io/static/v1?label=PACKAGE&message=BASH&color=success)  To execute any command with bash we will use the command:

~~~
make bash command=xxxxx
~~~

![Travis Status](https://img.shields.io/static/v1?label=PACKAGE&message=COMPOSER&color=success) To execute any command with [composer](https://packagist.org/) we will use the command:

~~~
make composer package=xxxxx 
~~~

![Travis Status](https://img.shields.io/static/v1?label=PACKAGE&message=NPM&color=success)  To execute any command with [npm](https://www.npmjs.com/) we will use the command:

~~~
make npm package=xxxxx
~~~
![Travis Status](https://img.shields.io/static/v1?label=PACKAGE&message=PHP&color=success)  To execute any command with php we will use the command:

~~~
make php command=xxxxx
~~~

## Testing

![Travis Status](https://img.shields.io/static/v1?label=TEST&message=UNIT&color=yellow)   To execute test unit in the application:

~~~
make test-unit
~~~

![Travis Status](https://img.shields.io/static/v1?label=TEST&message=INTEGRATION&color=yellow)  To execute test integration in the application:

~~~
make test-integration
~~~

![Travis Status](https://img.shields.io/static/v1?label=TEST&message=ALL&color=yellow)  To execute all test in the application:

~~~
make test-all
~~~

![Travis Status](https://img.shields.io/static/v1?label=TEST&message=COVERAGE&color=yellow)  To execute all test WITH COVERAGE in the application:

~~~
make test-coverage
~~~

![Travis Status](https://img.shields.io/static/v1?label=TEST&message=MUTANT&color=yellow)  To execute mutant test in the application:

~~~
make test-mutant
~~~

## Manage Database

For the management of the database with interface we can use the adminer. Go to [localhost:8080](http://localhost:8080).

 ![alt text](resources/assets/readme/database.png)
 
 When we initialize the project we create a new database user who is **laraveluser** and give it root permissions inside mysql to have any interactions with database.
 ## Manage Petition Http
 
 We use the file **web.http** to simulate Http Request. This file allows us to have the same functionalities as postman inside the project. 

## License

The application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
