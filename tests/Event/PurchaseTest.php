<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\EventInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\EventTestCase;

final class PurchaseTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertEquals([
            'name' => 'purchase',
            'params' => [
                'affiliation' => 'Google Store',
                'coupon' => 'SUMMER_FUN',
                'currency' => 'USD',
                'transaction_id' => 'T_12345',
                'shipping' => 3.33,
                'tax' => 1.11,
                'value' => 12.21,
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
                        'tax' => 1.11,
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
        $event = new Purchase();
        $event->parameters->affiliation = 'Google Store';
        $event->parameters->coupon = 'SUMMER_FUN';
        $event->parameters->currency = 'USD';
        $event->parameters->transactionId = 'T_12345';
        $event->parameters->shipping = 3.33;
        $event->parameters->tax = 1.11;
        $event->parameters->value = 12.21;

        $item = new PurchaseItem();
        $item->itemId = 'SKU_12345';
        $item->itemName = 'jeggings';
        $item->quantity = 1;
        $item->affiliation = 'Google Store';
        $item->coupon = 'SUMMER_FUN';
        $item->discount = 2.22;
        $item->itemBrand = 'Gucci';
        $item->itemCategory = 'pants';
        $item->tax = 1.11;
        $item->price = 9.99;
        $item->currency = 'USD';

        $event->parameters->addItem($item);

        return [[$event]];
    }
}
