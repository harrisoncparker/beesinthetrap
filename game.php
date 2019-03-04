#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 11:35
 */

use Symfony\Component\Console\Application;
use Game\Commands\NewGameCommand;
use Game\Commands\HitCommand;
use Game\Commands\ExitCommand;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application();

$app->add(new NewGameCommand());
$app->add(new HitCommand());
$app->add(new ExitCommand());

$app->run();