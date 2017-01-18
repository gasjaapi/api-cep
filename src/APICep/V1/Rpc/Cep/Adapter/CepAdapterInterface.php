<?php

namespace APICep\V1\Rpc\Cep\Adapter;

interface CepAdapterInterface {
    public function getEnderecoByCep($cep);
}