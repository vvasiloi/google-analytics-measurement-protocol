<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class ViewItemListEventTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertSame([
            'name' => 'view_item_list',
            'params' => [
                'item_list_name' => 'Related products',
                'item_list_id' => 'related_products',
                'items' => [['item_id' => 'SKU_12345']],
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
        $event = new ViewItemListEvent();
        $event->parameters->itemListName = 'Related products';
        $event->parameters->itemListId = 'related_products';

        $item = new GenericItemEventParameters();
        $item->itemId = 'SKU_12345';

        $event->parameters->addItem($item);

        return [[$event]];
    }
}
