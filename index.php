<?php

declare(strict_types = 1);

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

require_once 'vendor/autoload.php';
require 'buttons.html';
require 'vendor/monolog/monolog/src/Monolog/Handler/NativeMailerHandler.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\NativeMailerHandler;

// create a log channel
$log = new Logger('LogMessage1');
$log->pushHandler(new StreamHandler('logs/warning.log', Logger::WARNING)); // links to Logger.php

$log = new Logger('LogMessage2');
$log->pushHandler(new StreamHandler('logs/danger.log', Logger::EMERGENCY));

$log = new Logger('LogMessage3');
$log->pushHandler(new StreamHandler('logs/emergency.log', Logger::ERROR));

// link with buttons.html
$buttonName = $_GET['type'];
$inputMessage = $_GET['message'];

// add records to the log
$log->warning('testtest');
$log->emergency($inputMessage);
$log->error($inputMessage);



