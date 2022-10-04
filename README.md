# iThinkWeb Backend developer coding test

## Task
You're tasked to create a simple REST web service application for an e-commerce app using Laravel.

You need to develop APIs for creating and viewing a single product. There should also be an API for viewing a list of the products.

A product needs to have the following information:

- Product name
- Product description
- Product price
- Created at
- Updated at

## Requirements
- The product name should have a maximum of 255 characters, and the product price should be numeric that accepts up to two decimal places.
- The created at and updated at fields should be in timestamp format.
- The view products list API needs to be paginated.
- You are required to use MySQL for the database storage in this test.
- You are free to use any library or component just as long as it can be installed using Composer.
- Don't forget to provide instructions on how to set the application up.

## Optional (for bonus points)
- Cache the view single product API. You are free to use any cache driver
- Create automated tests for the APIs
- Say for example, we need a feature where we can display featured products. How would you go about implementing this feature? (You don't need to write code for this, just describe how would you implement it) , 

ANSWER:
basically we can used or filterd feature product and highlights it on Home page for easly view from Normal users , and sort it by date by the latest product using backend Codes API if there has old api we can implement or add or retain a code for the Feature enchancement requirements if ther is no  we can implement or add new one for that feature product enchamcement by the  Following Client Requirements


##
SETUP

1 First Create copy .env.example Configuration and create new one .env file and put it the configuration
2 run Composer install,
3 run php artisan key:generate
4 run php artisan migrate,
5 run php artisan db:seed for dummy data
6 Goto postman web or desktop application and import this  Collection  https://www.getpostman.com/collections/cc768e230c15c37a86b4
7 run php artisan serve

