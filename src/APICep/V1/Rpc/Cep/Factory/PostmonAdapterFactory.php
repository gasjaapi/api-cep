<?php

namespace APICep\V1\Rpc\Cep\Factory;

use APICep\V1\Rpc\Cep\Adapter\PostmonAdapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostmonAdapterFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){
        /** @var \Zend\Http\Client $httpClient */
        $httpClient       = $serviceLocator->get('APICep\V1\Rpc\Cep\Http\Client');

        /** @var \APICep\V1\Rpc\Cep\Response\EnderecoResponse $enderecoResponse */
        $enderecoResponse = $serviceLocator->get('APICep\V1\Rpc\Cep\Response\EnderecoResponse');

        $adapter          = new PostmonAdapter($httpClient, $enderecoResponse);
        return $adapter;
    }

}