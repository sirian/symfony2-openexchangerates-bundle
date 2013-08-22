<?php

namespace Sirian\OpenExchangeRatesBundle\Model;

use Doctrine\ORM\Mapping as ORM;

class ExchangeRate
{
    protected $base = 'USD';

    protected $id;

    protected $date;

    protected $rates = [];

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        $this->id = $date->format('Ymd');
        return $this;
    }

    public function getRates()
    {
        return $this->rates;
    }

    public function setRates($rates)
    {
        $this->rates = $rates;
        return $this;
    }

    public function convert($value, $from, $to)
    {
        if ($from == $to) {
            return $value;
        }

        if (!isset($this->rates[$from], $this->rates[$to])) {
            throw new \InvalidArgumentException();
        }

        return $value / $this->rates[$from] * $this->rates[$to];
    }
}
