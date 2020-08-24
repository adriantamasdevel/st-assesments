<?php

require 'vendor/autoload.php';

use Shiptheory\Storage\DB;
use Shiptheory\Bee;

$DB = new DB('store');

$bees = $DB->load();

if(empty($bees)) {
    $bees[1] = new Bee\Queen();

    $bees[2] = new Bee\Drone();
    $bees[3] = new Bee\Drone();
    $bees[4] = new Bee\Drone();

    $bees[5] = new Bee\Worker();
    $bees[6] = new Bee\Worker();
    $bees[7] = new Bee\Worker();
    $bees[8] = new Bee\Worker();
    $bees[9] = new Bee\Worker();
    $bees[10] = new Bee\Worker();
    
    $DB->save($bees);
}


$bees[1]->damage(20);

$DB->save($bees);

dump($bees);
