<?php
return array(
    'controllers' => array(
        'factories' => array(
            'APICep\\V1\\Rpc\\Cep\\Controller' => 'APICep\\V1\\Rpc\\Cep\\Factory\\CepControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'api-cep.rpc.cep' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/cep',
                    'defaults' => array(
                        'controller' => 'APICep\\V1\\Rpc\\Cep\\Controller',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'format.default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:cep]',
                            'constraints' => array(
                                'cep' => '[0-9\-]{8,9}',
                            ),
                            'defaults' => array(
                                'controller'    => 'APICep\\V1\\Rpc\\Cep\\Controller',
                                'action'        => 'getEnderecoByCep',
                                'formato'        => 'json'

                            ),
                        ),
                    ),

                    'format' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:cep:/:formato',
                            'defaults' => array(
                                'action'=> 'getEnderecobyCep',
                                'formato'=>'json'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'invokables' => array (
            'APICep\\V1\\Rpc\\Cep\Http\Client' => 'Zend\Http\Client',
            'APICep\\V1\\Rpc\\Cep\Http\Response' => 'Zend\Http\Response',
            'APICep\\V1\\Rpc\\Cep\Response\EnderecoResponse' => 'APICep\\V1\\Rpc\\Cep\\Response\\EnderecoResponse'
        ),
        'factories' => array(
            'APICep\\V1\\Rpc\\Cep\Service\CepService' =>'APICep\\V1\\Rpc\\Cep\\Factory\\CepServiceFactory',
            'APICep\\V1\\Rpc\\Cep\Service\ViaCepAdapter' =>'APICep\\V1\\Rpc\\Cep\\Factory\\ViaCepAdapterFactory',
            'APICep\\V1\\Rpc\\Cep\Service\PostmonAdapter' =>'APICep\\V1\\Rpc\\Cep\\Factory\\PostmonAdapterFactory',
            'APICep\\V1\\Rpc\\Cep\Service\CorreioControlAdapter' =>'APICep\\V1\\Rpc\\Cep\\Factory\\CorreioControlAdapterFactory',
            'APICep\\V1\\Rpc\\Cep\Service\RepublicaVirtualAdapter' =>'APICep\\V1\\Rpc\\Cep\\Factory\\RepublicaVirtualAdapterFactory',
        ),
        'aliases' => array(
            'APICep\\V1\\Rpc\\Cep\Adapter\CepDefaultAdapter' => 'APICep\\V1\\Rpc\\Cep\\Service\\ViaCepAdapter'
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'api-cep.rpc.cep',
        ),
    ),
    'zf-rpc' => array(
        'APICep\\V1\\Rpc\\Cep\\Controller' => array(
            'service_name' => 'Cep',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'api-cep.rpc.cep',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'APICep\\V1\\Rpc\\Cep\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'APICep\\V1\\Rpc\\Cep\\Controller' => array(
                0 => 'application/vnd.api-cep.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'APICep\\V1\\Rpc\\Cep\\Controller' => array(
                0 => 'application/vnd.api-cep.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
);
