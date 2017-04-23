<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 04.04.2017
 * Time: 20:54
 */
mb_internal_encoding("UTF-8");

$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';

$connection = new mysqli($host, $username, $password, $db);
if ($connection->connect_error) {
    die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
}
$connection->set_charset('utf8');
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

switch ($_POST["function"]) {
    case 'switch':
        $sql = 'SELECT id, customer_number, cost_final, price_final FROM trade WHERE id IS NOT NULL';
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $lot = $result->fetch_assoc();
            $sql = 'UPDATE lots SET customer_number=\'' . $lot["customer_number"] .
                '\', cost_final=\'' . $lot["cost_final"] .
                '\', price_final=\'' . $lot["price_final"] . '\'' .
                'WHERE id=\'' . $lot["id"] . '\'';
            $connection->query($sql);
        }
        $sql = 'SELECT * FROM lots WHERE id=\'' . $_POST["id"] . '\'';
        $result = $connection->query($sql)->fetch_assoc();
        $sql = 'UPDATE trade SET ' .
            'seller_name = \'' . $result["seller_name"] . '\', ' .
            'id = \'' . $result["id"] . '\', ' .
            'type = \'' . $result["type"] . '\', ' .
            'breed = \'' . $result["breed"] . '\', ' .
            'characteristics_diametr = \'' . $result["characteristics_diametr"] . '\', ' .
            'characteristics_sort = \'' . $result["characteristics_sort"] . '\', ' .
            'gost = \'' . $result["gost"] . '\', ' .
            'characteristics_length = \'' . $result["characteristics_length"] . '\', ' .
            'characteristics_storage = \'' . $result["characteristics_storage"] . '\', ' .
            'size = \'' . $result["size"] . '\', ' .
            'customers_applied = \'' . $result["customers_applied"] . '\', ' .
            'customer_number = \'' . $result["customer_number"] . '\', ' .
            'cost_start = \'' . $result["cost_start"] . '\', ' .
            'price_start = \'' . $result["price_start"] . '\', ' .
            'step = \'' . $result["step"] . '\', ' .
            'cost_final = \'' . $result["cost_final"]  . '\', ' .
            'price_final = \'' . $result["price_final"] . '\', ' .
            'current_step = \'0\'';
        $connection->query($sql);
        $message =
            '<p class="message">' .
            '<span class="time">' . get24hTime() . '</span>' .
            '<span>Торгується лот №' . $result["id"] . '</span>' .
            '</p>';
        $sql = 'SELECT customers_applied FROM trade';
        $result = $connection->query($sql)->fetch_assoc();
        $customers = explode(', ', $result["customers_applied"]);
        $sql = 'TRUNCATE TABLE online';
        $connection->query($sql);
        foreach ($customers as $customer) {
            $sql = 'INSERT INTO online VALUES (\'' . $customer . '\', TRUE)';
            $connection->query($sql);
        }
        $chat = fopen('../../assets/auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'addStep':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $nextStep = $currentValues["current_step"] + 1;
        $costFinal = $currentValues["cost_start"] + ($nextStep * $currentValues["step"]);
        $priceFinal = $costFinal * $currentValues["size"];
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        $message =
            '<p class="message">' .
            '<span class="time">' . get24hTime() . '</span>' .
            '<span>' . $_POST["who"] . ' підвищує до ' . $nextStep . '-го кроку</span>' .
            '</p>';
        $chat = fopen('../../assets/auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'removeStep':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $nextStep = (($currentValues["current_step"] - 1) < 0) ? (0) : ($currentValues["current_step"] - 1);
        $costFinal = $currentValues["cost_start"] + ($nextStep * $currentValues["step"]);
        $priceFinal = $costFinal * $currentValues["size"];
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        $message =
            '<p class="message">' .
            '<span class="time">' . get24hTime() . '</span>' .
            '<span>' . $_POST["who"] . ' знижує до ' . $nextStep . '-го кроку</span>' .
            '</p>';
        $chat = fopen('../../assets/auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'raiseToPrice':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $costFinal = $_POST["value"];
        $priceFinal = $costFinal * $currentValues["size"];
        $nextStep = floor(($costFinal - $currentValues["cost_start"]) / $currentValues["step"]);
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        $message =
            '<p class="message">' .
            '<span class="time">' . get24hTime() . '</span>' .
            '<span>' . $_POST["who"] . ' підвищує до ' . $costFinal . 'грн.</span>' .
            '</p>';
        $chat = fopen('../../assets/auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'raiseToSteps':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $nextStep = $currentValues["current_step"] + $_POST["value"];
        $costFinal = $currentValues["cost_start"] + ($nextStep * $currentValues["step"]);
        $priceFinal = $costFinal * $currentValues["size"];
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        $message =
            '<p class="message">' .
            '<span class="time">' . get24hTime() . '</span>' .
            '<span>' . $_POST["who"] . ' підвищує до ' . $nextStep . '-го кроку</span>' .
            '</p>';
        $chat = fopen('../../assets/auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'setWinner':
        $sql = 'UPDATE trade SET customer_number = \'' . $_POST["value"] . '\'';
        $connection->query($sql);
        $sql = 'SELECT * FROM trade';
        $id = $connection->query($sql)->fetch_assoc()["id"];
        $message =
            '<p class="message">' .
            '<span class="time">' . get24hTime() . '</span>' .
            '<span>Лот №' . $id . ' придбав ' . $_POST["value"] . '-й</span>' .
            '</p>';
        $chat = fopen('../../assets/auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'leave':
        $sql = 'UPDATE online SET online = FALSE WHERE id=\'' . $_POST["who"] . '\'';
        $connection->query($sql);
        header('Location: http://exhange.roik.pro/admin/admin.php');
        break;
    case 'end':
        $sql = 'UPDATE trade SET session_active = FALSE, seller_name = NULL, id = NULL, type = NULL, breed = NULL, characteristics_diametr = NULL, characteristics_storage = NULL, characteristics_length = NULL, characteristics_sort = NULL, gost = NULL, size = NULL, customers_applied = NULL, cost_start = NULL, customer_number = NULL, step = NULL, cost_final = NULL, price_final = NULL, current_step = NULL';
        $connection->query($sql);
        $chat = fopen('../../assets/auction-chat.html', 'w');
        fwrite($chat, '');
        fclose($chat);
}
$connection->close();