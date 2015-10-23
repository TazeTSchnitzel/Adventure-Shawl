<?php

namespace ajf\AdventureShawl;

require_once __DIR__ . '/../vendor/autoload.php';

\session_start();

$game = (require __DIR__ . '/../gameData/gameData.php');

if (isset($_SESSION['gameState'])) {
    try {
        $gameState = new GameState($game, $_SESSION['gameState']);
    } catch (GameStateException $e) {
        unset($_SESSION['gameState']);
        redirect('?error=' . urlencode($e->getMessage()));
    }
} else {
    $gameState = new GameState($game);
    $_SESSION['gameState'] = $gameState->serialise();
}

function redirect($url = '') {
    header('HTTP/1.1 302 Found');
    header('Location: /' . $url);
    die();
}

if (isset($_POST['command'])) {
    $command = canonicalise($_POST['command']);
    if ($gameState->performCommand($command)) {
        $_SESSION['gameState'] = $gameState->serialise();
        redirect();
    } else if ($command === 'restart game') {
        unset($_SESSION['gameState']);
        redirect();
    } else {
        redirect('?error=' . urlencode("You cannot \"$command\", traveller."));
    }
}

$title = 'Adventure Shawl';

$output = $title;
$output .= PHP_EOL;
$output .= str_repeat('-', strlen($title));
$output .= PHP_EOL;
$output .= PHP_EOL;
$output .= $gameState->getScenario();
$output .= PHP_EOL;
$output .= PHP_EOL;
$output .= 'What would you like to do?';
if (isset($_GET['error'])) {
    $output .= PHP_EOL;
    $output .= PHP_EOL;
    $output .= $_GET['error'];
}

// I really should use a template. But I'm lazy!

\header('Content-Type: text/html;charset=utf-8');

echo "<!doctype html>";
echo "<meta charset=utf-8>";
echo "<title>Adventure Shawl</title>";
echo "<link rel=stylesheet href=style.css>";

echo "<pre>";

echo \htmlspecialchars($output);

echo "<form method=post action=/>";
echo "&gt;<input type=text name=command id=command size=79>";
echo "</form>";

echo "</pre>";

echo "<script>document.getElementById('command').focus();</script>";
