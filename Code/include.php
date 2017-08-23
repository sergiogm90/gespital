<?php

$Directory = new RecursiveDirectoryIterator(dirname(__FILE__).'/libs/');
$Iterator = new RecursiveIteratorIterator($Directory);
$Regex = new RegexIterator($Iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
foreach($Regex as $key => $item)
    require_once $key;

$Directory = new RecursiveDirectoryIterator(dirname(__FILE__));
$Iterator = new RecursiveIteratorIterator($Directory);
$Regex = new RegexIterator($Iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
foreach($Regex as $key => $item)
    if (!contains('index', $key) && !contains('include', $key) && !contains('vista', $key))
        require_once $key;