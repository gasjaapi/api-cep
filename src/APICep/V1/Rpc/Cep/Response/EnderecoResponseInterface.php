<?php

namespace APICep\V1\Rpc\Cep\Response;

interface EnderecoResponseInterface{

    public function toArray();

    public function toJson();

    public function toQuery();

    public function toObject();

    public function toXml();

    public function toPiped();

    public function getBairro();

    public function setBairro($bairro);

    public function getLocalidade();

    public function setLocalidade($localidade);

    public function getLogradouro();

    public function setLogradouro($logradouro);

    public function getUf();

    public function setUf($uf);

    public function getComplemento();

    public function setComplemento($complemento);

    public function getIbge();

    public function setIbge($ibge);
}