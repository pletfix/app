<?php

namespace App\Handler;

use /** @noinspection PhpUndefinedClassInspection, PhpUndefinedNamespaceInspection */ Composer\Script\Event;
use Exception;

/**
 * Class ComposerHandler
 *
 * This class is entered in the `composer.json` file.
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
        /** @noinspection PhpUndefinedMethodInspection */
        $io = $event->getIO();

        if (!file_exists('.env')) {
            /** @noinspection PhpUndefinedMethodInspection */
            $io->write('Create environment file...');
            if (copy('.env.example', '.env')) {
                /** @noinspection PhpUndefinedMethodInspection */
                $io->write('Environment file successfully created.');
            }
        }
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
        self::autoload($event);

        /** @noinspection PhpUndefinedMethodInspection */
        $io = $event->getIO();

        /** @noinspection PhpUndefinedMethodInspection */
        $io->write('Create storage folder...');
        if (!file_exists('storage')) {
            mkdir('storage');
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $mode = $io->askAndValidate('File mode for files created in the storage folder? Enter "-" to skip. [2775]', function($mode) {
            if ($mode == '-') {
                return $mode;
            }
            if (!preg_match('/^([0-7])?[0-7][0-7][0-7]$/', $mode, $matches)) {
                throw new Exception(sprintf('Mode "%s" is invalid. The mode consists of three or four octal digits (0..7).', $mode));
            }
            return intval($mode, 8);
        }, null, 02775);

        /** @noinspection PhpUndefinedMethodInspection */
        $group = $io->ask('File group for files created in the storage folder? Enter "-" to skip. [www-data]', 'www-data');

        foreach (['cache', 'logs', 'db'] as $folder) {
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
        $io->write('Storage folder successfully created.');

        /** @noinspection PhpUndefinedMethodInspection */
        if ($io->askConfirmation('Create a SQLite database (y/n)? [y]')) {
            if (!file_exists('storage/db/sqlite.db')) {
                touch('storage/db/sqlite.db');
            }
            /** @noinspection PhpUndefinedMethodInspection */
            $io->write('Migrate the database...');
            system('php console migrate');
        }
    }

    /** @noinspection PhpUndefinedClassInspection */
    /**
     * Handle the post-create-project-cmd Composer event.
     *
     * Occurs after the root package has been installed, during the create-project command.
     *
     * @param Event $event
     */
    private static function autoload(/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        /** @noinspection PhpUndefinedMethodInspection, PhpIncludeInspection */
        require_once $event->getComposer()->getConfig()->get('vendor-dir') . '/autoload.php';
    }
}