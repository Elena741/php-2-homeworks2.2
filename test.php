<?php
$fileList = glob('uploads/*.json');
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
       h3 {
        margin: 0;
       }
       h4 {
        margin: 5px;
       }
       p {
        margin: 0;
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
   <p><label><input type=radio name="<?= $test[0]['items'][$i]['quest'] ?>" value="<?= $test[0]['items'][$i]['answers'][$k]['result'] ?>"><?= $test[0]['items'][$i]['answers'][$k]['answer'] ?></label></p>
    <?php
                
        }
}

?>
</fieldset>
<input type="submit" name="add" value="Отправить">
</form> 
 <?php
if (empty($_POST['add'])) {
        echo "Введите данные в форму";
} else {
        foreach ($_POST as $value) {
                $arrResult[] = $value;
        }
        $arrResult = array_sum($arrResult);
        
        $arrResultRight = array_sum($arrResultRight);
        
        if ($arrResult === $arrResultRight) {
                echo ' Отлично';
        } else {
                echo ' Попробуйте еще раз';
        }
}

?>