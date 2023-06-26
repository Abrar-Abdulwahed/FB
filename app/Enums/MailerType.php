<?php
namespace App\Enums;

enum MailerType: string
{
    case SMTP = 'smtp';
    case SENDMAIL = 'sendmail';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}