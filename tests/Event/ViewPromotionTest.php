<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\EventInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\EventTestCase;

final class ViewPromotionTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertEquals([
            'name' => 'view_promotion',
            'params' => [
                'location_id' => 'L_12345',
                'items' => [
                    [
                        'item_id' => 'SKU_12345',
                        'item_name' => 'jeggings',
                        'quantity' => 1,
                        'promotion_id' => 'P_12345',
                        'promotion_name' => 'Summer Sale',
                        'affiliation' => 'Google Store',
                        'coupon' => 'SUMMER_FUN',
                        'creative_slot' => 'featured_app_1',
                        'discount' => 2.22,
                        'item_brand' => 'Gucci',
                        'item_category' => 'pants',
                        'location_id' => 'L_12345',
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
        $event = new ViewPromotion();
        $event->parameters->locationId = 'L_12345';

        $item = new ViewPromotionItem();
        $item->itemId = 'SKU_12345';
        $item->itemName = 'jeggings';
        $item->quantity = 1;
        $item->promotionId = 'P_12345';
        $item->promotionName = 'Summer Sale';
        $item->affiliation = 'Google Store';
        $item->coupon = 'SUMMER_FUN';
        $item->creativeSlot = 'featured_app_1';
        $item->discount = 2.22;
        $item->itemBrand = 'Gucci';
        $item->itemCategory = 'pants';
        $item->locationId = 'L_12345';
        $item->price = 9.99;
        $item->currency = 'USD';

        $event->parameters->addItem($item);

        return [[$event]];
    }
}
