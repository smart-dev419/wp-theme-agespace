<?php
define('WP_USE_THEMES', true);

require  '/home/hakunamatata/public_html/agespace/wp-load.php';

require 'vendor/autoload.php';
use Mailgun\Mailgun;

use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Hydrator\NoopHydrator;

$domain1 = "http://bin.mailgun.net/8af4c0ab";
$domain="sandbox8ce4abbb0f2244e19f5b3cc4db56a627.mailgun.org";
$api='90ada5d7b6818ba594bd1f03aa93f9eb-dc5f81da-749c731b';



$configurator = new HttpClientConfigurator();
$configurator->setEndpoint('http://bin.mailgun.net/8af4c0ab');
$configurator->setApiKey($api);
$configurator->setDebug(true);

$mg = new Mailgun($configurator, new NoopHydrator());


# Now, compose and send your message.
$result=$mg->messages()->send($domain, [
  'from'    => 'noreply@agespace.org', 
  'to'      => 'amindiary@gmail.com', 
  'subject' => 'The PHP SDK is awesome!', 
  'text'    => 'It is so simple to send a message.'
]);

var_dump($result);