<?php

namespace Sirian\OpenExchangeRatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sirian\OpenExchangeRatesBundle\Model\ExchangeRate as BaseExchangeRate;

/**
 * @ORM\Entity
 * @ORM\Table(name="exchange_rates")
 */
class ExchangeRate extends BaseExchangeRate
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="date")
     */
    protected $date;

    /**
     * @ORM\Column(type="array")
     */
    protected $rates = [];
}
