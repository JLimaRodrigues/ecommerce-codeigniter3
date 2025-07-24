<script>
document.addEventListener('DOMContentLoaded', async () => { 

    if (typeof Carrinho !== 'undefined') {
        Carrinho.carregar({ quantidadeDefault: true });
        Carrinho.renderizarItensCarrinho();
        Carrinho.renderizarProdutosCarrinho();
        Carrinho.atualizarTotais();
    } else {
        console.error("Carrinho não está definido. Verifique se o script foi carregado corretamente.");
    }
})
</script>
