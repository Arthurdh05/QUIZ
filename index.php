<?php
session_start();
include 'perguntas.php';

if (isset($_GET['acao']) && $_GET['acao'] === 'resetar') {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['iniciado'])) {
    if (isset($_GET['acao']) && $_GET['acao'] === 'iniciar') {
        $_SESSION['iniciado'] = true;
        $_SESSION['indice'] = 0;
        $_SESSION['pontuacao'] = 0;
        unset($_SESSION['feedback']);
        header("Location: index.php");
        exit();
    } else {
        include 'tela_inicial.php';
        exit();
    }
}

if (!isset($_SESSION['indice'])) $_SESSION['indice'] = 0;
if (!isset($_SESSION['pontuacao'])) $_SESSION['pontuacao'] = 0;

$indice = $_SESSION['indice'];
$totalPerguntas = count($perguntas);

if (isset($_GET['acao']) && $_GET['acao'] === 'proxima') {
    if (isset($_SESSION['feedback'])) {
        $_SESSION['indice']++;
        unset($_SESSION['feedback']);
    }
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $indice < $totalPerguntas) {
    $respostaUsuario = $_POST['resposta'] ?? null;
    $respostaCorreta = $perguntas[$indice]['resposta'];

    if ($respostaUsuario !== null) {
        if ((int)$respostaUsuario === (int)$respostaCorreta) {
            $_SESSION['pontuacao']++;
            $_SESSION['feedback'] = "🤠 Acertou!";
        } else {
            $_SESSION['feedback'] = "🥴 Errou! A resposta correta era: " .
                $perguntas[$indice]['opcoes'][$respostaCorreta];
        }
    }
    header("Location: index.php");
    exit();
}

$feedback = $_SESSION['feedback'] ?? null;

include 'quiz.php';
