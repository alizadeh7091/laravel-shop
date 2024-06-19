<?php

namespace App\Enums;

enum DiscountStatus: string
{
    case Active = 'active';
    case Expired = 'expired';
}
