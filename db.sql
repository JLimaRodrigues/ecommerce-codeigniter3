CREATE DATABASE ecommerce;

USE ecommerce;

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

CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    valor_total DECIMAL(10,2) NOT NULL,
    id_cupom INT,
    cep VARCHAR(9) NOT NULL,
    endereco TEXT,
    status VARCHAR(50) DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cupom) REFERENCES cupons(id_cupom)
);