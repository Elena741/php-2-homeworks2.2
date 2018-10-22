<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
     <style>
        div {
            width: 400px;
            border: 1px solid black;
            padding: 30px;
        }
    </style>
    <title>Загрузить тест</title>
</head>
<body>

    <div>
        <p>Загрузите ваш тест - файл с расширением JSON</p>

<?php
if (isset($_POST) && isset($_FILES) && isset($_FILES['testfile'])) {
    $fileName = $_FILES['testfile']['name'];
    $tmpFile = $_FILES['testfile']['tmp_name'];
    $uploadsDir = 'uploads/';

    $pathInfo = pathinfo($uploadsDir . $fileName);

    if ($pathInfo['extension'] === 'json') {
        move_uploaded_file($tmpFile, $uploadsDir . $fileName);
        ?>
        <p>Спасибо, Ваш тест загружен!</p>
        <?php
    } else {
        ?>
        <p>Извините, нужен файл с расширением JSON</p>
        <?php
    }        
}   
?>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="testfile">
            <input type="submit" value="Загрузить">
        </form>

        <p>Выберите тест для прохождения</p>
        <ul>
            <li><a href="list.php">Список тестов</a></li>
        </ul>
    </div>

</body>
</html>