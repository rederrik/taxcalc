Tax Calculator
========================
This Symfony application calculates the final cost of a product for a buyer, including tax, based on the buyer's tax number. It currently supports tax calculation for Germany, Italy, and Greece.

Features
---------
- Choose from a list of products
- Input your tax number
- Calculates final product price, including the appropriate tax based on your country

Requirements
------------

Either Docker or PHP 8.1 with Composer.

Quick start with Docker
-----------------------
[![GitHub Actions](https://github.com/rederrik/taxcalc/actions/workflows/docker-publish.yml/badge.svg)](https://github.com/rederrik/taxcalc/actions/workflows/docker-publish.yml)

1. Pull and run the image:
   + `docker run -d -p 8080:8080 --name taxcalc-app ghcr.io/rederrik/taxcalc:master`
2. Open http://localhost:8080/ in your browser and enjoy!

To remove:

+ `docker stop taxcalc-app`
+ `docker rm -v taxcalc-app`

Manual Setup
------------

### Setup
1. Clone the repository:
   + `git clone https://github.com/rederrik/taxcalc.git`
   + `cd taxcalc`

2. Install PHP dependencies:
   + `composer install`

### Running the App
1. Run the dev server:
   + `php -S 0.0.0.0:8080 -t public`
2. Open your web browser and navigate to http://localhost:8080 to start using Tax Calculator.

### [optional] Running the tests
`bin/phpunit`

License
-------

This project is open-source and available under the [MIT License](https://raw.githubusercontent.com/rederrik/taxcalc/master/LICENSE).



Created from the following request
-----------------------------------

Create a Symfony application for calculating the product price for a customer.

Example:
The seller sells two products:
- headphones (100 euros)
- phone case (20 euros)
  in three countries:
- Germany
- Italy
- Greece

When purchasing, the buyer must pay a tax on top of the product price (similar to the Russian VAT). The tax rates are:
- Germany: 19%
- Italy: 22%
- Greece: 24%

As a result, for a buyer from Greece, the price of the headphones is 124 euros (product price + tax).

Each buyer has their own tax number in the following format:
- DEXXXXXXXXX - for residents of Germany
- ITXXXXXXXXXXX - for residents of Italy
- GRXXXXXXXXX - for residents of Greece
  where the first two characters are the country code, and X is any digit from 0 to 9

The product price calculation page for the buyer should consist of three fields:
1. A select field with a list of products
2. An input field for entering the buyer's tax number
3. A button to submit the form

After submitting the form, the buyer's country should be determined based on their tax number, and the final cost of the selected product should be calculated.

For form processing, use Symfony forms.
For validation, use validation constraints.
When working on the test task, use Git and send the repository link after completion.