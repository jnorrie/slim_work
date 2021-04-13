<?php
require 'vendor/autoload.php';
require 'bootstrap.php';

use Chatter\Models\Message;

$app = new \Slim\App();

$app->get('/', function($request, $response, $next){
	return $response->write('Hi. Welcome to my SLIM API');
});

$app->get('/messages', function($request, $response, $next){
							$message = new Message();
							$messages = $message->all();
							$payload = [];
							foreach ($messages as $msg){
								$payload[$msg->id] = [	'body' => $msg->body,
														'user_id' => $msg->user_id,
														'created_at' => $msg->created_at
								];
							}
							return $response->withStatus(200)->withJSON($payload);
						}
		);

$app->get('/message/{id}', function($request, $response, $args){
							$message = new Message();
							$msg = $message->find($args['id']);
							
							$payload[$msg->id] = [	'body' => $msg->body,
													'user_id' => $msg->user_id,
													'created_at' => $msg->created_at ];
							
							return $response->withStatus(200)->withJSON($payload);
						}
		);


$app->run();