<?php
    if($response->localidade == 'Curitiba') {
            $valor = 10;
            echo "Valor de entrega para ".$response->localidade." será de R$".$valor."<br/>";
    } else {
            $valor = 25.90;
            echo "Valor de entrega para ".$response->localidade." será de R$".$valor."<br/>";
        }
?>

<a href="/" onclick="window.open('', '_self', ''); window.close();">Voltar</a>
