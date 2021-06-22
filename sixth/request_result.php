<?php
    require_once '../components/connection.php'; // подключаем скрипт
    $database = 'second'; // имя базы данных

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    $search = $_POST['search'];

    // выполняем операции с базой данных
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $limit = 5;
    $offset = $limit * ($page - 1);

    $query_cities = mysqli_query($link, "SELECT * FROM `cities` WHERE `country` LIKE '%$search%' LIMIT $limit OFFSET $offset");
    $query_countries = mysqli_query($link, "SELECT * FROM `countries` WHERE `country` LIKE '%$search%'");
    $country = mysqli_fetch_assoc($query_countries);

    // закрываем подключение
    mysqli_close($link);
?>    
    <div class='modal-dialog modal-dialog-scrollable' id='content'>
        <table class='table table-dark table-striped my-5 mx-auto'>
        <thead>
            <tr>
            <th scope='col'>#</th>
            <th scope='col'>Название города</th>
            </tr>
        </thead>
        <tbody>
            <?php while($city = mysqli_fetch_assoc($query_cities)): ?>
            <tr>
                <th scope='row'><?php echo $city['id'];?></th> 
                <td>
                <?php echo $city['name'];?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        </table>
    </div>
