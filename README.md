# The Pletfix Application Skeleton.

## About Pletfix

This is a application skeleton with Responsive Design for the Pletfix framework.

Pletfix is going to be an easy to learn and fasted PHP framework.

![Error Message](https://raw.githubusercontent.com/pletfix/app/master/resources/docs/screenshot_app.png)

But currently, Pletfix is **under construction** and not ready to use yet!

Please have patience with us :-)

Read more about Pletfix in the [official documentation](https://pletfix.com).

## Requirements

- PHP >= 5.6.4
- [Composer](https://getcomposer.org/)
- [NPM/Bower Dependency Manager for Composer](https://github.com/fxpio/composer-asset-plugin/blob/master/Resources/doc/index.md) (a global scope installation is required!)

## Installing Pletfix Application

Install Pletfix by entering the Composer's create-project command in your terminal:

    composer create-project pletfix/app --repository=https://raw.githubusercontent.com/pletfix/app/master/packages.json my-project-name

The command above create a fresh Pletfix Application in the directory you specify (here "my-project-name").

The command above creates a directory you specify (here "my-project-name") and downloads the package in this folder.

**Storage Folder**

After then, the installation procedure asks you about a file mode and group that should be used for the directories 
to be created in the storage folder.

Note, that the directories within the storage folder must be writable by your web server!

Enter "-" to skip this part. In this case you have to set the permissions after the installation procedure manually like 
this:
    
    cd storage
    chgrp www-data *
    chmod 775 *
    chmod g+s *

**Database**

In addition, you are asked if a SQLite database should be created.
If you answer yes, the migration procedure will be executed at the end of the installation.

![Screenshot - Installation started](https://raw.githubusercontent.com/pletfix/app/master/resources/docs/screenshot_screenshot_started.png)     

**Remove VCS**

At the end it will ask you "Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]?". You should answer 
with Y(es) (the default).

![Screenshot - Installation completed](https://raw.githubusercontent.com/pletfix/app/master/resources/docs/screenshot_screenshot_completed.png)     

That's all! Now the application is ready for the first request. 

Open your browser and enter the URL of the application's public folder, e.g.
    
    http://localhost/my-app/public/
    
## Customizing

### Environment

After you have installed Pletfix, modify the entries in the environment file `.env` as you need. 

Because this file typically contains sensitive data, e.g. Passwords, it must not be pushed into your repository! 
Therefore, be sure, that this file is registered in `.gitignore`.
 
### Additional Configuration

Customize the configuration files stored in `config` folder.
    
## Trouble Shooting

### Your requirements could not be resolved to an installable set of packages.
       
![Screenshot - Error Message](https://raw.githubusercontent.com/pletfix/app/master/resources/docs/screenshot_error.png)        

If you receive this error message during installation, [NPM/Bower Dependency Manager for Composer](https://github.com/fxpio/composer-asset-plugin/blob/master/Resources/doc/index.md) 
may not be installed. Note, that a **global scope installation** of this Dependency Manager is required!

## License

The Pletfix framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
 
