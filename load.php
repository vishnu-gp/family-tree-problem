<?php

foreach (glob( "src" . DIRECTORY_SEPARATOR . "*.php") as $filename)
{
    require_once $filename;
}