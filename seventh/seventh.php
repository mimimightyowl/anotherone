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
    <style>
        #map {
            height: 400px;
            width: 97%;
        }
    </style>
    <title>Седьмая</title>
</head>

<body>
    <?php require '../components/header.php';
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            $query_countries = mysqli_query($link, "SELECT * FROM `counries` WHERE `country` LIKE '%$search%'");
            while ($country = mysqli_fetch_assoc($query_countries)){
                echo $country["name"];
            }
        }
        
    ?>    
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
        <div id='map' class="container"></div>
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
                        data: {page: 1,  search: search },
                        dataType: 'html',
                        success: function(data){
                            $('#content').html(data);
                            },
                        })
                } else {
                    page -= 1;
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
                        data: {page: page,  search: search },
                        dataType: 'html',
                        success: function(data){
                            $('#content').html(data);
                            },
                        })
                }
            });
        });
    </script>  
    <script>
        //fetch cities_list 

        //than gotta focus on country
        
        //than gotta create new markers for cities list
        // var country = <?php echo $country?>;
    </script>
    <script>
        function initMap(counrty){
            const russia =  {lat: 57.972391043893815, lng: 46.08433492277754 };
            const romania =  {lat: 45.73132716085783, lng: 24.49031681610318 };
            const sweden =  {lat: 64.45819284772944, lng: 16.23477766363368 };
            const rwanda =  {lat: -2.0625928869524865, lng: 30.12259628201323 };
            const switzerland =  {lat: 46.751287399937546, lng: 7.707254727085663 };
            // if(country){

            // }
            const options = {
                center: rwanda,
                zoom: 5,
                styles: [
                    { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
                    { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
                    { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
                    {
                        featureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#d59563" }],
                    },
                    {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#d59563" }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [{ color: "#263c3f" }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#6b9a76" }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{ color: "#38414e" }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [{ color: "#212a37" }],
                    },
                    {
                        featureType: "road",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#9ca5b3" }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [{ color: "#746855" }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{ color: "#1f2835" }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#f3d19c" }],
                    },
                    {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [{ color: "#2f3948" }],
                    },
                    {
                        featureType: "transit.station",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#d59563" }],
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{ color: "#17263c" }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#515c6d" }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.stroke",
                        stylers: [{ color: "#17263c" }],
                    },
                ],
            };
            const map = new google.maps.Map(document.getElementById("map"), options);
            for(i = 0; i < 5; i++) {
                const marker = new google.maps.Marker({
                    position: {lat: -2.0625928869524865, lng: 30.12259628201323 },
                    map: map,
                });
            }
        }
    </script>    
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhxbYUUQB9y1Yq4MlAKwGQxfuVmUSoKLQ&callback=initMap&libraries=&v=weekly"
      async
    ></script>
</body>

</html>