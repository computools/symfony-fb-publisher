# symfony-fb-publisher
Symfony 4 based simple API that allows you to register, authorize, create posts, themes and publish posts to Facebook.

# Authorization
lexik/jwt-authentication-bundle with Symfony Security was used for auth implementation.
For requests, that requires authorization, you need to add Authorization header:

Authorization: Bearer {{token}}

# FOS Rest Bundle
To build application as API FOS Rest Bundle was used with custom exceptions. All routes was builded considering Restful API style.

# Request Validation
fesor/request-objects

# Serialization
samj/fractal-bundle

# Facebook
facebook/graph-sdk

# API Postman scheme
There is postman environment and scheme json files at root directory.

# Installation
* clone project
* generate private and public keys for JWT auth
* composer install
* fill the .env file based on .env.dist
