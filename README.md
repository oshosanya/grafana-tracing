## Setup

Before starting the application, you need to run migrations, and have a zipkin server running. 
Database credentials can be set in the .env file.

`php artisan migrate`

Start a zipkin server on docker using

`docker run -d -p 9411:9411 openzipkin/zipkin`

You can then run the application using

`php artisan serve`

You can visit the following routes

/

/hello

/register

Submitting the form on /register redirects you to the index route.

You can view all traces on http://localhost:9411/


## Further Improvements

The trace endpoint can be created using the route `METHOD: path` to make viewing in 
zipkin a bit more intuitive and remove reliance on route names.

The laravel-zipkin project could also be forked so that any changes that need to be made to 
make it easier to use can be done
