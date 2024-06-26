<?php

namespace App\Enums;

enum AnimalAction
{
    case EAT;
    case STROLL;
    case SLEEP;
    // case RUN;

    public function value(): string
    {
        return match ($this) {
            self::EAT => 'Comer',
            self::STROLL => 'Passear',
            self::SLEEP => 'Dormir',
            // self::RUN => 'Correr',
        };
    }

    public function action(): string
    {
        return match ($this) {
            self::EAT => 'está comendo',
            self::STROLL => 'está passeando',
            self::SLEEP => 'está dormindo',
            // self::RUN => 'está correndo',
        };
    }
}
