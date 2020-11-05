<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/* Must-haves-features
Use the buttons.html page to submit log messages and write the message in a log file.
Write each color of buttons to a different file:

info: info.log and send the messages to browser console using BrowserConsoleHandler
warning: warning.log
danger: warning.log and email these messages using NativeMailerHandler
dark: emergency.log and email these messages using NativeMailerHandler
*/

require 'buttons.html';
require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\BrowserConsoleHandler;

// link with buttons.html
$buttonName = $_GET['type'];
$inputMessage = $_GET['message'];

// create and add log message in logs folder
switch ($buttonName) {
    case 'DEBUG': // 100
        $log = new Logger('DEBUG');
        $log->pushHandler(new StreamHandler(__DIR__ . '/Logs/debug.log', Logger::DEBUG)); // links to Logger.php
        $log->pushHandler(new BrowserConsoleHandler());
        $log->debug($inputMessage);
        break;

    case 'INFO': // 200
        $log = new Logger('INFO');
        $log->pushHandler(new StreamHandler(__DIR__ . '/Logs/info.log', Logger::INFO));
        $log->info($inputMessage);
        break;

    case 'NOTICE': // 250
        $log = new Logger('NOTICE');
        $log->pushHandler(new StreamHandler(__DIR__ . '/Logs/notice.log', Logger::NOTICE));
        $log->notice($inputMessage);
        break;

    case 'WARNING': // 300
        $log = new Logger('WARNING');
        $log->pushHandler(new StreamHandler(__DIR__ . '/Logs/warning.log', Logger::WARNING));
        $log->warning($inputMessage);
        break;

    case 'ERROR': // 400
        $log = new Logger('ERROR');
        $log->pushHandler(new StreamHandler(__DIR__ . '/Logs/error.log', Logger::ERROR));
        $log->error($inputMessage);
        break;

    case 'CRITICAL': // 500
        $log = new Logger('CRITICAL');
        $log->pushHandler(new StreamHandler(__DIR__ . '/Logs/critical.log', Logger::CRITICAL));
        $log->critical($inputMessage);
        break;

    case 'ALERT': // 550
        $log = new Logger('ALERT');
        $log->pushHandler(new StreamHandler(__DIR__ . '/Logs/alert.log', Logger::ALERT));
        $log->alert($inputMessage);
        break;

    case 'EMERGENCY': // 600
        $log = new Logger('EMERGENCY');
        $log->pushHandler(new StreamHandler(__DIR__ . '/Logs/emergency.log', Logger::EMERGENCY));
        $log->alert($inputMessage);
        break;
}


