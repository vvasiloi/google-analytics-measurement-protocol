<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class RemoveFromCartEventTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertSame([
            'name' => 'remove_from_cart',
            'params' => ['currency' => 'USD', 'value' => 7.77, 'items' => [['item_id' => 'SKU_12345']]],
        ], $event->toArray());
    }

    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_yields_a_valid_request(EventInterface $event): void
    {
        $this->assertValidRequest($event);
    }

    public function exampleEventProvider(): iterable
    {
        $event = new RemoveFromCartEvent();
        $event->parameters->currency = 'USD';
        $event->parameters->value = 7.77;

        $item = new GenericItemEventParameters();
        $item->itemId = 'SKU_12345';

        $event->parameters->addItem($item);

        return [[$event]];
    }
}
