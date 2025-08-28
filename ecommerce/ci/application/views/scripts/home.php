<script>
document.addEventListener('DOMContentLoaded', async () => {
  const itensPorPagina = 6;
  let paginaAtual = 0;
  let maximoPorPagina = 0;
  let estaCarregando = false;
  let produtos = [];

  const listaDeProdutos = document.getElementById('lista-produtos');
  if (!listaDeProdutos) return;

  Carrinho.carregar();
  Carrinho.renderizarItensCarrinho();

  try {
    const response = await fetch('<?= base_url("produto/listar") ?>');
    produtos = await response.json();

    maximoPorPagina = Math.ceil(produtos.length / itensPorPagina) - 1;

    renderizarProdutos(paginaAtual);
    scrollPaginacao();
  } catch (error) {
    listaDeProdutos.innerHTML = `<p class="text-danger">Erro ao carregar produtos.</p>`;
    console.error('Erro:', error);
  }

  function renderizarProdutos(paginaAtual) {
    const inicio = paginaAtual * itensPorPagina;
    const fim = inicio + itensPorPagina;
    const itensAtuais = produtos.slice(inicio, fim);

    let html = '';

    itensAtuais.map(produto => {

    const precoNumerico = parseFloat(produto.preco) || 0;
    const precoOriginal = (precoNumerico * 1.10).toFixed(2);
    const precoFormatado = precoNumerico.toFixed(2);
    
    html += `
      <div class="col mb-5">
        <div class="card h-100">
          <img class="card-img-top" src="${produto.imagem || 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg'}" alt="${produto.nome_produto}" />
          <div class="card-body p-4">
            <div class="text-center">
              <h5 class="fw-bolder">${produto.nome_produto}</h5>
              <div class="text-success small">-10% <span class="text-muted text-decoration-line-through">R$ ${precoOriginal}</span></div>
              R$ ${precoFormatado}
            </div>
          </div>
          <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
              <button class="btn btn-outline-dark mt-auto adicionar-carrinho" data-produto='${JSON.stringify(produto)}'>
                <i class="bi bi-cart-plus"></i> Adicionar ao Carrinho
              </button>
            </div>
          </div>
        </div>
      </div>
    `
  })

    listaDeProdutos.style.opacity = 0;
    setTimeout(() => {
      listaDeProdutos.innerHTML = html;
      listaDeProdutos.style.opacity = 1;
      adicionarListenersCarrinho();
    }, 200);
  }

  function adicionarListenersCarrinho() {
    document.querySelectorAll('.adicionar-carrinho').forEach(botao => {
      botao.addEventListener('click', function () {
        console.log('clicado');
        const produto = JSON.parse(this.dataset.produto);
        Carrinho.adicionar(produto);
        Carrinho.renderizarItensCarrinho();
      });
    });
  }

  function scrollPaginacao() {
    window.addEventListener('wheel', e => {
      if (estaCarregando) return;

      const delta = e.deltaY;
      if (delta > 0 && paginaAtual < maximoPorPagina) {
        paginaAtual++;
        estaCarregando = true;
        renderizarProdutos(paginaAtual);
      } else if (delta < 0 && paginaAtual > 0) {
        paginaAtual--;
        estaCarregando = true;
        renderizarProdutos(paginaAtual);
      }

      setTimeout(() => {
        estaCarregando = false;
      }, 300);
    });
  }

  const registrarCarrinho = async () => {
    const carrinhoLocal = Carrinho.retornarCarrinho();

    if (carrinhoLocal.length === 0) {
      alert('Carrinho vazio');
      return null;
    }

    const carrinho = {
      id_usuario: <?= $this->session->userdata('usuario_logado')['id'] ?? 'null' ?>,
      produtos: carrinhoLocal
    };

    try {
      const response = await fetch('<?= base_url("carrinho/salvar_carrinho") ?>', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(carrinho)
      });

      const result = await response.json();
      return result;
    } catch (e) {
      console.error("Erro ao salvar carrinho:", e);
      return null;
    }
  };

  $('#checkout-btn').on('click', async function () {
      const result = await registrarCarrinho();
      <?php if (usuario_logado()): ?>
        if (result && result.status === 200) {
           window.location.href = '<?= base_url("carrinho") ?>';
         } else {
          alert("Erro ao salvar o carrinho.");
        }
      <?php else: ?>
        //console.log(result)
        window.location.href = '<?= base_url("login") ?>?redirect=carrinho';
      <?php endif; ?>
  });
});
</script>
