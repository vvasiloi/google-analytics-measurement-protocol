<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use PHPUnit\Framework\TestCase;

final class ViewCartEventTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_array(): void
    {
        $event = new ViewCartEvent();
        $event->parameters->currency = 'USD';
        $event->parameters->value = 7.77;

        $item = new GenericItemEventParameters();
        $item->itemId = 'SKU_12345';

        $event->parameters->addItem($item);

        self::assertSame([
            'name' => 'view_cart',
            'params' => ['currency' => 'USD', 'value' => 7.77, 'items' => [['item_id' => 'SKU_12345']]],
        ], $event->toArray());
    }
}