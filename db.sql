CREATE DATABASE IF NOT EXISTS ecommerce CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ecommerce;

CREATE TABLE perfis (
    id_perfil INT AUTO_INCREMENT PRIMARY KEY,
    nome_perfil VARCHAR(50) NOT NULL UNIQUE,
    descricao TEXT
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cpf VARCHAR(14) UNIQUE,
    genero ENUM('masculino','feminino','outro','nao_informado') DEFAULT 'nao_informado',
    data_nascimento DATE DEFAULT NULL,
    preferencias_json JSON DEFAULT NULL,
    data_ultimo_login DATETIME DEFAULT NULL,
    is_ativo BOOLEAN DEFAULT TRUE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_perfil INT DEFAULT 1
);

CREATE TABLE enderecos (
    id_endereco INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    cep VARCHAR(9) NOT NULL,
    rua VARCHAR(255) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    complemento VARCHAR(255),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    estado VARCHAR(2),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE formas_pagamento (
    id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    dados TEXT NOT NULL,
    apelido VARCHAR(100),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE cupons (
    id_cupom INT AUTO_INCREMENT PRIMARY KEY,
    nome_cupom VARCHAR(255) NOT NULL,
    valor_minimo DECIMAL(10,2) NOT NULL,
    validade DATE NOT NULL
);

CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);

CREATE TABLE estoque (
    id_estoque INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    variacao VARCHAR(255),
    quantidade INT NOT NULL DEFAULT 0,
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);

CREATE TABLE imagens_produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    url_imagem TEXT NOT NULL,
    destaque BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);

CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    id_cupom INT,
    cep VARCHAR(9) NOT NULL,
    endereco TEXT,
    status VARCHAR(50) DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cupom) REFERENCES cupons(id_cupom),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE pedido_produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    variacao VARCHAR(255),
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);

CREATE TABLE historico_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    status VARCHAR(50) NOT NULL,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido)
);

CREATE TABLE carrinho (
    id_carrinho INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    session_id VARCHAR(255),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE carrinho_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_carrinho INT NOT NULL,
    id_produto INT NOT NULL,
    variacao VARCHAR(255),
    quantidade INT NOT NULL,
    FOREIGN KEY (id_carrinho) REFERENCES carrinho(id_carrinho),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);

CREATE TABLE log_acesso (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    ip VARCHAR(45),
    user_agent TEXT,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

INSERT INTO produtos (nome_produto, preco) VALUES
('Camiseta Básica', 49.90),
('Calça Jeans Slim', 129.99),
('Tênis Esportivo', 199.50),
('Fone de Ouvido Bluetooth', 89.00),
('Mochila Escolar', 75.00),
('Casaco Moletom', 120.00),
('Bermuda Cargo', 100.00),
('Calça Jeans Skinny', 129.99),
('Tênis de Marca', 350.00),
('Barbeador Elétrico', 20.00),
('Óculos Escuro', 50.00),
('Cueca Box', 29.99),
('Sapato social', 20.00),
('Boné', 20.00),
('Gorro', 20.00),
('Meia', 15.00);

INSERT INTO estoque (id_produto, variacao, quantidade) VALUES
(1, 'P - Preto', 50),
(1, 'M - Branco', 75),
(1, 'G - Azul', 60),
(2, 'Tam 38 - Azul Escuro', 30),
(2, 'Tam 40 - Azul Escuro', 45),
(3, 'Tam 41 - Preto', 20),
(3, 'Tam 42 - Branco', 25),
(4, 'Único - Preto', 100),
(5, 'Único - Vermelho', 40),
(5, 'Único - Azul', 35);

INSERT INTO perfis (nome_perfil, descricao) VALUES
('usuario', 'Cliente comum que faz compras'),
('vendedor', 'Usuário que pode cadastrar e vender seus produtos'),
('admin', 'Administrador do sistema, com acesso à gestão de produtos, usuários e pedidos'),
('superadmin', 'Acesso irrestrito ao sistema. Pode alterar tudo, inclusive os admins');