# Recipe-Finder-Application

HOW TO RUN ?
Download the zip folder
Extract all contents to the local server
Run following command

/usr/bin/php -f [PATH TO THE DIRECTORY]/Recipe-Finder/index.php fridge.csv recipe.json.txt
		
Output should be(based on sample data provided):

grilled cheese on toast



UNIT TESTING
------------

Unit testing has been done using PHPUnit. It needs to be installed. 

PHPUnit can be downloaded from here:
https://phar.phpunit.de/phpunit-6.2.phar

After instatallation, navigate to /Recipe-Finder/tests/ dir

Execute following commands:

phpunit UnitTest ingredients_unit_test.php
phpunit UnitTest items_unit_test.php
phpunit UnitTest recipe_finder_unit_test.php
phpunit UnitTest recipe_unit_test.php
