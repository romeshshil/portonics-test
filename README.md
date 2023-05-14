# README

## Introduction
This readme file provides instructions on how to clone the repository and run the demo application. The application is a simple web app that allows users to log in and perform various actions. 

## Getting Started

### Cloning the Repository
To clone the repository, follow the steps below:

1. Open your terminal.
2. Navigate to the folder where you would like to clone the repository.
3. Run the following command:
```
git clone https://github.com/romeshshil/portronics-test.git
```

### Configuring the Application
Before running the application, you will need to configure it. To do this, follow the steps below:

1. Navigate to the `app/Configs` folder.
2. Open the `Config.php` file in your favorite text editor.
3. Update the configuration values as needed.

### Importing the SQL File
The application requires a database to function. To create the database, follow the steps below:

1. Navigate to the root folder of the application.
2. Find the `demo.sql` file.
3. Import the `demo.sql` file into your database.

### Installing Dependencies
The application requires to run composer, follow the steps below:

1. Navigate to the root folder of the application.
2. Run the following command:
```
composer install
```
3. Run the following command to update the auto-loader:
```
composer dump-autoload
```

### Running the Application
To start the application, follow the steps below:

1. Navigate to the root folder of the application.
2. Run the following command:
```
php -S localhost:8000 -t public
```
3. Open your web browser and navigate to `http://localhost:8000`.

### Demo User
To log in to the application, you can use the following demo user credentials:

Email: rom@gmail.com
Password: 123456

## Conclusion
This concludes the readme file. If you have any questions or encounter any issues, please do not hesitate to contact the developer.