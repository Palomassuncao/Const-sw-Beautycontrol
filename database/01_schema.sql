CREATE DATABASE IF NOT EXISTS beautycontrol CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; USE beautycontrol; 

-- Tabela de Usuários 
CREATE TABLE usuarios ( 
id INT AUTO_INCREMENT PRIMARY KEY, 
nome VARCHAR(100) NOT NULL, 
cpf VARCHAR(14) UNIQUE, 
email VARCHAR(100) NOT NULL UNIQUE, 
telefone VARCHAR(20), 
senha VARCHAR(255) NOT NULL, 
perfil ENUM('admin', 'prestador', 'cliente') NOT NULL DEFAULT 'cliente', 
dados_bancarios VARCHAR(150) NULL, 
criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ); 

-- Tabela de Serviços 
CREATE TABLE servicos ( 
id INT AUTO_INCREMENT PRIMARY KEY, 
nome VARCHAR(100) NOT NULL, 
descricao TEXT, duracao_minutos INT NOT NULL, 
preco DECIMAL(10, 2) NOT NULL, 
id_admin INT, 
FOREIGN KEY (id_admin) REFERENCES usuarios(id) ); 

-- Tabela de Agenda e Disponibilidade 
CREATE TABLE agenda_prestador ( 
id INT AUTO_INCREMENT PRIMARY KEY, 
id_prestador INT NOT NULL, 
data_agenda DATE NOT NULL, 
hora_inicio TIME NOT NULL, 
hora_fim TIME NOT NULL, 
status ENUM('disponivel', 'bloqueado') NOT NULL DEFAULT 'disponivel', 
FOREIGN KEY (id_prestador) REFERENCES usuarios(id) ); 

-- Tabela de Agendamentos 
CREATE TABLE agendamentos ( 
id INT AUTO_INCREMENT PRIMARY KEY, 
id_cliente INT NOT NULL, 
id_prestador INT NOT NULL, 
id_servico INT NOT NULL, 
data_hora DATETIME NOT NULL, 
status ENUM('agendado', 'confirmado', 'cancelado', 'concluido') DEFAULT 'agendado', 
FOREIGN KEY (id_cliente) REFERENCES usuarios(id), 
FOREIGN KEY (id_prestador) REFERENCES usuarios(id), 
FOREIGN KEY (id_servico) REFERENCES servicos(id) );
