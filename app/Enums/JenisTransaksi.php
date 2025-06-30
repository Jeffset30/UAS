<?php

namespace App\Enums;

enum JenisTransaksi: string
{
    case Debit = 'debit';
    case Kredit = 'kredit';

    public static function toSelectArray(): array
    {
        return [
            self::Debit->value => 'Debit',
            self::Kredit->value => 'Kredit',
        ];
    }
}
