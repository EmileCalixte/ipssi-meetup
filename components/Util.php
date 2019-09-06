<?php

namespace app\components;

use PHPMailer\PHPMailer\PHPMailer;

class Util
{
    public static function average(...$numbers): ?float
    {
        if (count($numbers) === 0) {
            return null;
        }
        return array_sum($numbers) / count($numbers);
    }

    public static function rateAverage(...$rateValues): ?float
    {
        return round(self::average(...$rateValues), 1);
    }

    public static function getConfiguredMailerForMailhog(bool $enableExceptions = true): PHPMailer
    {
        $phpMailer = new PHPMailer($enableExceptions);

        $phpMailer->Host = 'mailhog';
        $phpMailer->isSMTP();
        $phpMailer->SMTPAuth = false;
        $phpMailer->Port = '1025';

        $phpMailer->setFrom('info@meetupmanager.com');

        return $phpMailer;
    }
}
