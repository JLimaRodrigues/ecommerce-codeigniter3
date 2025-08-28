<!-- Carrinho -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Seu Carrinho</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <ul id="carrinho-itens" class="list-group list-group-flush mb-3"></ul>
        <div id="subtotal-display" class="text-end fw-bold mb-3">Subtotal: R$ 0,00</div>
        <button id="checkout-btn" class="btn btn-dark mt-auto">Pagar agora</button>
    </div>
</div>

<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">&copy; Ecommerce <?= date('Y') ?></p></div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<?= isset($scripts) ? $scripts : '' ?>
<script>
    function somenteNumero(e) {
        var key = e.which || e.keyCode;

        if ((key >= 48 && key <= 57) || key == 8 || key == 0 || key == 46 || (key >= 37 && key <= 40)) {
            return true;
        } else {
            return false;
        }
    }
</script>
<script src="<?= base_url('assets/carrinho.js') ?>"></script>

</body>
</html>
