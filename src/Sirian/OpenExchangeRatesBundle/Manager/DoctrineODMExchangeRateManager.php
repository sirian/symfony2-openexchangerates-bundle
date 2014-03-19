<?php

namespace Sirian\OpenExchangeRatesBundle\Manager;

class DoctrineODMExchangeRateManager extends DoctrineORMExchangeRateManager
{
    public function find(\DateTime $date)
    {
        return $this->doctrine->getManagerForClass($this->rateClass)->getRepository($this->rateClass)->findOneBy([
            '_id' => $date->format('Ymd')
        ]);
    }
}
