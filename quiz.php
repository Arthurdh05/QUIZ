<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mini Quiz Backend</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

<?php if ($indice >= $totalPerguntas): ?>
    <h2>QUIZ FINALIZADO!</h2>
    <p>Sua pontuação final foi: <strong><?= $_SESSION['pontuacao'] ?> / <?= $totalPerguntas ?></strong></p>
    <a href="index.php?acao=resetar" class="botao">Reiniciar Quiz</a>

<?php else: ?>
    <h2>Pergunta <?= $indice + 1 ?> de <?= $totalPerguntas ?></h2>
    <p><?= htmlspecialchars($perguntas[$indice]['pergunta'], ENT_QUOTES, 'UTF-8') ?></p>

    <?php if (!$feedback): ?>
        <form method="post">
            <?php foreach ($perguntas[$indice]['opcoes'] as $key => $opcao): ?>
                <label class="opcao">
                    <input type="radio" name="resposta" value="<?= $key ?>" required>
                    <?= htmlspecialchars($opcao, ENT_QUOTES, 'UTF-8') ?>
                </label>
            <?php endforeach; ?>
            <button type="submit">Responder</button>
        </form>
    <?php else: ?>
        <p class="feedback"><?= $feedback ?></p>
        <a href="index.php?acao=proxima" class="botao">Próxima Pergunta</a>
    <?php endif; ?>
<?php endif; ?>

</div>
</body>
</html>
