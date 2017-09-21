<?php

namespace Ringtrail\LaravelSns;

use Aws\Sns\SnsClient;
use Illuminate\Contracts\Broadcasting\Broadcaster;

class SnsBroadcaster implements Broadcaster
{
    /**
     * @var SnsClient
     */
    protected $client;

    public function __construct(SnsClient $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function auth($request)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function validAuthenticationResponse($request, $result)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function broadcast(array $channels, $event, array $payload = array())
    {
        $payload = ['event' => $event, 'data' => $payload];
        foreach ($channels as $channel) {
            $this->client->publish(array(
                'TopicArn' => $channel,
                'Message' => json_encode($payload),
                'Subject' => $event
            ));
        }
    }
}
