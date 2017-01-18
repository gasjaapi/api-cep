<?php

namespace APICep\V1\Rpc\Cep\Service;
use APICep\V1\Rpc\Cep\Adapter\CepAdapterInterface;
use APICep\V1\Rpc\Cep\Exception\EnderecoFormatException;
use APICep\V1\Rpc\Cep\Exception\EnderecoResponseException;
use APICep\V1\Rpc\Cep\Response\EnderecoResponseInterface;

class CepService {

    /** @var  CepAdapterInterface */
    protected $cepAdapter;

    public function __construct(CepAdapterInterface $cepAdapter)
    {
        $this->cepAdapter = $cepAdapter;
    }

    public function getEnderecoByCep($cep, $format=null)
    {
        $cep = $this->removeNaoDigitos($cep);
        $endereco = $this->cepAdapter->getEnderecoByCep($cep);

        if (! $endereco instanceof EnderecoResponseInterface){
            throw new EnderecoResponseException();
        }

        return $this->formatEndereco($endereco,$format);
    }

    protected function formatEndereco($endereco, $format)
    {
        if( is_null($format) )
        {
            return $endereco;
        }

        $nomeDoMetodo = 'to'.ucfirst($format);
        if(! method_exists($endereco,$nomeDoMetodo))
        {
            throw new EnderecoFormatException();
        }

        return $endereco->$nomeDoMetodo();
    }

    protected function removeNaoDigitos($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }
}