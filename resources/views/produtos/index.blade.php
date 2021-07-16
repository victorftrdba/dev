<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset='utf-8'>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b0/NewTux.svg" alt="" width="30" height="24">
          </a>
          <b>🔒 Site Seguro</b>
        </div>
      </nav>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Congelados da Sônia</title>
</head>
<hr>
<body>

<h2 style="font-weight:bold;">Meu Carrinho</h2>

<div class="row justify-content-around">
    <div class="col-md-6">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
          <div class="row">
            <div class="col-6 col-md-4 d-flex justify-content-center">Meu Kit</div>
            <div class="col-6 col-md-4">

            <div class="quantity">
              <button class="btn minus-btn disabled">-</button>
                <input type="text" id="quantity" value="1" />
              <button class="btn plus-btn">+</button>
            </div>

            </div>
            <div class="col-6 col-md-4 d-flex justify-content-center" id="precoTotal">
                <span id="price">TOTAL: R${{$total}}</span>
            </div>
          </div>
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                </button>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
@foreach($produtos as $produto)

<div class="row">
    <div class="col-sm d-flex justify-content-center"><p><img src='{{$produto->image}}' width='100' height='100' /></p></div>

    <div class="col-sm"><p>{{$produto->title}}</p></div>

    <div class="col-sm d-flex justify-content-center"><p style="font-weight:bold;">
    Desconto: R${{$valorDescPorItem = $produto->price * 0.2}}<br/>
    Preço: R${{$produto->price}}</p></div>
</div>

@endforeach

</div>
</div>
</div>
</div>
</div>

<div class="col-4">
<form action="{{url('/resultado')}}" method="GET">
@csrf
<p style="font-weight:bold;">Calcule a entrega</p>
<p>Insira o CEP de entrega para simular o frete</p>

<input type="number" id="cep" name="cep" />
<
<input type="submit" value="CALCULAR" />
</form>

    <hr>

    <form>
    <p style="font-weight:bold;">Resumo do pedido</p>
    <p>Abaixo você pode conferir os valores do seu pedido e finalizar sua compra.</p>

    <div id="subt">Subtotal: R${{$total + $produtoAvulso->price}}</div>
    <div id="desc">Descontos: R${{$totalDesconto = $desconto + ($produtoAvulso->price * 0.2)}}</div>
    <div id="total">Total: R${{$valorTotal = $total - $totalDesconto}}</div><br />
    </form>
    <button class="btn btn-primary" onClick={registrarProduto()}>FINALIZAR COMPRA</button>

<script>
function registrarProduto() {
  registrar = [
      total => '{{$total}}',
    subTotal => '{{$total + $produtoAvulso->price + $produtoAvulso->price}}',
    desconto => '{{$totalDesconto = $desconto + ($produtoAvulso->price * 0.2) + $produtoAvulso->price * 0.2}}',
    valorTotal => '{{$valorTotal = $total - $totalDesconto}}'
  ];

  console.log(registrar)
  return false
}
</script>

  </div>

  <div class="quantity">
    <button class="btn minus-btn disabled">-</button>
      <input type="text" id="quantity" value="1" />
    <button class="btn plus-btn">+</button>
  </div>

  <table style="border:1px solid gray;">
  <div class="row justify-content-left">
    <div class="col-md-6">
    <div class="row">
    <div class="col-sm d-flex justify-content-center"><p><img src='{{$produtoAvulso->image}}' width='100' height='100' /></p></div>

    <div class="col-sm"><p>{{$produtoAvulso->title}}</p></div>

    <div class="col-sm d-flex justify-content-center"><p style="font-weight:bold;">
    Desconto: R${{$valorDescPorItem = $produtoAvulso->price * 0.2}}<br/>
    Preço: R${{$produtoAvulso->price}}</p></div>
</div>
</div>
</div>
</table>

</div>

<script>

document.querySelector('.minus-btn').setAttribute("disabled", "disabled");
let valueCount;

function priceTotal() {
    let total = valueCount * {{$total}};
    let subtotal = valueCount * {{$total + $produtoAvulso->price}};
    let descontos = valueCount * {{$totalDesconto = $desconto + ($produtoAvulso->price * 0.2)}};
    let total2 = valueCount * {{$valorTotal}}
    let totalAvulso = valueCount * {{$valorTotal = $total - $totalDesconto}}
    document.getElementById("price").innerText = "TOTAL: R$" + total;
    document.getElementById("subt").innerText = "Subtotal: R$" + subtotal;
    document.getElementById("desc").innerText = "Descontos: R$" + descontos;
    document.getElementById("total").innerText = "Total: R$" + total2;    
}
document.querySelector('.plus-btn').addEventListener("click", function(){
    valueCount = document.getElementById("quantity").value;
    valueCount++;
    document.getElementById("quantity").value = valueCount;
    if(valueCount > 1) {
        document.querySelector(".minus-btn").removeAttribute("disabled");
        document.querySelector(".minus-btn").classList.remove("disabled");
    }
    priceTotal()
})
document.querySelector('.minus-btn').addEventListener("click", function(){
    valueCount = document.getElementById("quantity").value;
    valueCount--;
    document.getElementById("quantity").value = valueCount;
    if(valueCount == 1) {
        document.querySelector(".minus-btn").setAttribute("disabled", "disabled");
    }
    priceTotal()
})

</script>
</body>

</html>
