<?php

foreach (glob(dirname( dirname(__FILE__)) . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "*.php") as $filename)
{
    require_once $filename;
}