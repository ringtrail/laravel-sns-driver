<?php namespace Ringtrail\LaravelSns;

use Aws\Sns\SnsClient;
use \Illuminate\Contracts\Broadcasting\Broadcaster;

class SnsBroadcaster implements Broadcaster
{
	protected $client;

	public function __construct(SnsClient $client)
	{
		$this->client = $client;
	}

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