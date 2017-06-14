# The Pletfix Application Skeleton.

## About Pletfix

This is a application skeleton with Responsive Design for the Pletfix framework.

Pletfix is going to be an easy to learn and fasted PHP framework.

But currently, Pletfix is **under construction** and not ready to use yet!

Please have patience with us :-)

Read more about Pletfix in the [official documentation](https://pletfix.com).

## Requirements

- PHP >= 5.6.4
- [Composer](https://getcomposer.org/)
- [NPM/Bower Dependency Manager for Composer](https://github.com/fxpio/composer-asset-plugin/blob/master/Resources/doc/index.md) (a global scope installation is required!)

## Installing Pletfix Application

1. Download files

    Install Pletfix by entering the Composer create-project command in your terminal:
    
    ~~~
    composer create-project pletfix/app --repository=https://raw.githubusercontent.com/pletfix/app/master/packages.json my-project-name
    ~~~
    
    The command above will create a fresh Pletfix Application in the directory you specify (here "my-project-name").
    
    At the end it will ask you "Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]?", something you 
    should answer with Y(es).

2. Directory Permissions

    After you have downloaded Pletfix, you may create the folder `storage` with following subfolders:
    
    ~~~
    storage/
        cache/
        logs/
    ~~~
    
    **Important:** All directories within the storage have to be writable by your web server! 
    
    You may change the permissions as below:
    
    ~~~
    cd storage
    chgrp www-data *
    chmod 775 *
    chmod g+s *
    ~~~

3. Environment

    Rename the file `.env.example` to `.env`and modify the entries in this file as you need.
 
4. Additional Configuration

    Customize the configuration files stored in `config` folder.

5. Install Composer Packages

    Enter this command to install the packages in the `vendor` folder:
        
        composer install
        
    > For the production system you should using the `no-dev` option:        
    >    
    >     composer install --no-dev
    
6. Create the database

    Create the database according to your configuration. If you didn't change the default setting, a SQLite database has 
    been configured and you can create the database by entering this shell command:
  
        touch storage/db/sqlite.db

    After then, enter the following command in your terminal to migrate the database:

        php console migrate

That's all! Now the application is ready for the first request. 

Open your browser and enter the URL of the application's public folder, e.g.
    
    ~~~
    http://localhost/my-app/public/
    ~~~

## License

The Pletfix framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 
