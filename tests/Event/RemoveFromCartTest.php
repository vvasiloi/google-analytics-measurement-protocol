<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\EventInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\EventTestCase;

final class RemoveFromCartTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertEquals([
            'name' => 'remove_from_cart',
            'params' => [
                'currency' => 'USD',
                'value' => 7.77,
                'items' => [
                    [
                        'item_id' => 'SKU_12345',
                        'item_name' => 'jeggings',
                        'quantity' => 1,
                        'affiliation' => 'Google Store',
                        'coupon' => 'SUMMER_FUN',
                        'discount' => 2.22,
                        'item_brand' => 'Gucci',
                        'item_category' => 'pants',
                        'price' => 9.99,
                        'currency' => 'USD',
                    ],
                ],
            ],
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
        $event = new RemoveFromCart();
        $event->parameters->currency = 'USD';
        $event->parameters->value = 7.77;

        $item = new RemoveFromCartItem();
        $item->itemId = 'SKU_12345';
        $item->itemName = 'jeggings';
        $item->quantity = 1;
        $item->affiliation = 'Google Store';
        $item->coupon = 'SUMMER_FUN';
        $item->discount = 2.22;
        $item->itemBrand = 'Gucci';
        $item->itemCategory = 'pants';
        $item->price = 9.99;
        $item->currency = 'USD';

        $event->parameters->addItem($item);

        return [[$event]];
    }
}