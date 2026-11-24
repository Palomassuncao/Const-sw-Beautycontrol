<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - BeautyControl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Catálogo de Serviços</h3>
            <a href="index.php?acao=painel" class="btn btn-secondary">Voltar ao painel</a>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
        <?php endif; ?>

        <?php if ($_SESSION['usuario_perfil'] === 'admin'): ?>
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="mb-3">Novo Serviço</h5>
                <form method="POST" action="index.php?acao=servicos" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Nome do serviço</label>
                        <input type="text" name="nome" class="form-control" required placeholder="Ex: Corte Feminino">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Duração (min)</label>
                        <input type="number" name="duracao_minutos" class="form-control" min="1" required placeholder="60">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Preço (R$)</label>
                        <input type="text" name="preco" class="form-control" required placeholder="80.00">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Descrição</label>
                        <input type="text" name="descricao" class="form-control" placeholder="Detalhes opcionais do serviço">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Cadastrar serviço</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm p-4">
            <h5 class="mb-3">Serviços Disponíveis</h5>
            <?php if (empty($servicos)): ?>
                <p class="text-muted mb-0">Nenhum serviço cadastrado até o momento.</p>
            <?php else: ?>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Serviço</th>
                            <th>Descrição</th>
                            <th>Duração</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicos as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['nome']) ?></td>
                                <td><?= htmlspecialchars($s['descricao'] ?? '') ?></td>
                                <td><?= (int) $s['duracao_minutos'] ?> min</td>
                                <td>R$ <?= number_format((float) $s['preco'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>