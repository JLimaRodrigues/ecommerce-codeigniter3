CREATE DATABASE IF NOT EXISTS ecommerce CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ecommerce;

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
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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

INSERT INTO usuarios (nome, email, senha_hash, telefone, cpf, genero, data_nascimento, preferencias_json, is_ativo) VALUES
('Stella Betina Valentina Monteiro', 'stellabetinamonteiro@charquesorocaba.com.br', MD5('nhFPRwDz03'), '(82) 98566-0432', '040.774.320-06', 'feminino', '1974-06-12', '', TRUE),
('Benedito Benedito Almeida', 'beneditobeneditoalmeida@sitran.com.br', MD5('OoZrAHiF0U'), '(61) 98321-3194', '287.331.284-05', 'masculino', '1951-07-20', '', TRUE),
('Silvana Andreia Ayla Aragão', 'silvana_andreia_aragao@marcossousa.com', MD5('qX0lksf302'), '(98) 99577-9669', '884.483.018-38', 'feminino', '1949-04-25', '', TRUE),
('Edson Marcos Márcio Barbosa', 'edsonmarcosbarbosa@quarttus.com.br', MD5('5Wd8FLQ77j'), '(53) 99226-8932', '383.289.656-23', 'masculino', '2003-04-17', '', TRUE),
('Emilly Alana das Neves', 'emilly_alana_dasneves@cafefrossard.com', MD5('3g83detOt2'), '(41) 98414-3269', '444.511.354-94', 'feminino', '1969-02-23', '', TRUE),
('Felipe Giovanni Santos', 'felipe-santos87@iquattro.com.br', MD5('oaEOdii6mk'), '(68) 99886-7009', '911.361.528-90', 'masculino', '1987-07-09', '', TRUE),
('Augusto Benjamin Cauê Carvalho', 'augustobenjamincarvalho@evolink.com.br', MD5('fp5O91um1u'), '(11) 99490-8472', '943.623.997-12', 'masculino', '1985-06-11', '', TRUE),
('Bruna Beatriz Campos', 'brunabeatrizcampos@wizardararaquara.com.br', MD5('Ia9SmCcrru'), '(51) 99153-1052', '690.780.541-31', 'feminino', '1967-03-01', '', TRUE),
('Marina Catarina Luzia da Silva', 'marinacatarinadasilva@cenia.com.br', MD5('jsQus2pS2O'), '(95) 98963-1008', '192.675.041-18', 'feminino', '1991-04-23', '', TRUE),
('Daiane Alana Freitas', 'daiane-freitas74@heinrich.com.br', MD5('h6GerpOtBr'), '(95) 99195-0891', '633.555.945-55', 'feminino', '1991-02-08', '', TRUE),
('Daniela Alana Fabiana da Rosa', 'daniela_alana_darosa@dpi.ig.br', MD5('cbm8nXg0xW'), '(17) 98260-2012', '073.232.692-37', 'feminino', '1991-03-05', '', TRUE),
('Bryan Danilo Oliveira', 'bryan_oliveira@supercarioca.com', MD5('KRO2P61ewH'), '(81) 3879-7018', '340.924.034-96', 'masculino', '1948-02-21', '', TRUE),
('Carlos Eduardo Theo Novaes', 'carlos_novaes@amaralmonteiro.com.br', MD5('2Jq3ziksY0'), '(68) 98113-4468', '517.171.283-27', 'masculino', '1955-05-01', '', TRUE),
('Elza Malu Corte Real', 'elzamalucortereal@startingfitness.com.br', MD5('TqOOE82O7f'), '(84) 98383-6966', '953.266.381-93', 'feminino', '1987-02-26', '', TRUE),
('Mariah Sophia Julia dos Santos', 'mariah.sophia.dossantos@fanger.com.br', MD5('zajBBUwJdI'), '(63) 98850-1058', '063.312.019-71', 'feminino', '1983-03-02', '', TRUE);

INSERT INTO produtos (nome_produto, preco) VALUES
('Camiseta Básica', 49.90),
('Calça Jeans Slim', 129.99),
('Tênis Esportivo', 199.50),
('Fone de Ouvido Bluetooth', 89.00),
('Mochila Escolar', 75.00);

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