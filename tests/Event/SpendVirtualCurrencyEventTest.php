<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class SpendVirtualCurrencyEventTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertSame([
            'name' => 'spend_virtual_currency',
            'params' => ['item_name' => 'Starter Boost', 'virtual_currency_name' => 'Gems', 'value' => 5],
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
        $event = new SpendVirtualCurrencyEvent();
        $event->parameters->itemName = 'Starter Boost';
        $event->parameters->virtualCurrencyName = 'Gems';
        $event->parameters->value = 5;

        return [[$event]];
    }
}
