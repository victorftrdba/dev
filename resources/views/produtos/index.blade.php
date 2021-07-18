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
                <input type="text" style="margin:20px;width:18px" id="quantity" value="1" />
              <button class="btn plus-btn">+</button>
            </div>

            </div>
            <div class="col-6 col-md-4 d-flex justify-content-center" id="precoTotal">
                <span id="price">TOTAL: R${{number_format((float)$total, 2, ',', '')}}</span>
            </div>
          </div>
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                </button>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
@foreach($products as $product)

<div class="row">
    <div class="col-sm d-flex justify-content-center"><p><img src='{{$product->image}}' width='100' height='100' /></p></div>

    <div class="col-sm"><p>{{$product->title}}</p></div>

    <div class="col-sm d-flex justify-content-center"><p style="font-weight:bold;">
        <s style="color:rgb(100, 100, 100)">Desconto: R${{number_format((float)$discValuePerItem = $product->price * 0.2, 2, ',', '')}}</s><br/>
    Preço: R${{number_format((float)$product->price, 2, ',', '')}}</p></div>
</div>

@endforeach

</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-6 col-md-4 d-flex justify-content-center">
    </div>
    <div class="col-6 col-md-4">
        <div class="quantity2">
            <button class="btn minus-btn2 disabled">-</button>
              <input type="text" style="margin:20px;width:18px;" id="quantity2" value="1" />
            <button class="btn plus-btn2">+</button>
        </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="container">
    <div class="row" style="border:1px solid rgb(209, 213, 214);border-radius:2px;">
    <div class="col-sm d-flex justify-content-center"><p><img src='{{$singleProduct->image}}' width='100' height='100' /></p></div>

    <div class="col-sm"><p>{{$singleProduct->title}}</p></div>

    <div class="col"><p style="font-weight:bold;">
    <s style="color:rgb(100, 100, 100)">Desconto: R${{number_format((float)$discValuePerItem = $singleProduct->price * 0.2, 2, ',', '')}}</s><br/>
    Preço: R${{number_format((float)$singleProduct->price, 2, ',', '')}}</p></div>
</div>
</div>
</div>
</div>


<div class="col-4">
<form action="{{url('/resultado')}}" method="get" onsubmit="target_popup(this)">

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

    <div id="subt">Subtotal: R${{number_format((float)$total + $singleProduct->price, 2, ',', '')}}</div>
    <div id="desc">Descontos: R${{number_format((float)$discTotal = $discount + ($singleProduct->price * 0.2), 2, ',', '')}}</div>
    <div id="total">Total: R${{number_format((float)$valueTotal = ($singleProduct->price + $total) - $discTotal, 2, ',', '')}}</div><br />
    </form>
    <button class="btn btn-primary" onClick={purchaseRegister()}>FINALIZAR COMPRA</button>

  </div>

</div>

<script>

document.querySelector('.minus-btn').setAttribute("disabled", "disabled");
let valueCount;
function priceTotal() {
    let total = valueCount * {{$total}};
    let subtotal = valueCount * {{$total + $singleProduct->price}};
    let discounts = valueCount * {{$discTotal = $discount + ($singleProduct->price * 0.2)}};
    let total2 = valueCount * {{$valueTotal + $singleProduct->price}}
    document.getElementById("price").innerText = "TOTAL: R$" + parseFloat(total).toFixed(2);
    document.getElementById("subt").innerText = "Subtotal: R$" + parseFloat(subtotal).toFixed(2);
    document.getElementById("desc").innerText = "Descontos: R$" + parseFloat(discounts).toFixed(2);
    document.getElementById("total").innerText = "Total: R$" + parseFloat(total2).toFixed(2);
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

document.querySelector('.minus-btn2').setAttribute("disabled", "disabled");
let valueCount2;
function priceTotal2() {
    let totalPurchaseWithSingle = valueCount2 * {{$singleProduct->price}}
    let totalPurchaseWithDiscSingle = valueCount2 * {{$discValuePerItem}}
    let totalPurchaseSingle = valueCount2 * {{$singleProduct->price - $discValuePerItem}}
    document.getElementById("subt").innerText = "Subtotal: R$" + parseFloat(totalPurchaseWithSingle).toFixed(2);
    document.getElementById("desc").innerText = "Descontos: R$" + parseFloat(totalPurchaseWithDiscSingle).toFixed(2);
    document.getElementById("total").innerText = "Total: R$" + parseFloat(totalPurchaseSingle).toFixed(2);
}
document.querySelector('.plus-btn2').addEventListener("click", function(){
    valueCount2 = document.getElementById("quantity2").value;
    valueCount2++;
    document.getElementById("quantity2").value = valueCount2;
    if(valueCount2 > 1) {
        document.querySelector(".minus-btn2").removeAttribute("disabled");
        document.querySelector(".minus-btn2").classList.remove("disabled");
    }
    priceTotal2()
})
document.querySelector('.minus-btn2').addEventListener("click", function(){
    valueCount2 = document.getElementById("quantity2").value;
    valueCount2--;
    document.getElementById("quantity2").value = valueCount2;
    if(valueCount2 == 1) {
        document.querySelector(".minus-btn2").setAttribute("disabled", "disabled");
    }
    priceTotal2()
})

function purchaseRegister() {
        let totalPurchase = document.getElementById('total').innerHTML
        let discountsPurchase = document.getElementById('desc').innerHTML
        let subtotalPurchase = document.getElementById('subt').innerHTML
        let kitPurchaseTotal = document.getElementById('price').innerHTML
      register = [{
        'Total da Compra': totalPurchase,
        'Subtotal da Compra': discountsPurchase,
        'Descontos aplicados': subtotalPurchase,
        'Total do Kit': kitPurchaseTotal
      }];

      console.log(register)
}

function target_popup(form) {
    window.open('', 'formpopup', 'width=400,height=400,resizeable,scrollbars');
    form.target = 'formpopup';
}

</script>

</body>
</html>
