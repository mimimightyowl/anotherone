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
                <span id="name" class="name"><?php echo $city['name'];?></span>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
        </div>
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
 
    <script id='content'>
        function initMap(){
            const arr = {
                "Гривич Центр" : {lat: 51.48, lng: 0.001 },
                //RUSSIA
                "Ижевск": {lat: 56.8498, lng: 53.204},
                "Иркутск": {lat: 52.2978, lng: 104.296},
                "Казань": {lat: 55.7887, lng: 49.1221},
                "Новгород": {lat: 58.5213, lng: 31.271},
                "Москва": {lat: 55.7522, lng: 37.6156},
                "Тюмень": {lat: 57.1522, lng: 65.5272},
                "Санкт-Петербург": {lat: 59.9386, lng: 59.9386},
                "Самара": {lat: 53.2001, lng: 50.15},
                "Саратов": {lat: 51.5406, lng: 46.0086},
                //ROMANIA
                "Бухарест": {lat: 44.4323, lng: 26.1063},
                "Яссы": {lat: 47.1667, lng: 27.6},
                "Галац": {lat: 45.4369, lng: 28.0503},
                "Крайова": {lat: 44.3167, lng: 23.8},
                "Бакэу": {lat: 46.5672, lng: 26.9138},
                "Брэила": {lat: 45.2727, lng: 27.9574},
                "Арад": {lat: 46.1833, lng: 21.3167},
                "Питешти": {lat: 44.8584, lng: 24.8535},
                "Орадя": {lat: 47.0458, lng: 21.9183},
                "Плоешти": {lat: 44.9318, lng: 26.0134},
                //SWEDEN
                "Алингос" : {lat: 57.929844216672926, lng: 12.535528422920814},
                "Арбуга" : {lat: 59.39341651188095, lng: 15.83742059237311},
                "Буден" : {lat: 65.82573972675318, lng: 21.687705350395923},
                "Бурленге" : {lat: 60.48430946281531, lng: 15.431858742004046},
                "Бурос" : {lat: 57.72119028096397, lng: 12.939870403386523},
                "Вадстена": {lat: 58.449320564937466, lng: 14.889677311917714},
                "Варберг": {lat: 57.11058232067016, lng: 12.251630270386748},
                "Векшё": {lat: 56.88811164133367, lng: 14.804427166205413},
                "Венерсборг": {lat: 58.387275249211186, lng: 12.322649981144638},
                "Арвика": {lat: 59.66294505715359, lng: 12.595063884004025},
                "Вестервик": {lat: 57.76404247402883, lng: 16.633832302474538},
                "Карлстад": {lat: 59.40912676096981, lng: 13.508754119875215},
                "Вестерос": {lat: 59.62111076887995, lng: 16.543054512835898},
                "Висбю": {lat: 57.63968292654071, lng: 18.29371242144478},
                //RWANDA
                "Кигали": {lat: -1.94995, lng: 30.0588},
                "Рубаву": {lat: -1.68825, lng: 29.29365},
                "Мусанзе": {lat: -1.4911601672725237, lng: 29.582274523789447},
                "Хуе": {lat: -2.598634000852296, lng: 29.741074851174908},
                "Муханга": {lat: -1.9599546347298011, lng: 29.710642783772283},
                "Кабуга": {lat: -1.959749042985469, lng: 30.21562100601141},
                "Гичумби": {lat: -1.6714844174436552, lng: 30.14039635356432},
                "Русизи": {lat: -2.5627271657908532, lng: 29.10819269641174},
                "Ньянза": {lat: -2.350350391841885, lng: 29.749581850632556},
                "Бугарама": {lat: -2.69516198383407, lng: 29.008669787057343},
                //SWITZERLAND
                "Альтдорф": {lat: 46.89666448275452, lng: 8.633074088281493},
                "Арау": {lat: 47.38787266337858, lng: 8.040094746439502},
                "Базель": {lat: 47.5584, lng: 7.57327},
                "Берн": {lat: 46.9481, lng: 7.44744},
                "Веве": {lat: 46.46860978078432, lng: 6.840485772087755},
                "Вильнёв": {lat: 47.46410443596045, lng: 9.042883011984808},
                "Винтертур": {lat: 47.5056, lng: 8.72413},
                "Женева": {lat: 46.2022, lng: 6.14569},
                "Цюрих": {lat: 47.3667, lng: 8.55},
                "Люцерн": {lat: 47.0505, lng: 8.30635},
            }
            ;
            const options = {
                center: arr["Гривич Центр"],
                zoom: 2,
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
            var marker;
            var gmarkers = [];

            function removeMarkers(){
                for(i=0; i<gmarkers.length; i++){
                    gmarkers[i].setMap(null);
                }
            }

            function addMarkers(){
                var i = 0;
                while(i < 5){
                    name = document.getElementsByClassName("name")[i].innerHTML;
                    i++;
                    console.log(name, arr[name]);
                    marker = new google.maps.Marker({
                        position: arr[name],
                        map: map,
                    });
                    gmarkers.push(marker);
                }
            }
            
            $(document).ready(function() {
            var page = 1;
            $('input.search').on('input', function() {
                removeMarkers();
                var search = $('input.search').val();
                console.log(search);
                $.ajax({
                        method: "POST",
                        url: "request_result.php",
                        data: {search: search},
                    })
                    .done(function( msg ) {
                        $('#content').html(msg);
                        addMarkers();
                    });
            });
            $('#next').on('click', function request_result() {
                removeMarkers();
                page += 1;
                <?php $page++;?>
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
                        addMarkers();
                    },
                    });
                    
            });
            $('#back').on('click', function request_result() {
                removeMarkers();
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
                            addMarkers();
                            },
                        })
                } else {
                    removeMarkers();
                    page -= 1;
                    <?php $page--;?>
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
                            addMarkers();
                            },
                        })
                }
            });
        });
        }
    </script>  
    <script 
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhxbYUUQB9y1Yq4MlAKwGQxfuVmUSoKLQ&callback=initMap&libraries=&v=weekly"
      async
    ></script>
</body>

</html>
