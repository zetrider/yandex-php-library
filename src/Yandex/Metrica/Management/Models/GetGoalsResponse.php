<?php

namespace Yandex\Metrica\Management\Models;

use Yandex\Metrica\Management\Models\Goals;

class GetGoalsResponse extends ManagementModel
{

    protected $goals = null;

    protected $mappingClasses = array(
        'goals' => 'Yandex\Metrica\Management\Models\Goals'
    );

    protected $propNameMap = array(
        
    );

    /**
     * Retrieve the goals property
     *
     * @return Goals|null
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Set the goals property
     *
     * @param Goals $goals
     * @return $this
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;
        return $this;
    }
}
