CMS Articles Project

Installation Guide

Follow these steps to set up and run the project locally.
Step 1: Clone the Repository

Clone the repository to your local machine:
  
  **git clone https://github.com/Abdulsamad1161/cms_articles.git**
  cd cms_articles


Step 2: Install Dependencies

Run the following commands to install PHP and Node.js dependencies:

  Install PHP dependencies:
    **composer install**
  Install Node.js dependencies using NPM:
    **npm install**

Step 3: Set Up the Database

    Create the database:

Log into MySQL or your database service and run the following SQL query to create the database:

**CREATE DATABASE cms_articles;**

Run migrations and seed the database:

**php artisan migrate:refresh --seed**

Step 4: Set Up Storage

Remove any existing storage link
**rmdir public\storage**

Create a symbolic link for storage:
**php artisan storage:link**

This step creates a symbolic link from public/storage to the storage/app/public directory, allowing you to access files stored by the application.

Step 5: Running the Scheduler

To make sure scheduled tasks, such as article publication or reminders, are executed, run:
**php artisan schedule:work**

Running the Application

Once the setup is complete, you can start the Laravel development server by running the following command:
**php artisan serve**

**Example URLs**
Here are some example URLs you can use to interact with the application:

CMS Public Page: http://localhost:8080/cms/publish/cms

Admin Panel: http://localhost:8080/cms/


Additional Commands

If you need to generate application keys or handle any other configuration, you can run:

**php artisan key:generate**
