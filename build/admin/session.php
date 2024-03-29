<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 03.04.2017
 * Time: 18:33
 */
session_start();
if ($_SESSION["id"] !== 'ADMIN' || !isset($_POST["sellers"])) {
    session_unset();
    session_destroy();
    header('Location: /index.php');
    die();
}
mb_internal_encoding("UTF-8");
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$userPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $userPassword, $db);

function get24hTime() {
    $time = null;
    if (date("a") === 'pm') {
        switch (date("h")) {
            case '01':
                $time = '13:' . date("i:s");
                break;
            case '02':
                $time = '14:' . date("i:s");
                break;
            case '03':
                $time = '15:' . date("i:s");
                break;
            case '04':
                $time = '16:' . date("i:s");
                break;
            case '05':
                $time = '17:' . date("i:s");
                break;
            case '06':
                $time = '18:' . date("i:s");
                break;
            case '07':
                $time = '19:' . date("i:s");
                break;
            case '08':
                $time = '20:' . date("i:s");
                break;
            case '09':
                $time = '21:' . date("i:s");
                break;
            case '10':
                $time = '22:' . date("i:s");
                break;
            case '11':
                $time = '23:' . date("i:s");
                break;
            default:
                $time = date("h:i:s");
        }
    } else {
        $time = date("h:i:s");
    }
    return $time;
}

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних!');
}

$connection->set_charset('utf8');
$sellers = explode(',', $_POST["sellers"]);
$amount = count($sellers);
$sql = 'SELECT id FROM lots WHERE seller_name=\'' . $sellers[0] . '\'';
if ($amount > 1) {
    for ($i = 1; $i <= $amount; $i++) {
        $sql .= ' OR seller_name=\'' . $sellers[$i] . '\'';
    }
}
$result = $connection->query($sql);
$sql = 'SELECT session_active FROM trade';
$active = $connection->query($sql)->fetch_assoc()["session_active"];
if ($active == 0) {
    $message =
        '<p class="message admin">' .
        '<span class="time">' . get24hTime() . '</span>' .
        '<span>Доброго дня.<br>
        Вітаємо на електронних торгах з продажу дров паливних, які вже заготовлені та чекають на свого покупця на території Ужгородського ЛГ.<br>
        1. Для підтвердження бажання придбати лот, після повідомлення ліцитатора про початок торгу по відповідному лоту натисніть кнопку «ТОРГУВАТИСЯ».<br>
        2. Підвищити ціну можна двома способами: підняття на певну кількість кроків, або до певної ціни.<br>
        3. Всі дії користувачів відображаються в чаті зліва.<br>
        4. Якщо ви бажаєте покинути торги, натисніть кнопку «НЕ ТОРГУВАТИСЯ»<br>
        5. Інформація про переможця відображається в чаті.
         </span>' .
        '</p>';
    $chat = fopen('../assets/auction-chat.html', 'a');
    fwrite($chat, $message);
    fclose($chat);
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Сесія торгів</title>
    <link href="styles/session.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/session.js"></script>
</head>
<body>
<main>
    <ul class="users"></ul>
    <p class="timer"></p>
    <table class="auction-table"></table>
    <p class="admin-info"></p>
    <button class="add-step">+</button>
    <button class="remove-step">-</button>
    <span class="set-final-cost">
        <label for="set-final-cost">Остаточна: </label>
        <input type="number" id="set-final-cost">
        <button class="raise-to-price"><< Підвищити</button>
    </span>
    <button class="next-lot">Наступний лот</button>
    <button class="previous-lot">Попередній лот</button>
    <button class="end-session">Закінчити сесію</button>
    <span class="set-winner">
        <label for="set-winner">Переможець: </label>
        <input type="text" id="set-winner">
        <button class="set-winner-button"><< Встановити</button>
    </span><br>
    <span class="write">
        <label for="write">Написати в чат: </label>
        <input type="text" id="write">
        <button class="write-button"><< Відправити</button>
    </span>
    <ul class="all">
        <?php
        while ($lot = $result->fetch_assoc()) {
            echo '<li class="id">' . $lot["id"] . '</li>';
        }
        ?>
    </ul>
    <div class="chat">
        <div class="messages"></div>
    </div>
</main>
</body>
</html>
<?php
if ($active == 0) {
    $sql = 'UPDATE trade SET session_active = TRUE';
    $connection->query($sql);
    $sql = 'INSERT INTO online (trader_id) SELECT trader_id FROM registered WHERE ver=TRUE AND applied_for_lots IS NOT NULL';
    $connection->query($sql);
}
$connection->close();
?>