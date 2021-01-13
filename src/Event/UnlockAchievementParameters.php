<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class UnlockAchievementParameters extends Parameters
{
    /**
     * @var string
     * The id of the achievement that was unlocked.
     * Required: Yes
     * Example: A_12345
     */
    public $achievementId;
}
