<script>
const FRETE_POR_ITEM = 5.90;
let cart = [];

function saveCart() {
    sessionStorage.setItem('cart', JSON.stringify(cart));
}

function loadCart() {
    const stored = sessionStorage.getItem('cart');
    cart = stored ? JSON.parse(stored) : [];

    cart = cart.map(item => ({
        ...item,
        quantity: item.quantity && item.quantity > 0 ? item.quantity : 1
    }));

    saveCart();
    renderCart();
    atualizaResumoCarrinho();
}

function addToCart(name, price) {
    price = typeof price === 'string' ? parseFloat(price.replace(/[^\d.-]/g, '')) : price;
    cart.push({ name, price, quantity: 1 });
    saveCart();
    renderCart();
    atualizaResumoCarrinho();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    saveCart();
    renderCart();
    atualizaResumoCarrinho();
}

function renderCart() {
    const lista = $('#listaDeProdutosCarrinho');
    lista.html('');

    cart.forEach((item, index) => {
        const precoNumerico = parseFloat(item.price) || 0;
        const precoOriginal = (precoNumerico * 1.10).toFixed(2);
        const precoFormatado = precoNumerico.toFixed(2);

        const html = `
        <div class="list-group-item d-flex align-items-start">
            <input class="form-check-input me-3 mt-2 item-checkbox" type="checkbox" checked data-index="${index}">
            <img src="https://dummyimage.com/80x80/dee2e6/6c757d" class="me-3" alt="Produto" style="width: 80px; height: 80px; object-fit: cover;">
            <div class="flex-grow-1">
                <div class="fw-bold">${item.name}</div>
                <a href="#" class="text-danger small btn-remover" data-index="${index}">Excluir</a>
                <div class="mt-2 d-flex align-items-center">
                    <button class="btn btn-outline-secondary btn-sm btn-qtd" data-action="decrement" data-index="${index}">-</button>
                    <span class="mx-2 qtd-produto">${item.quantity}</span>
                    <button class="btn btn-outline-secondary btn-sm btn-qtd" data-action="increment" data-index="${index}">+</button>
                    <span class="text-muted ms-3 small preco-unitario" data-preco-unitario="${precoNumerico}">+10 disponíveis</span>
                </div>
            </div>
            <div class="text-end">
                <div class="text-success small">-10% <span class="text-muted text-decoration-line-through">R$ ${precoOriginal}</span></div>
                <div class="fw-bold fs-6">R$ ${precoFormatado}</div>
            </div>
        </div>`;
        lista.append(html);
    });

    $('#cart-count').text(cart.length);
}

function atualizaResumoCarrinho() {
    let subtotal = 0;
    let totalItensSelecionados = 0;
    let custoFrete = 0;
    let totalOriginal = 0;

    $('#listaDeProdutosCarrinho .list-group-item').each(function () {
        const $item = $(this);
        const $checkbox = $item.find('.item-checkbox');

        if ($checkbox.is(':checked')) {
            const precoUnitario = parseFloat($item.find('.preco-unitario').data('preco-unitario')) || 0;
            const quantidade = parseInt($item.find('.qtd-produto').text()) || 1;

            subtotal += precoUnitario * quantidade;
            totalItensSelecionados += quantidade;
            custoFrete += FRETE_POR_ITEM;

            const precoOriginal = precoUnitario * 1.10;
            totalOriginal += precoOriginal * quantidade;
        }
    });

    const total = subtotal + custoFrete;

    $('#subtotal-display').text(`R$ ${subtotal.toFixed(2)}`);
    $('#total-display').text(`R$ ${total.toFixed(2)}`);
    $('#total-itens-selecionados').text(`(${totalItensSelecionados})`);
    $('#original-total-display').text(`R$ ${totalOriginal.toFixed(2)}`);
}

$(document).ready(function () {
    loadCart();

    // checkbox individual
    $("#listaDeProdutosCarrinho").on("change", ".item-checkbox", function () {
        atualizaResumoCarrinho();
    });

    // select all
    $('#selectAll').on('change', function () {
        const isChecked = $(this).is(':checked');
        $('.item-checkbox').prop('checked', isChecked);
        atualizaResumoCarrinho();
    });

    // botões + e -
    $("#listaDeProdutosCarrinho").on("click", ".btn-qtd", function () {
        const index = $(this).data("index");
        const action = $(this).data("action");

        if (action === "increment") {
            cart[index].quantity++;
        } else if (action === "decrement" && cart[index].quantity > 1) {
            cart[index].quantity--;
        }

        saveCart();
        renderCart();
        atualizaResumoCarrinho();
    });

    // botão excluir
    $("#listaDeProdutosCarrinho").on("click", ".btn-remover", function (e) {
        e.preventDefault();
        const index = $(this).data("index");
        removeFromCart(index);
    });
});
</script>
