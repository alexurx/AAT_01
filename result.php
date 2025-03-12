<?php
$questions = json_decode(file_get_contents('data/questions.json'), true);
$username = trim($_POST['username'] ?? 'Аноним');
$userAnswers = $_POST['answers'] ?? [];

$correctCount = 0;
$totalQuestions = count($questions);

foreach ($questions as $index => $question) {
    $correctAnswers = $question['correct'];
    $userSelection = $userAnswers[$index] ?? [];
    if (!is_array($userSelection)) {
        $userSelection = [$userSelection];
    }
    sort($correctAnswers);
    sort($userSelection);
    if ($correctAnswers == $userSelection) {
        $correctCount++;
    }
}
$score = round(($correctCount / $totalQuestions) * 100, 2);

$results = json_decode(file_get_contents('data/results.json'), true);
$results[] = ['username' => $username, 'score' => $score];
file_put_contents('data/results.json', json_encode($results, JSON_PRETTY_PRINT));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Результаты теста</h1>
    <p>Имя: <?php echo htmlspecialchars($username); ?></p>
    <p>Правильных ответов: <?php echo $correctCount; ?> из <?php echo $totalQuestions; ?></p>
    <p>Процент: <?php echo $score; ?>%</p>
    <a class="btn" href="dashboard.php">Посмотреть результаты</a>
</body>
</html>
