<!DOCTYPE html>

<html lang="pt-BR">

<head>
<meta charset='utf-8'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<title>Congelados da Sônia</title>
</head>
<body>

<table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">CEP</th>
        <th scope="col">Cidade</th>
        <th scope="col">Valor</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php
        echo $response->cep;
        ?></td>
        <td><?php
        echo $response->localidade;
        ?></td>
        <td><?php
        use FlyingLuscas\Correios\Client;
        use FlyingLuscas\Correios\Service;

        $correios = new Client;

        $correios->freight()
        ->origin('82920080')
        ->destination($response->cep)
        ->services(Service::SEDEX, Service::PAC)
        ->item(5, 5, 10, 0.8, 5) // largura, altura, comprimento, peso e quantidade
        ->calculate();
        $frete = $correios->freight()->calculate();
        $imprimeFrete = json_encode($frete);
        $fre = json_decode($imprimeFrete);

            if($response->localidade == 'Curitiba') {
                    echo "Valor do Frete em SEDEX e PAC respectivamente<br/>";
                    $valor = 10;
                    foreach($fre as $f) {
                        echo "R$".number_format((float)$f->price + $valor, 2, ',', '')."<br/>";
                    }
            } else {
                echo "Valor do Frete em SEDEX e PAC respectivamente<br/>";
                    $valor = 25.90;
                    foreach($fre as $f) {
                        echo "R$".number_format((float)$f->price + $valor, 2, ',', '')."<br/>";
                    }
            }
        ?></td>
      </tr>
    </tbody>
  </table>

<a href="/" onclick="window.open('', '_self', ''); window.close();">Voltar</a>
</body>
</html>
