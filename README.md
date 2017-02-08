The Pletfix Application Skeleton.
=================================

Author: Frank Rohlfing <mail@frank-rohlfing.de>

# Installation 

1) Clone the project: 

    git clone git@bitbucket.org:frohlfing/happy.git

2) Copy the environment example fle `.env.example` to `.env` edit it.

3) Create a folder named `storage` and make it writable.

4) Load the dependencies packages:

	composer update
	
> For your development environment you should download the assets too. It' not required for the production system. 	
>	
>	bower update
>
> Additional you should install gulp for your IDE:
>
>   npm install
>
>   gulp

5) Create Database:

    CREATE DATABASE `happy` COLLATE 'utf8_general_ci';
    
// 6) Run the database migrations:
//     
//    php artisan migrate