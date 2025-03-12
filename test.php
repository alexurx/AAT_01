<?php

function sanitizeOutput($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

$questions = json_decode(file_get_contents('data/questions.json'), true);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div>
        <h1>Пройдите тест</h1>
        <form action="result.php" method="post">
            <label>
                Введите ваше имя (необязательно):
                <input type="text" name="username" class="username">
            </label>
            <br><br>
            <?php foreach ($questions as $index => $question): ?>
                <fieldset>
                    <legend><?php echo sanitizeOutput($question['question']); ?></legend>
                    <?php foreach ($question['answers'] as $i => $answer): ?>
                        <label>
                            <input type="<?php echo $question['type'] === 'single' ? 'radio' : 'checkbox'; ?>" 
                                name="answers[<?php echo $index; ?>][]" 
                                value="<?php echo $i; ?>">
                            <?php echo sanitizeOutput($answer); ?>
                        </label><br>
                    <?php endforeach; ?>
                </fieldset>
            <?php endforeach; ?>
            <button class="btn" type="submit">Отправить</button>
        </form>
    </div>
</body>
</html>
