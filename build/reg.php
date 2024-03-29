<?php
session_start();
if (isset($_SESSION["id"])) {
    if ($_SESSION["id"] == 'ADMIN') {
        header('Location: admin/admin.php');
    } else {
        header('Location: cabinet.php');
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXChange - реєстрація</title>
    <link href="styles/reg.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/reg.js"></script>
</head>
<body>
<main>
    <h1>Реєстрація<br><small><a href="log.php">Уже є обліковий запис?</a></small></h1>
    <div class="status">
        <h2>Ваша акредитація:</h2>
        <div class="buttons">
            <input type="radio" id="jur" value="Юридична особа" name="status-button" form="register">
            <label for="jur">Юридична особа</label>
            <input type="radio" id="fiz" value="Фізична особа-підприємець" name="status-button" form="register">
            <label for="fiz">Фізична особа-підприємець</label>
        </div>
    </div>
    <form id="register" method="post" enctype="multipart/form-data" action="scripts/php/reg.php" style="display: none"></form>
</main>
</body>
</html>