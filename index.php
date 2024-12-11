<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Лічильник відвідувань</title>
</head>
<body>
    <div class="counter-container">
        <h1>Лічильник відвідувань</h1>
        <p>
            <?php

            $file_name = 'counter.txt';

            if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
                header("HTTP/1.1 204 No Content");
                exit;
            }

            if (!file_exists($file_name)) {
                file_put_contents($file_name, '0');
            }

            $file = fopen($file_name, 'r+');

            if ($file) {
                $file_size = filesize($file_name);
                $count = ($file_size > 0) ? (int)fread($file, $file_size) : 0;
                $count++;
                rewind($file);
                fwrite($file, (string)$count);
                fclose($file);

                echo "Кількість відвідувань: <strong>$count</strong>";
            } else {
                echo "<strong>Помилка при відкритті файлу.</strong>";
            }
            ?>
        </p>
    </div>
</body>
</html>