<?php

use Zxing\Result;

function indo_currency($nominal)
{
    $result = "Rp " . number_format($nominal, 2, ',', '.');
    return $result;
}
