<?php

namespace App\Support;

class Level
{
    public const BEGINNER = 'beginner';

    public const PRO = 'pro';

    public const EXPERT = 'expert';

    public const THRESHOLDS = [
        self::EXPERT => 300,
        self::PRO => 150,
        self::BEGINNER => 0,
    ];

    public static function forScore(int $totalScore): string
    {
        return match (true) {
            $totalScore >= self::THRESHOLDS[self::EXPERT] => self::EXPERT,
            $totalScore >= self::THRESHOLDS[self::PRO] => self::PRO,
            default => self::BEGINNER,
        };
    }

    public static function unlocksDifficulty(string $level, string $difficulty): bool
    {
        return match ($difficulty) {
            'easy' => true,
            'medium' => in_array($level, [self::PRO, self::EXPERT], true),
            'hard' => $level === self::EXPERT,
            default => true,
        };
    }

    public static function label(string $level): string
    {
        return match ($level) {
            self::PRO => 'Pro',
            self::EXPERT => 'Expert',
            default => 'Beginner',
        };
    }
}
