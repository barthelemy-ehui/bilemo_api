# bilemo api

Description

Bilemo api allow client to get, add, show, delete their users along with products they have in a database.

Usage

To use the API, you have to follow this instruction

-  Registering a new client by calling

`curl -X POST http://localhost:8080/register -d _username=johndoe -d _password=test -d _email=johndoe@gmail.com`

-  Get the token for authentification

`curl -X POST -H "Content-Type: application/json" http://localhost:8080/api/login_check -d '{"username":"johndoe","password":"test"}'`

-  Test for authentification token

`curl -H "Authorization: Bearer [token]" http://localhost:8000/api/logged/info`

Don't forget to replace the token get from the above.

#Use the platform as communication interface with the api
By going to your url, add `/api` at the end.
Then click on the button Authorize and add `Bearer token` given above.

#Use of postman

With postman, add the token inside the Authorization section.
Here are all the URL useful for retrieving the necessary data.

Users
-  Get all: /api/users
-  Post: /api/users
-  Get: /api/users/{id} 
-  Delete: /api/users/{id}

Products:
-  Get all: /api/products
-  Get: /api/products/{id} 
