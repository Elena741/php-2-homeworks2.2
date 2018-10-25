<?php
$fileList = glob('uploads/*.json');
if (!isset($_GET['test'])) {
?>
     <p>Такого теста не существует</p>
      <p><a href="list.php">Список тестов</a></p>
<?php
    exit;
}
foreach ($fileList as $key => $file) {
    if ($key == $_GET['test']) {
        $fileTest = file_get_contents($fileList[$key]);
        $decodeFile = json_decode($fileTest, true);
        $test = $decodeFile;
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
    body {
        padding: 10px 20px;
    }
       fieldset {
        margin-bottom: 10px;          
       }
       .add {
        margin-bottom: 10px;
       }
       h3 {
        margin: 0;
       }
       h4 {
        margin: 5px;
       }
       p {
        margin: 0;
       }
       label {
        margin-right: 10px; 
       }
    </style>
    <title>Тесты</title>
</head>
<body>
  <form action="" method="post" enctype=multipart/form-data>
    <fieldset>
      <legend><h3><?= $test[0]['question'] ?></h3></legend>

<?php
for ($i = 0; $i < count($test[0]['items']); $i++) {
?>
     <p><h4><?= $test[0]['items'][$i]['quest'] ?></h4></p>
    <?php
    for ($k = 0; $k < count($test[0]['items'][$i]['answers']); $k++) {
        $arrResultRight[] = $test[0]['items'][$i]['answers'][$k]['result'];
?>
     <label><input type=radio name="<?= $i ?>" value="<?= $test[0]['items'][$i]['answers'][$k]['answer'] ?>"><?= $test[0]['items'][$i]['answers'][$k]['answer'] ?></label>
    <?php
    }
}
?>
   </fieldset>
    <input class="add" type="submit" name="add" value="Отправить">
  </form> 
 <?php
if (empty($_POST['add'])) {
?>
     <p>Введите данные в форму</p>
      <p><a href="list.php">Список тестов</a></li></p>
<?php
    exit;
} else {
    foreach ($test[0]['items'] as $key => $value) {
        for ($i = 0; $i < count($_POST); $i++) {
            if ($i == $key) {
                for ($k = 0; $k < count($test[0]['items'][$i]['answers']); $k++) {
                    if ($_POST[$i] === $test[0]['items'][$i]['answers'][$k]['answer']) {
                        $arrResult[] = $test[0]['items'][$i]['answers'][$k]['result'];
                    }
                }
            }
        }
    }
}
$arrResult = array_sum($arrResult);
$arrResultRight = array_sum($arrResultRight);
if ($arrResult === $arrResultRight) {
?>
     <h4>Отлично</h4>
<?php
} else {
?>
     <h4>Попробуйте еще раз</h4>
<?php
}
?>
 <a href="list.php">Список тестов</a></li>

</body>
</html>