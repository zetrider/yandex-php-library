<?php
/**
 * @namespace
 */
namespace Yandex\Tests\Market\Partner;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use Yandex\Market\Partner\Models\Item;
use Yandex\Market\Partner\Models\Order;
use Yandex\Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: kuzmenko
 * Date: 11.08.16
 * Time: 15:45
 */
class PartnerClientTest extends TestCase
{
    protected $fixturesFolder = 'fixtures';

    function testGetCampaigns()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-campaigns.json');
        $campaignsJson = json_decode($json, true);

        $response = new Response(200, [], \GuzzleHttp\Psr7\stream_for($json));
        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['sendRequest']);
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        /** @var \Yandex\Market\Partner\Models\Campaigns $campaignsResp */
        $campaignsResp = $marketPartnerMock->getCampaigns()->getAll();
        foreach ($campaignsJson['campaigns'] as $k => $campaignJson) {
            $this->assertEquals($campaignJson['id'], $campaignsResp[$k]->getId());
            $this->assertEquals($campaignJson['domain'], $campaignsResp[$k]->getDomain());
            $this->assertEquals($campaignJson['state'], $campaignsResp[$k]->getState());
            if (isset($campaignJson['stateReasons'])) {
                foreach ($campaignJson['stateReasons'] as $key => $stateReason) {
                    $this->assertEquals($stateReason, $campaignsResp[$k]->getStateReasons()[$key]);
                }
            }
        }
    }

    function testGetOrders()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-orders.json');
        $ordersJson = json_decode($json);

        $response = new Response(200, [], \GuzzleHttp\Psr7\stream_for($json));
        $marketPartnerMock = $this->getMock('Yandex\Market\Partner\PartnerClient', ['sendRequest']);
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        /** @var \Yandex\Market\Partner\Models\Campaigns $campaignsResp */
        $campaignsResp = $marketPartnerMock->getOrders()->getAll();

        $this->assertEquals($ordersJson->orders[0]->id, $campaignsResp[0]->getId());
        $this->assertEquals($ordersJson->orders[0]->creationDate, $campaignsResp[0]->getcreationDate());
        $this->assertEquals($ordersJson->orders[0]->currency, $campaignsResp[0]->getCurrency());
        $this->assertEquals($ordersJson->orders[0]->fake, $campaignsResp[0]->getFake());
        $this->assertEquals($ordersJson->orders[0]->itemsTotal, $campaignsResp[0]->getItemsTotal());
        $this->assertEquals($ordersJson->orders[0]->paymentType, $campaignsResp[0]->getPaymentType());
        $this->assertEquals($ordersJson->orders[0]->paymentMethod, $campaignsResp[0]->getPaymentMethod());
        $this->assertEquals($ordersJson->orders[0]->status, $campaignsResp[0]->getStatus());
        $this->assertEquals($ordersJson->orders[0]->total, $campaignsResp[0]->getTotal());

        //buyer
        $this->assertEquals($ordersJson->orders[0]->buyer->id, $campaignsResp[0]->getBuyer()->getId());
        $this->assertEquals($ordersJson->orders[0]->buyer->lastName, $campaignsResp[0]->getBuyer()->getLastName());
        $this->assertEquals($ordersJson->orders[0]->buyer->firstName, $campaignsResp[0]->getBuyer()->getFirstName());
        $this->assertEquals($ordersJson->orders[0]->buyer->middleName, $campaignsResp[0]->getBuyer()->getMiddleName());
        $this->assertEquals($ordersJson->orders[0]->buyer->phone, $campaignsResp[0]->getBuyer()->getPhone());
        $this->assertEquals($ordersJson->orders[0]->buyer->email, $campaignsResp[0]->getBuyer()->getEmail());

        //delivery
        $this->assertEquals($ordersJson->orders[0]->delivery->type, $campaignsResp[0]->getDelivery()->getType());
        $this->assertEquals($ordersJson->orders[0]->delivery->serviceName, $campaignsResp[0]->getDelivery()->getServiceName());
        $this->assertEquals($ordersJson->orders[0]->delivery->price, $campaignsResp[0]->getDelivery()->getPrice());

        //delivery->address
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->country,
            $campaignsResp[0]->getDelivery()->getAddress()->getCountry()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->postcode,
            $campaignsResp[0]->getDelivery()->getAddress()->getPostcode()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->city,
            $campaignsResp[0]->getDelivery()->getAddress()->getCity()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->subway,
            $campaignsResp[0]->getDelivery()->getAddress()->getSubway()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->street,
            $campaignsResp[0]->getDelivery()->getAddress()->getStreet()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->house,
            $campaignsResp[0]->getDelivery()->getAddress()->getHouse()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->entrance,
            $campaignsResp[0]->getDelivery()->getAddress()->getEntrance()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->entryphone,
            $campaignsResp[0]->getDelivery()->getAddress()->getEntryphone()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->floor,
            $campaignsResp[0]->getDelivery()->getAddress()->getFloor()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->apartment,
            $campaignsResp[0]->getDelivery()->getAddress()->getApartment()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->recipient,
            $campaignsResp[0]->getDelivery()->getAddress()->getRecipient()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->address->phone,
            $campaignsResp[0]->getDelivery()->getAddress()->getPhone()
        );

        //delivery->dates
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->dates->fromDate,
            $campaignsResp[0]->getDelivery()->getDates()->getFromDate()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->dates->toDate,
            $campaignsResp[0]->getDelivery()->getDates()->getToDate()
        );

        //delivery->region
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->id,
            $campaignsResp[0]->getDelivery()->getRegion()->getId()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->name,
            $campaignsResp[0]->getDelivery()->getRegion()->getName()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->type,
            $campaignsResp[0]->getDelivery()->getRegion()->getType()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->id,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getId()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->name,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getName()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->type,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getType()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->parent->id,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getId()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->parent->name,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getName()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->parent->type,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getType()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->parent->parent->id,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getParent()->getId()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->parent->parent->name,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getParent()->getName()
        );
        $this->assertEquals(
            $ordersJson->orders[0]->delivery->region->parent->parent->parent->type,
            $campaignsResp[0]->getDelivery()->getRegion()->getParent()->getParent()->getParent()->getType()
        );

        /** @var Item $item0 */
        $item0 = $campaignsResp[0]->getItems()->getAll()[0];
        $this->assertEquals($ordersJson->orders[0]->items[0]->feedId, $item0->getFeedId());
        $this->assertEquals($ordersJson->orders[0]->items[0]->offerId, $item0->getOfferId());
        $this->assertEquals($ordersJson->orders[0]->items[0]->feedCategoryId, $item0->getFeedCategoryId());
        $this->assertEquals($ordersJson->orders[0]->items[0]->offerName, $item0->getOfferName());
        $this->assertEquals($ordersJson->orders[0]->items[0]->price, $item0->getPrice());
        $this->assertEquals($ordersJson->orders[0]->items[0]->count, $item0->getCount());

        /** @var Item $item1 */
        $item1 = $campaignsResp[0]->getItems()->getAll()[1];
        $this->assertEquals($ordersJson->orders[0]->items[1]->feedId, $item1->getFeedId());
        $this->assertEquals($ordersJson->orders[0]->items[1]->offerId, $item1->getOfferId());
        $this->assertEquals($ordersJson->orders[0]->items[1]->feedCategoryId, $item1->getFeedCategoryId());
        $this->assertEquals($ordersJson->orders[0]->items[1]->offerName, $item1->getOfferName());
        $this->assertEquals($ordersJson->orders[0]->items[1]->price, $item1->getPrice());
        $this->assertEquals($ordersJson->orders[0]->items[1]->count, $item1->getCount());
    }
}
