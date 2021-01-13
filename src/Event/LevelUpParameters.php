<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class LevelUpParameters extends Parameters
{
    /**
     * @var int
     * The level of the character.
     * Required: No
     * Example: 5
     */
    public $level;

    /**
     * @var string
     * The character that leveled up.
     * Required: No
     * Example: Player 1
     */
    public $character;
}
