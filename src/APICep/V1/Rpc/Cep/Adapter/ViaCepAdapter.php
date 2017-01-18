<?php

namespace APICep\V1\Rpc\Cep\Adapter;
use Zend\Http\Client;
use APICep\V1\Rpc\Cep\Response\EnderecoResponse;
use APICep\V1\Rpc\Cep\Exception\CepNotFoundException;

class ViaCepAdapter implements CepAdapterInterface {
    /** @var  Client */
    protected $httpClient;

    /** @var  EnderecoResponse */
    protected $enderecoResponse;

    public function __construct(Client $httpClient,EnderecoResponse $enderecoResponse)
    {
        $this->httpClient = $httpClient;
        $this->enderecoResponse = $enderecoResponse;
    }

    public function getEnderecoByCep($cep)
    {
        $this->httpClient->setUri("http://viacep.com.br/ws/{$cep}/json/");

        $response = $this->httpClient->send();

        return $this->parseResponse($response->getBody());
    }

    protected function parseResponse($response)
    {
        if(!$this->isJson($response))
        {
            throw new CepNotFoundException();
        }

        $response = json_decode($response,true);

        if(isset($response['erro']) && ($response['erro'] === true))
        {
            throw new CepNotFoundException();
        }

        $enderecoResponse = $this->enderecoResponse;

        if(isset($response['logradouro']) && !empty($response['logradouro']))
        {
            $enderecoResponse->setLogradouro($response['logradouro']);
        }

        if(isset($response['bairro']) && !empty($response['bairro']))
        {
            $enderecoResponse->setBairro($response['bairro']);
        }

        if(isset($response['localidade']) && !empty($response['localidade']))
        {
            $enderecoResponse->setLocalidade($response['localidade']);
        }

        if(isset($response['uf']) && !empty($response['uf']))
        {
            $enderecoResponse->setUf($response['uf']);
        }

        if(isset($response['complemento']) && !empty($response['complemento']))
        {
            $enderecoResponse->setComplemento($response['complemento']);
        }

        if(isset($response['ibge']) && !empty($response['ibge']))
        {
            $enderecoResponse->setIbge($response['ibge']);
        }

        return $enderecoResponse;
    }
    protected function isJson ($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}