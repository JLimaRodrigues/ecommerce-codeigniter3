<script>
  const products = [
    { name: "Fancy Product", price: "$40.00 - $80.00" },
    { name: "Special Item", price: "$18.00" },
    { name: "Sale Item", price: "$25.00" },
    { name: "Popular Item", price: "$40.00" },
    { name: "New Arrival", price: "$99.00" },
    { name: "Limited Edition", price: "$150.00" },
    { name: "Cool Sneakers", price: "$60.00" },
    { name: "Modern Jacket", price: "$120.00" },
    { name: "Vintage Shirt", price: "$35.00" },
    { name: "Stylish Hat", price: "$20.00" },
    { name: "Sport Watch", price: "$250.00" },
    { name: "Elegant Dress", price: "$110.00" }
  ];

  let cart = [];
  let currentPage = 0;
  const itemsPerPage = 6;
  const maxPage = Math.ceil(products.length / itemsPerPage) - 1;
  let isLoading = false;

  function renderProducts(pageIndex) {
    const start = pageIndex * itemsPerPage;
    const end = start + itemsPerPage;
    const currentItems = products.slice(start, end);

    const html = currentItems.map(product => `
      <div class="col mb-5">
        <div class="card h-100">
          <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="${product.name}" />
          <div class="card-body p-4">
            <div class="text-center">
              <h5 class="fw-bolder">${product.name}</h5>
              ${product.price}
            </div>
          </div>
          <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
             <a class="btn btn-outline-dark mt-auto" href="#">Ver opções</a>
             <button class="btn btn-sm btn-outline-dark w-100" onclick="addToCart('${product.name}', '${product.price}')">Adicionar</button>
            </div>
          </div>
        </div>
      </div>
    `);

    const $container = $('#product-list');
    $container.fadeOut(200, function () {
      $container.html(html.join(''));
      $container.fadeIn(200);
    });
  }

  function addToCart(name, price) {
  cart.push({ name, price });
  updateCart();
}

function updateCart() {
  $('#cart-count').text(cart.length);
  $('#cart-items').html(cart.map((item, index) => `
    <li class="list-group-item d-flex justify-content-between">
      <span>${item.name}</span>
      <span>${item.price}</span>
      <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${index})">x</button>
    </li>
  `).join(''));

  updateSubtotal();
}

function removeFromCart(index) {
  cart.splice(index, 1);
  updateCart();
}

function updateSubtotal() {
  const subtotal = cart.reduce((total, item) => {
    const priceNumber = parseFloat(item.price.replace(/[^\d.-]/g, ''));
    return total + priceNumber;
  }, 0);

  $('#cart-subtotal').text(`Subtotal: R$ ${subtotal.toFixed(2)}`);
}

  $(document).ready(function () {
    renderProducts(currentPage);

    $(window).on('wheel', function (e) {
      if (isLoading) return;
      isLoading = true;

      const delta = e.originalEvent.deltaY;

      if (delta > 0 && currentPage < maxPage) {
        currentPage++;
        renderProducts(currentPage);
      } else if (delta < 0 && currentPage > 0) {
        currentPage--;
        renderProducts(currentPage);
      }

      setTimeout(() => {
        isLoading = false;
      }, 300); // Aguarda o fade
    });

    // Garante altura mínima da página para evitar rolagem no fim antes do fade
    const minHeight = 1000;
    const $main = $('main');
    if ($main.height() < minHeight) {
      $main.css('min-height', `${minHeight}px`);
    }

    $('#checkout-btn').on('click', function () {
        if (cart.length === 0) return alert('Carrinho vazio');

        $.ajax({
            url: '<?= base_url("carrinho/processar") ?>',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(cart),
            success: function (res) {
            // Redirecionar para a tela de checkout ou mostrar sucesso
            window.location.href = '<?= base_url("carrinho/resumo") ?>';
            },
            error: function () {
            alert('Erro ao enviar o carrinho.');
            }
        });
        });

  });
</script>