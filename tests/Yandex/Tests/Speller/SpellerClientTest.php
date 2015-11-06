<?php

namespace Yandex\Tests\Speller;

use Yandex\Speller\SpellerClient;
use Yandex\Tests\TestCase;

class SpellerClientTest extends TestCase
{
    public function testCreate()
    {
        $this->getSpellerClient();
    }

    public function testGetClient()
    {
        $spellerClient = $this->getSpellerClient();

        $getClient = self::getNotAccessibleMethod($spellerClient, 'getClient');

        $guzzleClient = $getClient->invokeArgs($spellerClient, []);

        $this->assertInstanceOf('\GuzzleHttp\ClientInterface', $guzzleClient);
    }

    /**
     * @param $serviceDomain
     * @param $expectedServiceDomain
     *
     * @dataProvider dataSetGetServiceDomain
     */
    public function testSetGetServiceDomain($serviceDomain, $expectedServiceDomain)
    {
        $spellerClient = $this->getSpellerClient();

        $this->assertNotEmpty($spellerClient->getServiceDomain());

        $spellerClient->setServiceDomain($serviceDomain);

        $this->assertEquals($expectedServiceDomain, $spellerClient->getServiceDomain());
    }

    /**
     * @return array
     */
    public function dataSetGetServiceDomain()
    {
        return [
            'empty service domain' => [
                'serviceDomain' => null,
                'expectedServiceDomain' => null
            ],
            'not empty service domain' => [
                'serviceDomain' => 'test',
                'expectedServiceDomain' => 'test'
            ],
        ];
    }

    /**
     * @param $servicePort
     * @param $expectedServicePort
     *
     * @dataProvider dataSetGetServicePort
     */
    public function testSetGetServicePort($servicePort, $expectedServicePort)
    {
        $spellerClient = $this->getSpellerClient();

        $this->assertEmpty($spellerClient->getServicePort());

        $spellerClient->setServicePort($servicePort);

        $this->assertEquals($expectedServicePort, $spellerClient->getServicePort());
    }

    /**
     * @return array
     */
    public function dataSetGetServicePort()
    {
        return [
            'empty service port' => [
                'servicePort' => null,
                'expectedServicePort' => null
            ],
            'not empty service port' => [
                'servicePort' => 'test',
                'expectedServicePort' => 'test'
            ],
        ];
    }

    /**
     * @param $serviceScheme
     * @param $expectedServiceScheme
     *
     * @dataProvider dataSetGetServiceScheme
     */
    public function testSetGetServiceScheme($serviceScheme, $expectedServiceScheme)
    {
        $spellerClient = $this->getSpellerClient();

        $this->assertNotEmpty($spellerClient->getServiceScheme());

        $spellerClient->setServiceScheme($serviceScheme);

        $this->assertEquals($expectedServiceScheme, $spellerClient->getServiceScheme());
    }

    /**
     * @param $resource
     * @param $expectedServiceUrl
     *
     * @dataProvider dataGetServiceUrl
     */
    public function testGetServiceUrl($resource, $expectedServiceUrl)
    {
        $spellerClient = $this->getSpellerClient();

        $this->assertEquals($expectedServiceUrl, $spellerClient->getServiceUrl($resource));
    }

    /**
     * @return array
     */
    public function dataGetServiceUrl()
    {
        return [
            'empty service resource' => [
                'resource' => null,
                'expectedServiceUrl' => 'https://speller.yandex.net/'
            ],
            'not empty service resource' => [
                'resource' => 'test',
                'expectedServiceUrl' => 'https://speller.yandex.net/test'
            ],
        ];
    }

    /**
     * @return array
     */
    public function dataSetGetServiceScheme()
    {
        return [
            'empty service scheme' => [
                'serviceScheme' => null,
                'expectedServiceScheme' => null
            ],
            'not empty service scheme' => [
                'serviceScheme' => 'test',
                'expectedServiceScheme' => 'test'
            ],
        ];
    }

    /**
     * @param $text
     * @param $params
     * @param $expectedResult
     *
     * @dataProvider dataCheckText
     */
    public function testCheckText($text, $params, $expectedResult)
    {
        $spellerClient = $this->getSpellerClient();

        $result = $spellerClient->checkText($text, $params);

        $this->assertEquals($expectedResult, $result);
    }

    public function dataCheckText()
    {
        return [
            'text without errors' => [
                'text' => 'test',
                'params' => [],
                'expectedResult' => []
            ],
            'text without errors with callback' => [
                'text' => 'test',
                'params' => [
                    'callback' => 'callback'
                ],
                'expectedResult' => 'callback([])'
            ],
            'text with error in first word' => [
                'text' => 'trest',
                'params' => [],
                'expectedResult' => [
                    [
                        'code' => 1,
                        'pos' => 0,
                        'row' => 0,
                        'col' => 0,
                        'len' => 5,
                        'word' => 'trest',
                        's' => [
                            'trust'
                        ]
                    ]
                ]
            ],
            'text with error in second word' => [
                'text' => 'test trest',
                'params' => [],
                'expectedResult' => [
                    [
                        'code' => 1,
                        'pos' => 5,
                        'row' => 0,
                        'col' => 5,
                        'len' => 5,
                        'word' => 'trest',
                        's' => [
                            'test',
                            'trust'
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @param $text
     * @param $params
     * @param $expectedResult
     *
     * @dataProvider dataCheckTexts
     */
    public function testCheckTexts($text, $params, $expectedResult)
    {
        $spellerClient = $this->getSpellerClient();

        $result = $spellerClient->checkTexts($text, $params);

        $this->assertEquals($expectedResult, $result);
    }

    public function dataCheckTexts()
    {
        return [
            'texts without errors' => [
                'text' => [
                    'test',
                    'best'
                ],
                'params' => [],
                'expectedResult' => [[],[]]
            ],
            'texts without errors with callback' => [
                'text' => [
                    'test',
                    'best'
                ],
                'params' => [
                    'callback' => 'callback'
                ],
                'expectedResult' => 'callback([[],[]])'
            ],
            'text with error in first word of first text' => [
                'text' => [
                    'trest',
                    'best'
                ],
                'params' => [],
                'expectedResult' => [
                    [
                        [
                            'code' => 1,
                            'pos' => 0,
                            'row' => 0,
                            'col' => 0,
                            'len' => 5,
                            'word' => 'trest',
                            's' => [
                                'trust'
                            ]
                        ]
                    ],
                    []
                ]
            ],
            'text with errors in first word in both texts' => [
                'text' => [
                    'trest',
                    'brest'
                ],
                'params' => [],
                'expectedResult' => [
                    [
                        [
                            'code' => 1,
                            'pos' => 0,
                            'row' => 0,
                            'col' => 0,
                            'len' => 5,
                            'word' => 'trest',
                            's' => [
                                'trust'
                            ]
                        ]
                    ],
                    [
                        [
                            'code' => 3,
                            'pos' => 0,
                            'row' => 0,
                            'col' => 0,
                            'len' => 5,
                            'word' => 'brest',
                            's' => [
                                'Brest',
                                'best'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @return SpellerClient
     */
    private function getSpellerClient()
    {
        return new SpellerClient();
    }
}