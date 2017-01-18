<?php

namespace APICep\V1\Rpc\Cep\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use APICep\V1\Rpc\Cep\Service\CepService;

class CepServiceFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){

        /** @var \APICep\V1\Rpc\Cep\Adapter\CepAdapterInterface $cepAdapter */
        $cepAdapter = $serviceLocator->get('APICep\V1\Rpc\Cep\Adapter\CepDefaultAdapter');
        $service = new CepService($cepAdapter);
        return $service;
    }

}