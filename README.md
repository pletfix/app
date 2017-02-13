#The Pletfix Application Skeleton.

Author: Frank Rohlfing <mail@frank-rohlfing.de>

##About Pletfix

Pletfix is going to be an easy to learn and fasted PHP framework.

But currently, Pletfix is **under construction** and not ready to use yet!

Please have patience with us :-)

##Server Requirements

- PHP >= 5.6.4
- [Composer](https://getcomposer.org/)
- [NPM/Bower Dependency Manager for Composer](https://github.com/fxpio/composer-asset-plugin/blob/master/Resources/doc/index.md) (a global scope installation is required!)

##Installing Pletfix Application
 
**1) Download files**

Install Pletfix by entered the Composer create-project command in your terminal:

~~~
composer create-project pletfix/app --repository=https://raw.githubusercontent.com/pletfix/app/master/packages.json my-project-name
~~~

The command above will create a fresh Pletfix Application in the directory you specify (here "my-project-name").

At the end it will ask you "Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]?", something you should answer with Y(es).

**2) Directory Permissions**

After download Pletfix, you may create the folder `storage` with following subfolders:

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

**3) Environment**

Rename the file `.env.example` to `.env`and modify the entries as you need.
 
**4) Additional Configuration**

Customize the configuration files stored in `config` folder.

##License

The Pletfix framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)..
 
