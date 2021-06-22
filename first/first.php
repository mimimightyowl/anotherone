<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <title>Первая</title>
</head>
<body>
<?php 
  require '../components/header.php';

  require_once '../components/connection.php'; // подключаем скрипт
  $database = 'first'; // имя базы данных

  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $password, $database) 
      or die("Ошибка " . mysqli_error($link));
   
  // выполняем операции с базой данных
  $query ="SELECT * FROM `countries`";
  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
  if($result)
  {
    echo "Выполнение запроса прошло успешно<br>";
  }
   
  // закрываем подключение
  mysqli_close($link);

?>

<?php if($result): ?>
    <div class='modal-dialog modal-dialog-scrollable' id="content">
        <table class="table table-dark table-striped my-5 mx-auto">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Название страны</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($answ = mysqli_fetch_array($result)): ?>
                    <tr>
                    <?php echo "
                        <th scope='row'>{$answ['id']}</th> 
                        <td>
                        {$answ['name']}
                        </td>
                        ";
                    ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
</body>
</html>
