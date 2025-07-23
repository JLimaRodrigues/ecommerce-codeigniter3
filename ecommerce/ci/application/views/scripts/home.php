<script>

  function fetchProducts(callback) {
  $.ajax({
    url: '<?= base_url('produto/listar') ?>',
    method: 'GET',
    success: function (data) {
      products = data;
      maxPage = Math.ceil(products.length / itemsPerPage) - 1;
      callback();
    },
    error: function () {
      alert("Erro ao carregar produtos");
    }
  });
}

  let products = [];
  let maxPage = 0;
  let cart = [];
  let currentPage = 0;
  const itemsPerPage = 6;
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
              <h5 class="fw-bolder">${product.nome_produto}</h5>
              ${product.preco}
            </div>
          </div>
          <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
             <a class="btn btn-outline-dark mt-auto" href="#">Ver opções</a>
             <button class="btn btn-sm btn-outline-dark w-100" onclick="addToCart('${product.nome_produto}', '${product.preco}')">Adicionar</button>
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

  function saveCart() {
    sessionStorage.setItem('cart', JSON.stringify(cart));
  }

  function loadCart() {
    const stored = sessionStorage.getItem('cart');
    cart = stored ? JSON.parse(stored) : [];
    updateCart();
  }

  function addToCart(name, price) {
    cart.push({ name, price });
    updateCart();
    saveCart();
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
    saveCart();
  }

  function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
    saveCart();
  }

  function updateSubtotal() {
    const subtotal = cart.reduce((total, item) => {
      const priceNumber = parseFloat(item.price.replace(/[^\d.-]/g, ''));
      return total + priceNumber;
    }, 0);

    $('#cart-subtotal').text(`Subtotal: R$ ${subtotal.toFixed(2)}`);
  }

  $(document).ready(function () {
    loadCart();
    renderProducts(currentPage);

    fetchProducts(() => {
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
      }, 300);
    });
  });

    const minHeight = 1000;
    const $main = $('main');
    if ($main.height() < minHeight) {
      $main.css('min-height', `${minHeight}px`);
    }

    $('#checkout-btn').on('click', function () {
      if (cart.length === 0) return alert('Carrinho vazio');

          <?php if (usuario_logado()): ?>
            window.location.href = '<?= base_url("carrinho") ?>';
          <?php else: ?>
            window.location.href = '<?= base_url("login") ?>?redirect=carrinho';
          <?php endif; ?>
      });

  });
</script>