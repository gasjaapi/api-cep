<?php

namespace APICep\V1\Rpc\Cep\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use APICep\V1\Rpc\Cep\Adapter\ViaCepAdapter;

class ViaCepAdapterFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){
        /** @var \Zend\Http\Client $httpClient */
        $httpClient       = $serviceLocator->get('APICep\V1\Rpc\Cep\Http\Client');

        /** @var \APICep\V1\Rpc\Cep\Response\EnderecoResponse $enderecoResponse */
        $enderecoResponse = $serviceLocator->get('APICep\V1\Rpc\Cep\Response\EnderecoResponse');

        $adapter          = new ViaCepAdapter($httpClient, $enderecoResponse);
        return $adapter;
    }

}