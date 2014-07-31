<?php

namespace Yandex\Metrica\Management\Models;

class Accounts extends ManagementModel
{

    protected $collection = array(
        
    );

    protected $mappingClasses = array(
        
    );

    protected $propNameMap = array(
        
    );

    /**
     * Add item
     */
    public function add($account)
    {
        if (is_array($account)) {
            $this->collection[] = new Account($account);
        } elseif (is_object($account) && $account instanceof Account) {
            $this->collection[] = $account;
        }

        return $this;
    }

    /**
     * Get items
     */
    public function getAll()
    {
        return $this->collection;
    }
}
