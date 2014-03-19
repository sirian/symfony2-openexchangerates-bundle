<?php

namespace Sirian\OpenExchangeRatesBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as Mongo;
use Sirian\OpenExchangeRatesBundle\Model\ExchangeRate as BaseExchangeRate;

/**
 * @Mongo\Document(collection="exchange_rates")
 */
class ExchangeRate extends BaseExchangeRate
{
    /**
     * @Mongo\Id(strategy="NONE")
     */
    protected $id;

    /**
     * @var \DateTime
     * @Mongo\Date
     */
    protected $date;

    /**
     * @Mongo\Hash
     */
    protected $rates = [];
}
