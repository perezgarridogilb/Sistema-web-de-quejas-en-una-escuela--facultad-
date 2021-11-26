<?php

function truncate($text)
{

    //specify number fo characters to shorten by
    $chars = 25;

    $text = $text . " ";
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text . "...";
    return $text;
}
