const Carrinho = (() => {
  let carrinho = [];

  const salvar = () => {
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    atualizarTotais();
  };

  const carregar = ({ quantidadeDefault = false } = {}) => {
    const dados = localStorage.getItem('carrinho');
    if (dados) {
      carrinho = JSON.parse(dados);
      if (quantidadeDefault) {
        carrinho = carrinho.map(item => ({
          ...item,
          quantidade: item.quantidade || 1
        }));
      }
    } else {
      carrinho = [];
    }
  };

  const adicionar = (produto) => {
    const existente = carrinho.find(item => item.nome_produto === produto.nome_produto);
    if (existente) {
      existente.quantidade++;
    } else {
      carrinho.push({ ...produto, quantidade: 1 });
    }
    salvar();
  };

  const remover = (index) => {
    carrinho.splice(index, 1);
    salvar();
  };

  const incrementarQuantidade = (index) => {
    if (carrinho[index]) {
      carrinho[index].quantidade++;
      salvar();
    }
  };

  const decrementarQuantidade = (index) => {
    if (carrinho[index] && carrinho[index].quantidade > 1) {
      carrinho[index].quantidade--;
      salvar();
    }
  };

  const retornarCarrinho = () => carrinho;

  const calcularSubtotal = () =>
    carrinho.reduce((total, item) => total + item.preco * item.quantidade, 0);

  const calcularTotalOriginal = () =>
    carrinho.reduce((total, item) => total + item.preco * 1.10 * item.quantidade, 0);

  const fadeOutIn = (element, novoHtml) => {
    element.classList.add('fade-out');
    setTimeout(() => {
      element.innerHTML = novoHtml;
      element.classList.remove('fade-out');
      element.classList.add('fade-in');
    }, 200);
  };

  const renderizarItensCarrinho = () => {
    const container = document.getElementById('carrinho-itens');
    if (!container) return;

    let html = '';
    carrinho.forEach((item, index) => {
      html += `
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>${item.nome_produto}</span>
          <span>
            <button onclick="Carrinho.decrementarQuantidade(${index}); Carrinho.renderizarItensCarrinho()" class="btn btn-sm btn-secondary">-</button>
            <span class="mx-2">${item.quantidade}</span>
            <button onclick="Carrinho.incrementarQuantidade(${index}); Carrinho.renderizarItensCarrinho()" class="btn btn-sm btn-secondary">+</button>
            R$ ${(item.preco * item.quantidade).toFixed(2)}
            <button onclick="Carrinho.remover(${index}); Carrinho.renderizarItensCarrinho()" class="btn btn-sm btn-danger ml-2"><i class="bi bi-trash-fill"></i></button>
          </span>
        </li>`;
    });

    fadeOutIn(container, html);

    atualizarTotais();
  };

  function atualizarTotais() {
    const carrinho = Carrinho.retornarCarrinho();
    const subtotal = carrinho.reduce((total, item) => total + (item.preco * item.quantidade), 0);
    const totalOriginal = carrinho.reduce((total, item) => total + (item.preco * 1.10 * item.quantidade), 0);
  
    const elSubtotal = document.getElementById('subtotal-display');
    if (elSubtotal) elSubtotal.textContent = `R$ ${subtotal.toFixed(2)}`;

    const elOriginal = document.getElementById('original-total-display');
    if (elOriginal) elOriginal.textContent = `R$ ${totalOriginal.toFixed(2)}`;

    const elTotal = document.getElementById('total-display');
    if (elTotal) elTotal.textContent = `R$ ${subtotal.toFixed(2)}`;

    const elQtdItens = document.getElementById('total-itens-selecionados');
    if (elQtdItens) elQtdItens.textContent = carrinho.length;
  }

  const renderizarProdutosCarrinho = () => {
    const container = document.getElementById('listaDeProdutosCarrinho');
    if (!container) return;
  
    let html = '';
    carrinho.forEach((item, index) => {
        const precoNumerico = parseFloat(item.preco) || 0;
        const precoOriginal = (precoNumerico * 1.10).toFixed(2);
        const precoFormatado = precoNumerico.toFixed(2);

      html += `
        <div class="list-group-item d-flex align-items-start">
            <input class="form-check-input me-3 mt-2 item-checkbox" type="checkbox" checked data-index="${index}">
            <img src="https://dummyimage.com/80x80/dee2e6/6c757d" class="me-3" alt="Produto" style="width: 80px; height: 80px; object-fit: cover;">
            <div class="flex-grow-1">
                <div class="fw-bold">${item.nome_produto}</div>
                <a href="#" class="text-danger small btn-remover" data-index="${index}">Excluir</a>
                <div class="mt-2 d-flex align-items-center">
                    <button class="btn btn-outline-secondary btn-sm btn-qtd" data-action="decrement" data-index="${index}">-</button>
                    <span class="mx-2 qtd-produto">${item.quantidade}</span>
                    <button class="btn btn-outline-secondary btn-sm btn-qtd" data-action="increment" data-index="${index}">+</button>
                    <span class="text-muted ms-3 small preco-unitario" data-preco-unitario="${precoNumerico}">+10 disponíveis</span>
                </div>
            </div>
            <div class="text-end">
                <div class="text-success small">-10% <span class="text-muted text-decoration-line-through">R$ ${precoOriginal}</span></div>
                <div class="fw-bold fs-6">R$ ${precoFormatado}</div>
            </div>
        </div>
      `;
    });
  
    container.innerHTML = html;
    atualizarTotais();
  };

  return {
    carregar,
    salvar,
    adicionar,
    remover,
    retornarCarrinho,
    incrementarQuantidade,
    decrementarQuantidade,
    calcularSubtotal,
    calcularTotalOriginal,
    renderizarItensCarrinho,
    atualizarTotais,
    renderizarProdutosCarrinho
  };
})()
