<?php

namespace App\Handler;

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
    /*
     * Styles.
     *
     * Based on the `ANSI/VT100 Terminal Control reference` at <http://www.termsys.demon.co.uk/vtansi.htm>.
     * @see https://github.com/auraphp/Aura.Cli/blob/2.x/src/Stdio/Formatter.php
     * @see https://www.if-not-true-then-false.com/2010/php-class-for-coloring-php-command-line-cli-scripts-output-php-output-colorizing-using-bash-shell-colors/
     * @see https://github.com/cakephp/cakephp/blob/3.next/src/Console/ConsoleOutput.php
     */
    //const STYLE_RESET    = 0;
    const STYLE_BOLD       = 1;
    const STYLE_DIM        = 2;
    const STYLE_UL         = 4;
    const STYLE_BLINK      = 5;
    const STYLE_REVERSE    = 7;
    const STYLE_BLACK      = 30;
    const STYLE_RED        = 31;
    const STYLE_GREEN      = 32;
    const STYLE_YELLOW     = 33;
    const STYLE_BLUE       = 34;
    const STYLE_MAGENTA    = 35;
    const STYLE_CYAN       = 36;
    const STYLE_WHITE      = 37;
    const STYLE_BLACK_BG   = 40;
    const STYLE_RED_BG     = 41;
    const STYLE_GREEN_BG   = 42;
    const STYLE_YELLOW_BG  = 43;
    const STYLE_BLUE_BG    = 44;
    const STYLE_MAGENTA_BG = 45;
    const STYLE_CYAN_BG    = 46;
    const STYLE_WHITE_BG   = 47;

    /** @noinspection PhpUndefinedClassInspection */
    /**
     * @var Event
     */
    private $event;

    public function __construct (/** @noinspection PhpUndefinedClassInspection */ Event $event)
    {
        $this->event = $event;
    }

    /**
     * Format text.
     *
     * @param string $text The message
     * @param array $styles Combination of Stdio::STYLE constants
     * @return string
     */
    private function format($text, array $styles = [])
    {
        /** @noinspection PhpUndefinedMethodInspection */
        if (!$this->event->getIO()->isDecorated()) {
            return $text;
        }

        return "\033[" . implode(';', $styles) . "m" . $text . "\033[0m";
    }

    /**
     * Writes a message in white to the output.
     *
     * @param string $message
     */
    protected function write($message)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->event->getIO()->write($message);
    }

    /**
     * Writes a message in yellow to the output.
     *
     * @param string $message
     */
    protected function writeHint($message)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->event->getIO()->write($this->format($message, [self::STYLE_YELLOW]));
    }

    /**
     * Writes a message in green to the output.
     *
     * @param string $message
     */
    protected function writeInfo($message)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->event->getIO()->write($this->format($message, [self::STYLE_GREEN]));
    }

    /**
     * Asks a question to the user.
     *
     * @param string $question The question to ask.
     * @param string $default The default answer if none is given by the user.
     * @return string
     */
    protected function ask($question, $default = null)
    {
        $prompt = $this->format($question, [self::STYLE_GREEN]);
        if ($default !== null) {
            $prompt .= ' [' . $this->format($default, [self::STYLE_YELLOW]) . ']';
        }
        $prompt .= ':' . PHP_EOL . '> ';

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->event->getIO()->ask($prompt, $default);
    }

    /**
     * Asks for a value and validates the response.
     *
     * The validator receives the data to validate. It must return the validated data when the data is valid and throw
     * an exception otherwise.
     *
     * @param string $question The question to ask.
     * @param callable $validator A PHP callback.
     * @param mixed $default The default answer if none is given by the user.
     * @return mixed
     */
    protected function askAndValidate($question, callable $validator, $default = null)
    {
        $prompt = $this->format($question, [self::STYLE_GREEN]);
        if ($default !== null) {
            $prompt .= ' [' . $this->format($default, [self::STYLE_YELLOW]) . ']';
        }
        $prompt .= ':' . PHP_EOL . '> ';

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->event->getIO()->askAndValidate($prompt, $validator, null, $default);
    }

    /**
     * Asks a confirmation to the user.
     *
     * The question will be asked until the user answers by nothing, yes, or no.
     *
     * @param string $question The question to ask.
     * @param bool $default The default answer if none is given by the user.
     * @return bool
     */
    protected function askConfirmation($question, $default = true)
    {
        $prompt = $this->format($question . ' (yes/no)', [self::STYLE_GREEN])
            . ' [' . $this->format($default, [self::STYLE_YELLOW]) . ']'
            . ':' . PHP_EOL . '> ';

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->event->getIO()->askConfirmation($prompt, $default);
    }

    /**
     * Asks the user to select a value.
     *
     * @param string $question The question to ask.
     * @param string|null $default The default answer if none is given by the user.
     * @return string
     */
    protected function select($question, array $choices, $default = null)
    {
        $prompt = $this->format($question, [self::STYLE_GREEN]);
        if ($default !== null) {
            $prompt .= ' [' . $this->format($default, [self::STYLE_YELLOW]) . ']';
        }

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->event->getIO()->select($prompt, $choices, $default);
    }

    /**
     * Include the composer autoload file.
     */
    protected function autoload()
    {
        /** @noinspection PhpUndefinedMethodInspection, PhpIncludeInspection */
        require_once $this->event->getComposer()->getConfig()->get('vendor-dir') . '/autoload.php';
    }

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
        $handler = new static($event);
        $handler->createEnvironmentFile();
        $handler->createStorageFolder();
        $handler->createDatabase();
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
        $handler = new static($event);
        $handler->migrateDatabase();
    }

    /**
     * Create the database
     */
    private function createEnvironmentFile()
    {
        if (file_exists('.env')) {
            return;
        }

        if (copy('.env.example', '.env')) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->write('Environment file created.');
        }
    }

    /**
     * Create the storage folder
     */
    private function createStorageFolder()
    {
        $this->write('Create storage folder...');

        $this->writeHint('Enter the file mode and group for the directories that are created in the storage folder.');
        $this->writeHint('Note, that the directories within the storage folder must be writable by your web server!');
        $this->writeHint('Enter "-" to skip this part. In this case you have to set the permission after the installation procedure manually.');

        if (!file_exists('storage')) {
            mkdir('storage');
        }

        $mode = $this->askAndValidate('File mode?', function ($mode) {
            if ($mode == '-') {
                return $mode;
            }
            if (!preg_match('/^([0-7])?[0-7][0-7][0-7]$/', $mode, $matches)) {
                throw new Exception(sprintf('Mode "%s" is invalid. The mode consists of three or four octal digits (0..7).', $mode));
            }
            return $mode;
        }, '2775');

        if ($mode != '-') {
            $mode = intval($mode, 8);
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $group = $this->ask('File group?', 'www-data');

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
        $this->write('Storage folder successfully created.');
    }

    /**
     * Create the database
     */
    private function createDatabase()
    {
        if (file_exists('storage/db/sqlite.db')) {
            return;
        }

        if ($this->askConfirmation('Create a SQLite database?')) {
            if (touch('storage/db/sqlite.db')) {
                $this->write('Database successfully created.');
            }
        }
    }

    /**
     * Create the database
     */
    private function migrateDatabase()
    {
        if (!file_exists('storage/db/sqlite.db')) {
            return;
        }

        $this->write('Migrate the database...');

        system('php console migrate');
    }
}