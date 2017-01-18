<?php

namespace APICep\V1\Rpc\Cep\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Http\Response;
use APICep\V1\Rpc\Cep\Controller\CepController;
use APICep\V1\Rpc\Cep\Service\CepService;

class CepControllerFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){
        $serviceManager = $serviceLocator->getServiceLocator();

        /** @var CepService $cepService */
        $cepService = $serviceManager->get('APICep\V1\Rpc\Cep\Service\CepService');

        /** @var Response $reponse */
        $response = $serviceManager->get('APICep\V1\Rpc\Cep\Http\Response');
        $controller = new CepController($cepService,$response);
        return $controller;
    }

}