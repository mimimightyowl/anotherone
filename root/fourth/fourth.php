<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <title>Четвёртая</title>
</head>

<body>
    <?php
    require '../components/header.php';

    require_once '../components/connection.php'; // подключаем скрипт
    $database = 'second'; // имя базы данных

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    // выполняем операции с базой данных

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $offset = $limit * ($page - 1);


    if(isset($_POST['submit'])){  
        $country = isset($_POST['country']) ? $_POST['country'] : 'chooseyourfighter';
        $city_result = mysqli_query($link, "SELECT * FROM `cities` WHERE `country` LIKE '%$country%' LIMIT $limit OFFSET $offset");
    } else {
        $country = isset($_GET['country']) ? $_GET['country'] : 'Россия';
        $city_result = mysqli_query($link, "SELECT * FROM `cities` WHERE `country` LIKE '%$country%' LIMIT $limit OFFSET $offset");
    };
    
    if ($city_result) {
        echo "Выполнение запроса прошло успешно<br>";
    }

     // закрываем подключение
     mysqli_close($link);

    ?>    

    <div class="container">
        <div class="input-group container mb-3">
            <form method="post" id="form" class="mx-auto form-control">
                <input type="text" 
                name="country" 
                id="country"
                value=""
                class="country form-control"
                aria-label="Default"
                placeholder="Введите название страны" 
                aria-describedby="inputGroup-sizing-default">
                <input type="submit"
                id="submit"
                name="submit"
                value="Найти города"
                class="search form-control btn btn-success my-2"
                aria-label="Default">
            </form>
        </div>

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
    
    </div>

    <?php
    $page_previous = $page - 1;
    $page_next = $page + 1; 
    
    function pagePrint ($page_previous, $page_next, $page, $country) {

        if($page != 1) {
            $status = "page-item";
        } else {
            $status = "page-item disabled";
        };
        echo "
        <nav aria-label='...'>
            <ul id='butts' class='pagination justify-content-center'>
                <li class='$status'>
                <a class='page-link' href='?country=".$country."&page=". $page_previous ."' tabindex='-1' aria-disabled='true' >Назад</a>
                </li>
                <li class='page-item'>
                <a class='page-link' href='?country=".$country."&page=". $page_next ."' >Вперёд</a>
                </li>
            </ul>
        </nav>";
    };
    pagePrint($page_previous, $page_next, $page, $country);
    ?>
</body>

</html>