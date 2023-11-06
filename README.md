# Dev Test BackEnd

It conains the achievement counter increament on the basis lessons watched and comments written. Which increase the badge achieved on the basis of achievement counter entries in database.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Testing](#testing)

## Getting Started

Please use following instruction to take care to install the project on your server or local machine


### Prerequisites

List any software and dependencies that need to be installed to run this project. Include instructions on how to install them.

- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) (or any other supported database)

### Installation

1. Clone the repository:

   ```bash
   git clone git@github.com:bharatv03/dev-test.git

2. Install libraries 

    composer install

## Usage

After cloning is done please use following commands to activate your project

1. This command will help you point the project to accurate Database

    cp .env.example .env
    **Please update database details in .env file as per your server.

2. This command will activate your above file on the project for being able to use
    
    php artisan config:clear

3. The below command will create all the tables that are being used for this project
    
    php artisan migrate

4. The below command will help you create the admin user entry 

    php artisan db:seed

5. The command below will start the server on local machine

    php artisan serve

6. After running the server command your URL will be active with below URL:

    https://localhost:8000

The above commands will help you create project run successfully to utilize all the features built

## Features
I have added two additional URLs which will help to add fake entries on random basis for users available in DB. Plus one URL which was mentioned as per the task, which will show the details of selected user. if user won't exist it will show 404 page. Please follow below URL to run the functionality.
**Note: I have kept UserId = 1 for testing purpose please dont use that user ID

1. View User Achievements = http://localhost::8000/users/{user_id}/achievements
2. Add Lesson = http://localhost::8000/users/event-test-lesson
3. Add Comment = http://localhost::8000/users/event-test-comment

## Testing

    For Testing purpose you use command 

    php artisan test

    I have added few test cases where I have kept the UserId = 1

1. Where no comments no lessons and no achievements are available with 0 badges
2. Where 1 lesson is watched and total 1 achievement is achieved with 0 badges
3. Where 1 comment is written and total 2 achievement is achieved with 0 badges
4. Where 4 more comments are added and total 3 achievements have been achieved with 0 badges
5. Where 2 more comments are added and total 4 achievemetns have been achieved with 1 badge
6. HTTP Test case with No url found will throw 404 not found
7. HTTP Test case with No user found will throw 404 not found
8. HTTP Test case where it will give success with json data with 200
