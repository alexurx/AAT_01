<?php
$results = json_decode(file_get_contents('data/results.json'), true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты тестов</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div>
        <h1>Результаты тестов</h1>
        <table border="1">
            <tr>
                <th>Имя</th>
                <th>Результат (%)</th>
            </tr>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td><?php echo htmlspecialchars($result['username']); ?></td>
                    <td><?php echo $result['score']; ?>%</td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php" class="btn">На главную</a>
    </div>
</body>
</html>