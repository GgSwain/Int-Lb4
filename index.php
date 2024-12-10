<?php

$file_name = 'counter.txt';

// Перевіряємо, чи це запит до favicon.ico
if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
    // Ігноруємо запит
    header("HTTP/1.1 204 No Content");
    exit;
}

// Якщо файл не існує, створюємо його
if (!file_exists($file_name)) {
    file_put_contents($file_name, '0');
}

// Відкриваємо файл для читання та запису
$file = fopen($file_name, 'r+');

if ($file) {

    $file_size = filesize($file_name);

    // Читаємо поточний лічильник або встановлюємо 0, якщо файл порожній
    $count = ($file_size > 0) ? (int)fread($file, $file_size) : 0;

    $count++;

    rewind($file);

    fwrite($file, (string)$count);

    fclose($file);

    echo "Кількість відвідувань: $count";
} else {
    echo "Помилка при відкритті файлу.";
}
?>
