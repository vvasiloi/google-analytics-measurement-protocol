<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class UnlockAchievementEventParameters extends EventParameters
{
    /**
     * @var string
     * The id of the achievement that was unlocked.
     * Required: Yes
     * Example: A_12345
     */
    public $achievementId;
}
