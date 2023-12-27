<?php
include 'config.php';

global $conn;
foreach ($_POST as $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($conn, $value);
}
if (isset($_GET['id'])) {
    // Декодируем значение id
    $idToDelete = urldecode($_GET['id']);

    if (is_numeric($idToDelete)) {
        // Удаление записи
        if ($conn) {
            $deleteQuery = "DELETE FROM mess WHERE id = $idToDelete";
            $result = mysqli_query($conn, $deleteQuery);

            if ($result) {
                echo "Запись успешно удалена.";
                echo "Record deleted successfully <a href='http://less7/'>Главная стра....</a>"; 
                exit();
            } else {
                echo "Ошибка при удалении записи: " . mysqli_error($conn);
            }
        } else {
            echo "Ошибка соединения с базой данных.";
        }
    } else {
        echo "Неверный формат идентификатора. Декодированное значение: $idToDelete";
    }
} else {
    echo "Идентификатор не передан в URL.";
}
