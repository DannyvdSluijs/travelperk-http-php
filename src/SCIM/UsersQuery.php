<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\SCIM;

use Namelivia\TravelPerk\Api\TravelPerk;

class UsersQuery
{
    private $params;

    public function __construct(TravelPerk $travelPerk)
    {
        $this->params = new UsersInputParams();
        $this->travelPerk = $travelPerk;
    }

    public function setCount(int $count)
    {
        $this->params->setCount($count);

        return $this;
    }

    public function setStartIndex(int $startIndex)
    {
        $this->params->setStartIndex($startIndex);

        return $this;
    }

    public function setFilter(string $filter)
    {
        $this->params->setFilter($filter);

        return $this;
    }

    public function get()
    {
        return $this->travelPerk->getJson(
            implode('/', ['scim', 'Users']).'?'.$this->params->asUrlParam()
        );
    }
}