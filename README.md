# Documentation product configurator

### Introduction

This web app allows you to easily create a product configurator. Using its clean and simple interface you can create, edit or delete configurators, products, steps and manufacturers.

### Installation guide 🚀

To install the product configuration, please visit [https://www.laravel.com](https://www.laravel.com/) to install Laravel on your system. Also make sure you have Composer, NodeJS and MySQL installed on your system.

To run this system on your local machine. Clone this repository by running this command in the command-line

`gh repo clone Rainieren/configurator`

This will install the repository on your local machine. If you have the packages stated above correctly installed. You can proceed by running this command in the command-line.

```other
composer install
npm install
```

This will install all the necessary packages that the configurator requires to function properly. A quick note, make sure to create a `.env` file where you register the correct details such as your database and other required details such as application keys.

If you would like to start with an empty system you can leave it like it is now and investigate further without data. There are no limitations without the data. It is just and empty system. Just make sure to run to get all the database tables.

`php artisan migrate`

If you would like to have some sample data, run the following command in the command-line. Make sure to add the `—seed` tag to retrieve all the sample data

`php artisan migrate —seed`

If everything went as expected without any issues. You should see this screen, if so, enjoy using the configurator!

### Vulnerabilities 👺

Thank for showing interest in my project! If you have any feature request or come across any vulnerabilities or bugs. Feel free to contact me on [info@rainierlaan.nl](craftdocs://open?blockId=9E171354-5633-4387-A36B-12F35620729D&spaceId=926cabc9-c2b7-a193-66e0-34441df140f9) or create a issue on the [Github repository](https://github.com/Rainieren/configurator)
