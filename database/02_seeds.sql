USE beautycontrol; 
 
INSERT INTO usuarios (nome, cpf, email, telefone, senha, perfil, dados_bancarios) VALUES 
('Paloma Admin', '111.111.111-11', 'admin@beautycontrol.com', '(44) 99999-0001', '123456', 'admin', NULL), 
('Maria Aline Prestadora', '222.222.222-22', 'prestador@beautycontrol.com', '(44) 99999-0002', '123456', 'prestador', 'Banco Teste - Ag 0001 CC 12345-6'), 
('Ana Cliente', '333.333.333-33', 'cliente@beautycontrol.com', '(44) 99999-0003', '123456', 'cliente', NULL); 

INSERT INTO servicos (nome, descricao, duracao_minutos, preco, id_admin) VALUES 
('Corte de Cabelo Feminino', 'Corte completo com lavagem e finalização', 60, 80.00, 1), 
('Manicure Simples', 'Cutilagem e esmaltação tradicional', 45, 35.00, 1), 
('Design de Sobrancelhas', 'Modelagem com pinça e linha', 30, 45.00, 1); 

INSERT INTO agenda_prestador (id_prestador, data_agenda, hora_inicio, hora_fim, status) VALUES 
(2, '2026-11-25', '09:00:00', '12:00:00', 'disponivel'), 
(2, '2026-11-25', '12:00:00', '13:00:00', 'bloqueado'), 
(2, '2026-11-25', '13:00:00', '18:00:00', 'disponivel');
