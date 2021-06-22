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
    <title>Шестая</title>
</head>

<body>
    <?php require '../components/header.php';?>    
    <p>Текущая страница: <span id='page'>1</span></p>
    <div class="container">
        <div class="input-group container mb-3">
            <div class="mx-auto form-control">
                <input type="text" 
                name="search" 
                class="search form-control"
                aria-label="Default"
                placeholder="Введите название страны" 
                aria-describedby="inputGroup-sizing-default">
            </div>
        </div>
        <div class='modal-dialog modal-dialog-scrollable' id='content'>
            <table class='table table-dark table-striped my-5 mx-auto'>
            <thead>
                <tr>
                <th scope='col'>#</th>
                <th scope='col'>Название города</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($query_cities)): ?>
                <tr>
                    <th scope='row'><?php echo $row['id'];?></th> 
                    <td>
                    <?php echo $row['name'];?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
        </div>
        <div id='content'></div>
        <nav aria-label='...' id='nav'>
            <ul id='butts' class='pagination justify-content-center'>
                <li id='back' class='page-item disabled'>
                    <a class='page-link' tabindex='-1' aria-disabled='true' >Назад</a>
                </li>
                <li id='next' class='page-item'>
                    <a class='page-link'>Вперёд</a>
                </li>
            </ul>
        </nav>
    </div>
    <script>
        $(document).ready(function() {
            var page = 1;
            $('input.search').on('input', function() {
                var search = $('input.search').val();
                console.log(search);
                $.ajax({
                        method: "POST",
                        url: "request_result.php",
                        data: {search: search},
                    })
                    .done(function( msg ) {
                        $('#content').html(msg);
                    });
            });
            $('#next').on('click', function request_result() {
                page += 1;
                <?php $page += 1;?>
                document.getElementById("page").innerHTML = page;
                $('#back').removeClass('disabled');
                var search = $('input.search').val();
                $.ajax({
                    url: 'request_result.php',         
                    method: 'POST',
                    cache: false,
                    data: {page: page, search: search },
                    dataType: 'html',
                    success: function(data){
                        $('#content').html(data);
                    },
                    });
                    
            });
            $('#back').on('click', function request_result() {
                if(page==1){
                    document.getElementById("page").innerHTML = page;
                    $('#back').addClass('disabled');
                    var search = $('input.search').val();
                    $.ajax({
                        url: 'request_result.php',         
                        method: 'POST',
                        cache: false,
                        data: {page: 1, search: search },
                        dataType: 'html',
                        success: function(data){
                            $('#content').html(data);
                            },
                        })
                } else {
                    page -= 1;
                    <?php $page -= 1;?>
                    document.getElementById("page").innerHTML = page;
                    if(page==1){
                        $('#back').addClass('disabled');
                    } else {
                        $('#back').removeClass('disabled');
                    }
                    var search = $('input.search').val();
                    $.ajax({
                        url: 'request_result.php',         
                        method: 'POST',
                        cache: false,
                        data: {page: page, search: search },
                        dataType: 'html',
                        success: function(data){
                            $('#content').html(data);
                            },
                        })
                }
            });
        });
    </script>        
</body>
</html>