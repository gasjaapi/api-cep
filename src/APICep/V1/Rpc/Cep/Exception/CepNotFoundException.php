<?php

namespace APICep\V1\Rpc\Cep\Exception;

class CepNotFoundException extends \Exception{
    public $message = "CEP não encontrado";
}