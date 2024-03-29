<?php
//header('Location: cabinet.php');
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

require_once "scripts/php/user.php";
$user = User::getUserById($_SESSION["id"]);
$_SESSION["ver"] = $user->ver;
$_SESSION["access"] = $user->access;
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>EXChange - новини проекту</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/articles.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/common.js"></script>
    <script src="scripts/js/articles.js"></script>
</head>

<body>
<header>
    <?php
    include "assets/menu.php";
    include "assets/logo.html";
    ?>
</header>
<main>
    <div class="news">
        <section class="list">
            <h2>Актуальні новини</h2>
            <ul class="article-list">
                <li data-heading="article1"><span>Лісозаготівля</span><time datetime="12:25 31-08-2016"></time></li>
                <li data-heading="article2"><span>Аукціонний комітет</span><time datetime="12:25 31-08-2016"></time></li>
                <li data-heading="article3"><span>Вірш</span><time datetime="12:25 31-08-2016"></time></li>
                <li data-heading="article4"><span>ВИДЫ ПРОИЗВОДИМЫХ ПИЛОМАТЕРИАЛОВ:</span><time datetime="12:25 31-08-2016"></time></li>
            </ul>
        </section>
        <section class="articles">
            <article data-heading="article1">
                <h2>Лісозаготівля</h2>
                <p>Лісозаготівля – це  вирубування, вивіз та первинна обробка деревини.</p>
                <p>Щорічний обсяг деревини, що заготовляється в ДП «Шепетівський лісгосп», становить   близько 80 тис.  м3.</p>
                <p>Сам процес заготівлі деревини  пов'язаний із рубкою лісу. Об'єктом рубки є окремі дерева і цілі деревостани. Метою лісозаготівлі є одержання деревної сировини, яка проводиться в стиглих і перестійних лісостанах.</p>
                <p>Рубка стиглого лісу має вирішувати три основні завдання: поновлення лісу, екологічні завдання й отримання  деревної продукції.</p>
                <p>Заготівля деревини в лісах здійснюється при рубках головного користування та рубках формування і оздоровлення лісів на заздалегідь виділеній площі, яку називають лісосіка, в межах лісництва, кварталу та виділу.  Головне користування лісом здійснюється в межах розрахункової лісосіки де  вирубують стиглі і перестійні деревостани для одержання деревної продукції. Заготівля деревини також здійснюється і при рубках формування і оздоровлення лісів (рубки догляду за лісом, санітарно-оздоровчих заходів) та інших рубках пов’язаних і не пов’язаних з веденням лісового господарства (розчищення лісових площ для будівництва гідровузлів, трубопроводів, доріг, тощо). Так наприклад:</p>
                <p>рубки догляду за лісом спрямовані на забезпечення кращих умов зростання головних порід у насадженнях, на підвищення стійкості насаджень до дії негативних факторів
                    санітарні рубки спрямовані на оздоровлення та посилення біологічної стійкості лісів, а також передбачають рубку уражених хворобами та пошкоджених шкідниками дерев, деревина яких ще не втратила технічних якостей, для забезпечення ;
                    так звані інші рубки потрібні для розширення просіки, прорубування трас для будівництва доріг, ліній електропередач тощо.</p>
                <p>Процес лісозаготівлі являє собою підприємницьку діяльність, пов'язану із звалюванням дерев у лісі, їх трелюванням,  розробкою хлистів  на сортименти, зберіганням і вивезенням заготовленої деревини з лісу.</p>
                <p>На підприємстві заготівля деревини здійснюється за допомогою бензопили марки «STIHL». Це є надійний, потужний інструмент для тривалої роботи на лісозаготівлі. У процесі ручної валки лісу звалювальник спочатку робить підпил  з того боку дерева, в яку збирається його валити, потім переходить на протилежну сторону і виробляє основний пропил (різ), обов'язково залишаючи невеликий недопил, який не дозволяє розвернутися дереву навколо поздовжньої осі, тим самим не даючи йому зісковзнути з пня. У парі із звалювальником працює помічник - лісоруб. Далі сучкорубами, що працюють зазвичай в групі, проводиться очищення стовбура від сучків і видалення вершини. Після цього, очищені від сучків хлисти, трелюють  трактором МТЗ-82  від місця їх заготівлі до вантажних пунктів на верхніх складах. Потім  хлисти розкряжовують  на сортименти для подальшого вивезення їх на нижній склад або реалізації споживачам.</p>
                <p>На сьогоднішній день на підприємствах Державного агентства лісових ресурсів України запроваджена система електронного обліку деревини. Не винятком стало і ДП «Шепетівський лісгосп». Завдання електронного обліку – спростити і автоматизувати облік за допомогою сучасних комп'ютерних технологій.</p>
                <p>Електронний облік заготовленої деревини відбувається наступним чином: майстер лісу на лісосіці за допомогою кишенькового персонального комп’ютеру (КПК) проводить приймання лісопродукції від бригади, яка її заготовила. Майстер лісу вносить інформацію заготовленої деревини до КПК та прибиває відповідні бирки до продукції за допомогою спеціального пристрою. А далі введена інформація синхронізується з центральним рівнем системи для подальшої обробки, аналізу та контролю.</p>
                <p>Як видно з наведеного опису процес електронного обліку деревини цілковито ґрунтується на електронному документообігу. Його основу складає програмне забезпечення, яке дозволяє контролювати етапи руху деревини, де вся облікова інформація передається в електронному вигляді. Важливим результатом роботи системи є значне скорочення паперового документообігу та різних видів звітності між виробничими підрозділами підприємства, а також зменшення тіньового обігу незаконно добутої деревини.</p>
                <p>Таким чином  система електронного обліку деревини  дає можливість переглянути повністю ланцюг руху заготовленої деревини від місця її заготівлі до кінцевого споживача. Отже, за допомогою реєстру походження деревини по нумерації бирки, якою маркується деревина, можна встановити: місце та час заготівлі, назву бригади, що здійснювала заготівлю, а також повну характеристику маркованої продукції.</p>
                <div class="footer"><time datetime="12:25 31-08-2016"></time></div>
            </article>
            <article data-heading="article2">
                <h2>АУКЦІОННИЙ КОМІТЕТ З ПРОДАЖУ НЕОБРОБЛЕНОЇ ДЕРЕВИНИ</h2>
                <p>Голова аукціонного комітету:</p>
                <p>ХАЛІМБЕКОВ Важид Шалабутдінович – заступник Голови правління громадської організації «Антикорупційне бюро по Закарпатській області»</p>
                <p>Секретар аукціонного комітету:</p>
                <p>МОЙСЕЙОВСЬКА Тетяна Ігорівна – провідний спеціаліст товарної біржі «Закарпатська універсальна товарно-сировинна біржа»</p>
                <p>Члени аукціонного комітету:</p>
                <p>КИЙ Василь Васильович – заступник начальника Закарпатського обласного управління лісового та мисливського господарства</p>
                <p>МУНТЯНОВ Олександр Сергійович – член Біржового комітету  товарної біржі «Закарпатська універсальна товарно-сировинна біржа»</p>
                <p>ГЛИВКА Оксана Іванівна – директор товарної біржі «Закарпатська універсальна товарно-сировинна біржа»</p>
                <div class="footer"><time datetime="12:25 31-08-2016"></time></div>
            </article>
            <article data-heading="article3">
                <h2>Вірш</h2>
                <p>Пою благого Сюзерена, Владыку сей страны,
                    Что власть высокую свою по всей земле простёр.
                    Мрачна была темница Гвейра, угрюмый Каэр Сиди,
                    Страшась коварной мести Пуйла и злобы Придери,
                    Никто на свете до него в неё не проникал.
                    Тяжёлая синела цепь на шее у него,
                    Средь воплей Аннуна горькой скорбью напев его звучал,
                    Но даже там великим бардом сумел остаться он.
                    Нас было втрое больше тех, что могут сесть в Придвен,
                    Но только семеро вернуться смогли из Каэр Сиди.</p>

                <p>О, я ль не стою громкой славы, и песен и хвалы
                    За то, что сам четыре раза бывал в Каэр Перидван?
                    Когда впервые слово правды послышалось в котле?
                    Когда его своим дыханьем согрели девять дев.
                    А разве он владыке Аннуна встарь не принадлежал?</p>

                <p>По краю этого котла жемчужины блестят.
                    Он никогда не сварит пищи для труса и лжеца.
                    Но меч сверкающий над ним взметнется к небесам
                    И в крепкой длани Ллеминауга изведает покой.
                    У тяжеленных врат Уфферна чуть теплится огонь,
                    Когда мы прибыли с Артуром — вот славный был денёк!
                    Нас только семеро вернулось домой из Каэр Ведвид!</p>
                <div class="footer"><time datetime="12:25 31-08-2016"></time></div>
            </article>
            <article data-heading="article4">
                <h2>ВИДЫ ПРОИЗВОДИМЫХ ПИЛОМАТЕРИАЛОВ:</h2>
                <p>ДОСКА - ОБРЕЗНАЯ, НЕОБРЕЗНАЯ: СОСНА, БЕРЁЗА, ОСИНА, ЕЛЬ, ДУБ;</p>
                <p>БРУС - КЛЕЕНЫЙ, ИЗ МАСИВА: СОСНА, ДУБ;</p>
                <p>ВАГОНКА - ИЗ МАСИВА, СРОЩЕННАЯ: ДУБ, ОСИНА, ЛИПА, СОСНА;</p>
                <p>ПАРКЕТ - ЗАГОТОВКА ДЛЯ ПАРКЕТА: ДУБ, СОСНА;</p>
                <p>ШПАЛА - 1,2 ТИП: СОСНА, ДУБ;</p>
                <p>НАЛИЧНИК, ПЛИНТУС, РЕЙКА - ИЗ МАСИВА - СОСНА, ДУБ, ОЛЬХА.
                <div class="footer"><time datetime="12:25 31-08-2016"></time></div>
            </article>
        </section>
    </div>
</main>
<?php
include "assets/footer.html";
?>
</body>

</html>