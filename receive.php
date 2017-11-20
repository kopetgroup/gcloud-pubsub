<?php
require 'vendor/autoload.php';

use \Google\Cloud\PubSub\PubSubClient;

/**
 * Pulls all Pub/Sub messages for a subscription.
 *
 * @param string $projectId  The Google project ID.
 * @param string $subscriptionName  The Pub/Sub subscription name.
 */
function pull_messages($projectId, $subscriptionName)
{
    $pubsub = new PubSubClient([
        'projectId' => $projectId,
    ]);
    $subscription = $pubsub->subscription($subscriptionName);
    foreach ($subscription->pull() as $message) {
        printf('Message: %s' . PHP_EOL, $message->data());
        // Acknowledge the Pub/Sub message has been received, so it will not be pulled multiple times.
        $subscription->acknowledge($message);
    }
}


$pid = 'pringles-2'; //getenv('GOOGLE_PROJECT_ID') ?: getenv('GCLOUD_PROJECT');

$topic = 'projects/pringles-2/topics/kopet';
$subscription = 'projects/pringles-2/subscriptions/oke';

pull_messages($pid,$subscription);