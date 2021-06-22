<?php
    require_once '../components/connection.php'; // подключаем скрипт
    $database = 'second'; // имя базы данных

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

        
    // выполняем операции с базой данных
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $country = $_POST['country'];

    // echo 'country IS a ', $country, '  ';
    // echo 'page IS a ', $page;
    $limit = 5;
    $offset = $limit * ($page - 1);
   
    $query_cities = "SELECT * FROM `cities` WHERE `country_eng` LIKE '%$country%' LIMIT $limit OFFSET $offset";
    $city_result = mysqli_query($link, $query_cities) or die("city_Ошибка" . mysqli_error($link));

    // закрываем подключение
    mysqli_close($link);
?>   
    <span id='page'><?php $page; ?></span>
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
  
    