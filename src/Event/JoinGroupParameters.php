<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class JoinGroupParameters extends Parameters
{
    /**
     * @var string
     * The ID of the group.
     * Required: No
     * Example: G_12345
     */
    public $groupId;
}
