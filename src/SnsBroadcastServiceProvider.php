<?php namespace Ringtrail\LaravelSns;

use Aws\Sns\SnsClient;
use Illuminate\Support\ServiceProvider;

class SnsBroadcastServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->app->make('Illuminate\Broadcasting\BroadcastManager')->extend('sns', function ($app, $config) {

			return new SnsBroadcaster(SnsClient::factory(array(
				'credentials' => array(
					'key'    => $config['aws_key'],
					'secret' => $config['aws_secret'],
				),
				'version' => 'latest',
				'region' => $config['aws_region']
			)));
		});
	}

	public function register()
	{

	}
}