<?php

namespace Sirian\OpenExchangeRatesBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Sirian\OpenExchangeRatesBundle\Model\ExchangeRate;

class DoctrineORMExchangeRateManager extends ExchangeRateManager
{
    /**
     * @var Registry
     */
    protected $doctrine;

    public function __construct(Registry $doctrine, $entityClass, $appId)
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
    }


    public function find(\DateTime $date)
    {
        return $this->doctrine->getManagerForClass($this->rateClass)->getRepository($this->rateClass)->findOneBy([
            'id' => $date->format('Ymd')
        ]);
    }
}
