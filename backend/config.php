<?php

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->host = '127.0.0.1';
$CFG->databaseName = 'desafio_leo';
$CFG->username = 'root';
$CFG->password = 'rsubuntu';

$CFG->path = 'http://localhost/desafio_leo/';
$CFG->backPath = $CFG->path. 'backend/';
$CFG->frontPath = $CFG->path. 'frontend/';
$CFG->imagesPath = $CFG->backPath . 'images';
