<?php

namespace shop\helpers;

class PriceHelper
{
    public static function format($price): string
    {
        if ($price !== null) {
            return number_format($price, 2, '.', ' ');
        }

        return 0;
    }
} 