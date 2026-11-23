<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Usuários - BeautyControl</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow p-4 mx-auto" style="max-width: 550px;">

            <h3 class="text-center mb-4">
                Cadastro de Usuários
            </h3>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($sucesso)): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($sucesso) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?acao=cadastrarUsuario">

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">CPF</label>
                    <input type="text" name="cpf"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefone</label>
                    <input type="text" name="telefone"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha"
                           class="form-control" minlength="6" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Perfil de acesso</label>

                    <select name="perfil" class="form-select" required>
                        <option value="">Selecione</option>
                        <option value="admin">Administrador</option>
                        <option value="prestador">Prestador</option>
                        <option value="cliente">Cliente</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Cadastrar usuário
                </button>

            </form>

            <a href="index.php?acao=painel"
               class="btn btn-secondary w-100 mt-3">
                Voltar ao painel
            </a>

        </div>

    </div>

</body>
</html>