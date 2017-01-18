<?php
namespace APICep\V1\Rpc\Cep\Exception;

class EnderecoFormatException extends \Exception{
    public $message = "Formato de retorno do endereço é inválido";
}