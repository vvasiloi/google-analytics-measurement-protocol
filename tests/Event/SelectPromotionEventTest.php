<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class SelectPromotionEventTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertSame([
            'name' => 'select_promotion',
            'params' => ['location_id' => 'L_12345', 'items' => [['item_id' => 'SKU_12345']]],
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
        $event = new SelectPromotionEvent();
        $event->parameters->locationId = 'L_12345';

        $item = new GenericItemEventParameters();
        $item->itemId = 'SKU_12345';

        $event->parameters->addItem($item);

        return [[$event]];
    }
}
