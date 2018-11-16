# bilemo api

Description

Bilemo api allow client to get, add, show, delete their users along with products they have in a database.

#Webserver with docker

This project use docker to function and here are all the instructions necessary to launch it.

The first thing to do if you haven't install docker yet is to follow this links for installation.
https://docs.docker.com/edge/

- Go to the root of the project and execute this command: docker-compose up


To use the API, you have to follow this instruction

  - Registering a new client by calling

`curl -X POST http://localhost:8080/public/index.php/register -d _username=johndoe -d _password=test -d _email=johndoe@gmail.com`

  - Get the token for authentification

`curl -X POST -H "Content-Type: application/json" http://localhost:8080/public/index.php/api/login_check -d '{"username":"johndoe","password":"test"}'`

  - Test for authentification token

`curl -H "Authorization: Bearer [token]" http://localhost:8080/public/index.php/api/logged/info`

Don't forget to replace the token gave you earlier.

#Use the platform as communication interface with the api

Follow this url : http://localhost:8080/public/index.php/api

Then click on the button Authorize and add `Bearer token` given above.

#Use of postman

With postman, add the token inside the Authorization section.
Here are all the URL useful for retrieving the necessary data.

Users:

 - Get all: /api/users
 - Post: /api/users
 - Get: /api/users/{id} 
 - Delete: /api/users/{id}

Products:

 - Get all: /api/products
 - Get: /api/products/{id} 
 
#Blackfire with blackfire-agent
 
 If you want to use blackfire is quiet a little bit of work but feasible.
 
 - Execute the cmd `docker network inspect bilemo_api_default` then copy the apache server ip that will be used later on.
 
 - Now you can check the performance on a given page by executing `docker exec -it -e BLACKFIRE_CLIENT_ID -e BLACKFIRE_CLIENT_TOKEN bilemo_api_blackfire_1 blackfire curl http://[apache-server-ip]/public/index.php/api`
 
 The two constants BLACKFIRE_CLIENT_ID and BLACKFIRE_CLIENT_TOKEN have to come from your variable environment and these informations is available in your official account on blackfire site.
