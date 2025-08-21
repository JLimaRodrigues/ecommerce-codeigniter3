<script>
document.addEventListener('DOMContentLoaded', async () => { 

    if (typeof Carrinho !== 'undefined') {
        Carrinho.carregar({ quantidadeDefault: true });
        Carrinho.renderizarItensCarrinho();
        Carrinho.renderizarProdutosCarrinho();
        Carrinho.atualizarTotais();

        const checkboxes = document.querySelectorAll('.item-checkbox');
        Array.from(checkboxes).map(checkbox => {
            checkbox.addEventListener('change', () => {
                const idsRemovidos   = [];
                const idsAdicionados = [];
                checkboxes.forEach(checkbox => {
                    if(!checkbox.checked){
                        const idProduto = checkbox.dataset.index;
                        idsRemovidos.push(idProduto);
                    } else if (checkbox.checked){
                        const idProduto = checkbox.dataset.index;
                        idsAdicionados.push(idProduto);
                    }
                });

                idsRemovidos.map(idRemovido => {
                    Carrinho.remover(idRemovido);
                    Carrinho.atualizarTotais();
                })

                idsAdicionados.map(idAdicionado => {
                    const container = document.querySelector(`[produto-id="${idAdicionado}"]`);

                    //Carrinho.adicionar(idAdicionado);
                    const nome = container.querySelector('.nome-produto')?.textContent.trim();
                    const quantidade = parseInt(container.querySelector('.qtd-produto')?.textContent.trim() || '1', 10);
                    const precoText = container.querySelector('.valor-produto')?.textContent.replace(/[^\d,]/g, '').replace(',', '.');
                    const preco = parseFloat(precoText);

                    const produto = {
                        id_produto: idAdicionado,
                        nome_produto: nome,
                        quantidade: quantidade,
                        preco: preco,
                    };

                    console.log(produto)
                    // Carrinho.atualizarTotais();
                })
            });
        });

        const continuarCompra = document.getElementById('continuar-compra');
        continuarCompra.addEventListener('click', () => {
            console.log('estou aqui');

            const carrinho = Carrinho.retornarCarrinho();

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'http://localhost:8080/ecommerce/continuar-compra';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'data';
            input.value = JSON.stringify(carrinho);

            form.appendChild(input);
            document.body.appendChild(form);

            form.submit();
        });
    } else {
        console.error("Carrinho não está definido. Verifique se o script foi carregado corretamente.");
    }
})
</script>
