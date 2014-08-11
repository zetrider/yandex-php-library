<?php

namespace Yandex\Market\Models;

use Yandex\Market\Models\Campaigns;

class GetCampaignsResponse extends MarketModel
{

    protected $campaigns = null;

    protected $mappingClasses = array(
        'campaigns' => 'Yandex\Market\Models\Campaigns'
    );

    /**
     * Retrieve the campaigns property
     *
     * @return Campaigns|null
     */
    public function getCampaigns()
    {
        return $this->campaigns;
    }

    /**
     * Set the campaigns property
     *
     * @param Campaigns $campaigns
     * @return $this
     */
    public function setCampaigns($campaigns)
    {
        $this->campaigns = $campaigns;
        return $this;
    }
}
