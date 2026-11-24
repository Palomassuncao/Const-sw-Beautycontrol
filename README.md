# BeautyControl - Sistema de Gestão

## 👥 Equipe de Desenvolvimento:
* **Maria Aline Biazão de Souza** — RA: 130065
* **Paloma Vieira de Assunção** — RA: 70164

Instituição: Universidade Estadual de Maringá  /   Disciplina: Construção de Software

## Sobre o Projeto
O BeautyControl é Sistema web de gestão para salão de beleza, com foco em agendamentos online, controle de estoque e organização financeira.

## Funcionalidades Principais:

###Implementadas nesta etapa 3
* **Gerenciamento de Usuários:** Autenticação e controle de níveis de acesso (Administrador, Prestador de Serviço e Cliente).
* **Agendamentos Online:** Agendamento, reagendamento e cancelamento de horários, com verificação de disponibilidade de profissionais.
* **Gerenciamento de Prestadores e Clientes:** Controle de agendas atualizadas em tempo real.
* **Gestão do Catálogo de Serviços:** Cadastro de serviços com respectivos valores e tempo médio de duração.
* **Relatórios Gerenciais:** Efetuado parcialmente.

###Previstas para evoluções futuras
* **Controle de Estoque:** Monitoramento de entradas e saídas de produtos com alertas automáticos de quantidade mínima.
* **Vendas e Gestão Financeira:** Registro de vendas de serviços, múltiplos meios de pagamento (Pix, Cartão, Dinheiro) e emissão de comprovantes.
* **Notificações Automáticas:** Envio de lembretes e confirmações de agendamentos.

---

## 🛠️ Tecnologias Utilizadas
* **Frontend:** HTML5, CSS3, JavaScript e Bootstrap
* **Backend:** PHP (Arquitetura em Camadas e MVC)
* **Banco de Dados:** MySQL
* **Ambiente Local e Versionamento:** XAMPP (apache + mysql), Github

---

\## 📁 Estrutura de Diretórios Inicial (MVC) 
````text BeautyControl/ 
├── app/ 
│ ├── Controllers/ # Lógicas de controle de fluxo e rotas 
│ ├── Models/ # Regras de negócio e comunicação com MySQL 
│ └── Views/ # Interfaces web (HTML/CSS/JS) 
├── config/ # Arquivos de configuração e conexão com Banco de Dados
├── database/ #Arquivos mysql
├── public/ # Ponto de entrada (index.php) e ativos estáticos (CSS, JS, Imagens) 
└── README.md # Documentação principal do repositório
