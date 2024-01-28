> All of this details are not yet finalized. Maybe soon...

# Employee Monitoring System

## Introduction
We are all familiar with different kinds of attendance automation such as RFID Attendance Management, Biometric Attendance Management, and School App Attendance Management which are to reduce the time that is consumed when attendance is taken manually. Unlike the manual process, an online system easily helps management to analyze more the attendace detail as per requirement. This project "Employee Monitoring System", an attendance monitoring inteneded only for my school project.

## Description of the System
The Employee Monitoring System is an online attendance platform. The employee will use a QR Code to login and logout through the system. The employee also can preview their monthly attendance.

## How it works?

### Users
There will be 3 accounts to be created an these are:
1. Admin
2. In-charge Personnel 
3. Employee

### Functionalities of each Users
- **Admin**
- [x] Can CRUD accounts for HRMO, In-charge Personnel and Employee
- [x] Alter any users information

- **In-charge Personal**
- [x] Scan QR Code of employee

- **Employee**
- [x] Can preview there attendance
- [x] Can login and logout using there QR Code


## How to Setup
This is the step by step on how to setup the project to local environment

### Requirements
- PHP VERSION: 7.4 | 8.0
- MYSQL VERSION: 5.7 | 8.0
- NODEJS VERSION: 16
- COMPOSER
- APACHE

**DISCLAIMER**
All the requirements should be installed in your machine or else it won't work as expected
You can also use the complete package like [laragon] (https://laragon.org/index.html) or [Xampp] (https://www.apachefriends.org/)

### Cloning the project
In order to have a copy in the local machine.
Copy and paste this command in your terminal.
NOTE: Make sure you're in the right directory
EX: 
> C:/Users/Desktop/web-projects
```
git clone https://github.com/Miyunecadz/emisv2.git
```

### Setup ENV
ENV file stored all the configuration that this project used.
This also prevent malicious developer to take the credentials especially if the crendetials are from live server.
Example is the database credentials.

```
cp .env.example .env
```

#### Configuring the ENV
For this project, we will only configure the database credentials.
In the .env file update the following

EX:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=emisv2
DB_USERNAME=root
DB_PASSWORD=
```
**NOTE**
Make sure the the credentials are correct

### Creating Database
In your mysql server, create new database and name it `emisv2`

### Installing Dependecies
To install the dependecies that the project required to have.
Just run this command:
```
composer install
```
> After the installation it will create vendor folder and subfolders

```
npm install
```
> After the installation it will create node_modules folder and subfolders

### Building the project assests
Since all code are not yet compiled, to compile the code just run this command
```
npm run build
```

### Generating the project key
Project key are unique and used to identify the project session used and others. 
```
php artisan key:generate
```

### Running the migrations
Earlier we created database, now we will add tables to the database.
To add the tables just run this command
```
php artisan migrate
```

### Running the seeders
In order to have a dummy data in our table we can run this command
```
php artisan db:seed
```

### Running the project server
After all the steps are done, we can now finally run this command
```
php artisan serve
```

In the browser type this url(s)

For Admin
```
localhost:8000/login
```

For employee

```
http://localhost:8000/employee/login
```
