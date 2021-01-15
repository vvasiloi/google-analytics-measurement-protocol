<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

class Aggregate implements AggregateInterface
{
    /** @var string */
    protected $clientId;

    /** @var string */
    protected $userId;

    /** @var EventInterface[] */
    protected $events;

    public function __construct(string $clientId, EventInterface ...$events)
    {
        $this->clientId = $clientId;
        $this->events = $events;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function addEvent(EventInterface $event): void
    {
        $this->events[] = $event;
    }

    public function toArray(): array
    {
        $events = array_map(static function (EventInterface $event): array {
            return $event->toArray();
        }, $this->getEvents());

        $data = [
            'client_id' => $this->getClientId(),
            'events' => $events,
        ];

        if (null !== $this->getUserId()) {
            $data['user_id'] = $this->getUserId();
        }

        return $data;
    }
}
