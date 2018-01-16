<?php

namespace App\Handlers;

use /** @noinspection PhpUndefinedClassInspection, PhpUndefinedNamespaceInspection */ Composer\Script\Event;
use Exception;

/**
 * Class ComposerHandler
 *
 * This class is used for the installation procedure.
 *
 * You can execute the scripts manually. E.g. enter this into your terminal to run the `post-root-package-install` event:
 *
 *      composer run-script post-root-package-install
 *
 * Set the `--no-interaction` flag to do not ask any interactive question:
 *
 *      composer run-script post-root-package-install --no-interaction
 *
 * @see https://getcomposer.org/doc/03-cli.md Composer CLI
 * @see https://getcomposer.org/doc/articles/scripts.md Composer Scripts
 * @see https://getcomposer.org/apidoc/master/Composer/Script/Event.html Composer API - Event
 * @see https://getcomposer.org/apidoc/master/Composer/IO/IOInterface.html Composer API - IOInterface
 */
class ComposerHandler
{
    /** @noinspection PhpUndefinedClassInspection */
    /**
     * Handle the post-root-package-install Composer event.
     *
     * Occurs after the root package has been installed, during the create-project command.
     *
     * @param Event $event
     */
    public static function postRootPackageInstall(/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        self::createEnvironmentFile($event);
        self::createStorageFolder($event);
        self::createDatabase($event);
    }

    /** @noinspection PhpUndefinedClassInspection */
    /**
     * Handle the post-create-project-cmd Composer event.
     *
     * Occurs after the create-project command has been executed.
     *
     * @param Event $event
     */
    public static function postCreateProjectCmd(/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        /** @noinspection PhpUndefinedMethodInspection, PhpIncludeInspection */
        //require_once $event->getComposer()->getConfig()->get('vendor-dir') . '/autoload.php';

        self::copyConfig($event);
        self::migrateDatabase($event);

        /** @noinspection PhpUndefinedMethodInspection */
        $event->getIO()->write('Installation completed.');
    }

    /** @noinspection PhpUndefinedClassInspection */
    /**
     * Create the database.
     *
     * @param Event $event
     */
    private static function createEnvironmentFile(/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        if (file_exists('.env')) {
            return;
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $io = $event->getIO();

        if (file_exists('.env.example')) {
            copy('.env.example', '.env');
        }
        else {
            file_put_contents('.env', 'APP_ENV=local' . PHP_EOL, LOCK_EX);
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $io->write('Environment file created.');
    }

    /** @noinspection PhpUndefinedClassInspection */
    /**
     * Create the storage folder
     *
     * @param Event $event
     */
    private static function createStorageFolder(/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $io = $event->getIO();

        /** @noinspection PhpUndefinedMethodInspection */
        $io->write('Create storage folder...');
        if (!file_exists('storage')) {
            mkdir('storage');
        }

        if (strtolower(substr(PHP_OS, 0, 3)) == 'win') {
            $mode  = '-'; // mode and group do not exist on Windows
            $group = '-';
        }
        else {
            /** @noinspection PhpUndefinedMethodInspection */
            $io->write('Enter the file mode and group for the directories created in the storage folder.');
            /** @noinspection PhpUndefinedMethodInspection */
            $io->write('Note, that the directories within the storage folder must be writable by your web server!');
            /** @noinspection PhpUndefinedMethodInspection */
            $io->write('Enter "-" to skip this part. In this case you have to set the permissions after the installation procedure manually.');

            /** @noinspection PhpUndefinedMethodInspection */
            $mode = $io->askAndValidate('File mode? [2775]:> ', function ($mode) {
                if ($mode == '-') {
                    return $mode;
                }
                if (!preg_match('/^([0-7])?[0-7][0-7][0-7]$/', $mode, $matches)) {
                    throw new Exception(sprintf('Mode "%s" is invalid. The mode consists of three or four octal digits (0..7).', $mode));
                }
                return $mode;
            }, null, '2775');

            if ($mode != '-') {
                $mode = intval($mode, 8);
            }

            $group = 'www-data';

            /** @noinspection PhpUndefinedMethodInspection */
            $group = $io->ask('File group? [' . $group . ']:> ', $group);
        }

        foreach (['cache', 'db', 'logs', 'sessions', 'temp', 'upload'] as $folder) {
            $path = 'storage/' . $folder;
            if (!file_exists($path)) {
                mkdir($path);
            }
            if ($mode != '-') {
                @chmod($path, $mode);
            }
            if ($group != '-') {
                @chgrp($path, $group);
            }
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $io->write('Storage folder created.');
    }

    /** @noinspection PhpUndefinedClassInspection */
    /**
     * Create the database
     *
     * @param Event $event
     */
    private static function createDatabase(/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        if (file_exists('storage/db/sqlite.db')) {
            return;
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $io = $event->getIO();

        /** @noinspection PhpUndefinedMethodInspection */
        if ($io->askConfirmation('Create a SQLite database? (y/n) [y]')) {
            touch('storage/db/sqlite.db');
            /** @noinspection PhpUndefinedMethodInspection */
            $io->write('Database created.');
        }
    }

    /** @noinspection PhpUndefinedClassInspection */
    /**
     * Copy the config files from the core.
     *
     * @param Event $event
     */
    private static function copyConfig(/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $io = $event->getIO();

        if (!file_exists('config')) {
            mkdir('config');
        }

        foreach (scandir('vendor/pletfix/core/config') as $file) {
            if ($file[0] == '.' || is_dir('vendor/pletfix/core/config/' . $file)) {
                continue;
            }
            if (!file_exists('config/' . $file)) {
                copy('vendor/pletfix/core/config/' . $file, 'config/' . $file);
            }
        }

        if (!file_exists('boot')) {
            mkdir('boot');
        }

        foreach (scandir('vendor/pletfix/core/boot') as $file) {
            if ($file[0] == '.' || is_dir('vendor/pletfix/core/boot/' . $file)) {
                continue;
            }
            if (!file_exists('boot/' . $file)) {
                copy('vendor/pletfix/core/boot/' . $file, 'boot/' . $file);
            }
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $io->write('Configuration files created.');
    }

    /** @noinspection PhpUndefinedClassInspection */
    /**
     * Create the database
     *
     * @param Event $event
     */
    private static function migrateDatabase(/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        if (!file_exists('storage/db/sqlite.db')) {
            return;
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $io = $event->getIO();

        /** @noinspection PhpUndefinedMethodInspection */
        $io->write('Migrate the database...');

        system('php console migrate');
    }
}