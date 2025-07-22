
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <?= isset($scripts) ? $scripts : '' ?>
    <?php if (!empty($telaAtiva)): ?>
        <script>
        $(document).ready(function () {
            $('#tabela-<?= $telaAtiva ?>').DataTable({
            language: {
                url: "<?= base_url('assets/dataTablesPT-BR.json') ?>"
            }
            });
        });
        </script>
    <?php endif; ?>
</body>
</html>