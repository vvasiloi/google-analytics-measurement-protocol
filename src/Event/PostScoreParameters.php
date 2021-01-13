<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class PostScoreParameters extends Parameters
{
    /**
     * @var int
     * The score to post.
     * Required: Yes
     * Example: 10000
     */
    public $score;

    /**
     * @var int
     * The level for the score.
     * Required: No
     * Example: 5
     */
    public $level;

    /**
     * @var string
     * The character that achieved the score.
     * Required: No
     * Example: Player 1
     */
    public $character;
}
