<?php

return [
    'company' => '', // código e senha da empresa, se você tiver contrato com os correios, se não tiver deixe vazio
    'password' => '', // senha empresa
    'services' => [], // serviços disponíveis
    'address' => [
        'zipcode' => '',
        'street' => '',
        'number' => '',
        'complement' => '',
        'district' => '',
        'city' => '',
        'uf' => '',
    ],
    'options' => [
        'declared_value' => 0, // caso de sua encomenda extraviar, então você poderá recuperar o valor dela. Vale lembrar que o valor da encomenda interfere no valor do frete
        'receipt_notification' => true, // receber notificações de entrega
        'byhand' => true // aqui você informa se quer que a encomenda deva ser entregue somente para uma determinada pessoa após confirmação por RG.
    ]
];
