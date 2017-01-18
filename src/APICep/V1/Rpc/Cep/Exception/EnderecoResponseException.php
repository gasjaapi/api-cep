<?php

namespace APICep\V1\Rpc\Cep\Exception;

class EnderecoResponseException extends \Exception{
    public $message = "Objeto de retorno do endereço é inválido";
}