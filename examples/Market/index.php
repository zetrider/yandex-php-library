<?php
require_once 'config.php';
require_once dirname(__FILE__) . '/../../vendor/autoload.php';
use Yandex\Market\MarketClient;

$market = new MarketClient($token);
$market->setClientId($clientId);
$market->setLogin($login);

$campaigns = $market->getCampaigns();
echo '<pre>';
print_r($campaigns);
echo '</pre>';

$params = array(
    'status' => null,
    'fromDate' => null,
    'toDate' => null,
    'pageSize' => 50,
    'page' => 1
);
$campaignId = $campaigns[0]['id'];
$market->setCampaignId($campaignId);
$orders = $market->getOrders($params);
echo '<pre>';
print_r($orders);
echo '</pre>';


