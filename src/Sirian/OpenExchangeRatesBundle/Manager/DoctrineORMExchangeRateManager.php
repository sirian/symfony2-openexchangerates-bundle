<?php

namespace Sirian\OpenExchangeRatesBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

class DoctrineORMExchangeRateManager extends ExchangeRateManager
{
    protected $doctrine;

    public function __construct(ManagerRegistry $doctrine, $entityClass, $appId)
    {
        $this->doctrine = $doctrine;
        parent::__construct($entityClass, $appId);
    }

    protected function downloadRates(\DateTime $date)
    {
        $rate = parent::downloadRates($date);

        try {
            $em = $this->doctrine->getManagerForClass($this->rateClass);
            $em->persist($rate);
            $em->flush($rate);
        } catch (\Exception $e) {
        }
        return $rate;
    }


    public function find(\DateTime $date)
    {
        return $this->doctrine->getManagerForClass($this->rateClass)->getRepository($this->rateClass)->findOneBy([
            'id' => $date->format('Ymd')
        ]);
    }
}
