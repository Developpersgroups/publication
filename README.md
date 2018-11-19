Publication Web Application(Symfony2)
====================================

This web application will help employees and manage quickly the large amount of books, as well as their sales to three kinds of clients "professors", "students" and "establishment" thanks to the integrated basket system and finally
generate invoices that are always accessible via the user's menu. A panel of simple and graphical statistics is visible to the administrator to keep the traceability of users or sellers by years, months, weeks and days.

My application uses Symfony version 2.5 and AJAX for an enhanced user experience.


### Download the application

clone this repository into your working directory

	git clone git@github.com:Developpersgroups/publication.git

Before starting, make sure that your local system is properly configured for Symfony.

Execute the `check.php` script from the command line:

    php app/check.php

Access the `config.php` script from a browser:

    http://localhost/path-to-project/web/config.php
	
If you get any warnings or recommendations, fix them before moving on.

### Install Composer

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/  or just run the following command:

    curl -s http://getcomposer.org/installer | php
	
### Install the dependencies

After you download composer, run the following command:

    php composer.phar install

### Import the database
	
You'd need to import this sql source file to your DBMS

	https://github.com/Developpersgroups/publication/blob/master/Pub.sql

## Run the server
	
	php app/console server:run
