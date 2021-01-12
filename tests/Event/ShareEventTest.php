<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class ShareEventTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertSame([
            'name' => 'share',
            'params' => ['method' => 'Twitter', 'content_type' => 'image', 'content_id' => 'C_12345'],
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
        $event = new ShareEvent();
        $event->parameters->method = 'Twitter';
        $event->parameters->contentType = 'image';
        $event->parameters->contentId = 'C_12345';

        return [[$event]];
    }
}
