<?php
require 'vendor/autoload.php';

use \Google\Cloud\PubSub\PubSubClient;

/**
 * Publishes a message for a Pub/Sub topic.
 *
 * @param string $projectId  The Google project ID.
 * @param string $topicName  The Pub/Sub topic name.
 * @param string $message  The message to publish.
 */
function publish_message($projectId, $topicName, $message)
{
    $pubsub = new PubSubClient([
        'projectId' => $projectId,
    ]);
    $topic = $pubsub->topic($topicName);
    $topic->publish(['data' => $message]);
    print('Message published' . PHP_EOL);
}


$pid = 'pringles-2'; //getenv('GOOGLE_PROJECT_ID') ?: getenv('GCLOUD_PROJECT');

$topic = 'projects/pringles-2/topics/kopet';

$msg = 'kopet is gud';
publish_message($pid,$topic,$msg);