<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - BeautyControl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h1">BeautyControl</span>
        <div class="d-flex align-items-center text-white gap-3">
            <span>Olá, <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong> (<?= htmlspecialchars($_SESSION['usuario_perfil']) ?>)</span>
            <a href="index.php?acao=logout" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="mb-4">Menu Principal</h3>

        <div class="row g-3">
            <?php if ($_SESSION['usuario_perfil'] === 'admin'): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm p-3 h-100">
                        <h5>Usuários</h5>
                        <p class="text-muted">Cadastrar administradores, prestadores e clientes.</p>
                        <a href="index.php?acao=cadastrarUsuario" class="btn btn-primary mt-auto">Cadastrar usuário</a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-md-4">
                <div class="card shadow-sm p-3 h-100">
                    <h5>Serviços</h5>
                    <p class="text-muted">Consultar o catálogo de serviços, valores e durações.</p>
                    <a href="index.php?acao=servicos" class="btn btn-primary mt-auto">Acessar serviços</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-3 h-100">
                    <h5>Agendamentos</h5>
                    <p class="text-muted">Visualizar horários, agendar ou cancelar atendimentos.</p>
                    <a href="index.php?acao=agendamentos" class="btn btn-primary mt-auto">Acessar agendamentos</a>
                </div>
            </div>

            <?php if ($_SESSION['usuario_perfil'] === 'admin'): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm p-3 h-100">
                        <h5>Relatórios</h5>
                        <p class="text-muted">Consultar faturamento, serviços realizados e desempenho.</p>
                        <a href="index.php?acao=relatorios" class="btn btn-primary mt-auto">Acessar relatórios</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>