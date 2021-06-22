<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <title>Вторая</title>
</head>

<body>
    <?php
    require '../components/header.php';

    require_once '../components/connection.php'; // подключаем скрипт
    $database = 'second'; // имя базы данных

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка соединения" . mysqli_error($link));

    // выполняем операции с базой данных
    
    $country = isset($_GET['country']) ? $_GET['country'] : 'chooseyourfighter';
    $query_cities = "SELECT * FROM `cities` WHERE `country_eng` LIKE '%$country%'";
    $city_result = mysqli_query($link, $query_cities) or die("city_Ошибка" . mysqli_error($link));
    $query = "SELECT * FROM `countries`";
    $result = mysqli_query($link, $query) or die("countries_Ошибка" . mysqli_error($link));
    if ($result) {
        echo "Выполнение запроса прошло успешно<br>";
    }


    ?>    

    <?php if ($result) : ?>
        <div class="dropdown mx-auto my-5" style="width: 200px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                Нажми меня
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                <li>
                    <table class="table table-dark table-striped my-5 mx-auto ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название страны</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($answ = mysqli_fetch_array($result)): ?>
                                <tr>
                                    <?php 
                                        $country_name = $answ['country'];
                                        echo "
                                        <th scope='row'>{$answ['id']}</th>
                                        <td>
                                        <a href='?country=".$country_name."' class='link-light'>{$answ['name']}</a>
                                        </td>                                        
                                        ";
                                    ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>
    <?php endif; ?>


    <div class='modal-dialog modal-dialog-scrollable' id="content">
    <table class="table table-dark table-striped my-5 mx-auto ">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Название города</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($city_answ = mysqli_fetch_array($city_result)): ?>
                <tr>
                <?php 
                echo "
                <th scope='row'>{$city_answ['id']}</th> 
                <td>
                {$city_answ['name']}</td>
                ";
                ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
    <?php 
    // закрываем подключение
    mysqli_close($link);
    ?>
</body>
</html>