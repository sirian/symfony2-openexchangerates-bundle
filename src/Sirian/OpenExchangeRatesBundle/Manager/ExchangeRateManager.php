<?php

namespace Sirian\OpenExchangeRatesBundle\Manager;

use Sirian\OpenExchangeRatesBundle\Model\ExchangeRate;

class ExchangeRateManager
{
    protected $rateClass;
    protected $appId;

    public function __construct($rateClass, $appId)
    {
        $this->rateClass = $rateClass;
        $this->appId = $appId;
    }

    public function get(\DateTime $date)
    {
        $rate = $this->find($date);

        if ($rate) {
            return $rate;
        }

        return $this->downloadRates($date);
    }

    protected function downloadRates(\DateTime $date)
    {
        $rawData = file_get_contents($this->getRatesUrl($date));
        $data = json_decode($rawData, true);

        if (!$data || !$data['rates']) {
            throw new \RuntimeException('Invalid rates ' . $rawData);
        }

        /**
         * @var ExchangeRate $rate
         */
        $rate = new $this->rateClass();
        $rate->setDate($date);
        $rate->setRates($data['rates']);
        return $rate;
    }

    public function find(\DateTime $date)
    {
        return null;
    }

    protected function getRatesUrl(\DateTime $date)
    {
        $now = new \DateTime();
        if ($date->format('Ymd') > $now->format('Ymd')) {
            throw new \LogicException('Invalid date');
        }

        if ($date->format('Ymd') < $now->format('Ymd')) {
            $method = 'api/historical/' . $date->format('Y-m-d') . '.json';
        } else {
            $method = 'api/latest.json';
        }

        return 'http://openexchangerates.org/' . $method . '?app_id=' . $this->appId;
    }
}
