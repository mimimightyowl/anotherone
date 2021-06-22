<div class='modal-dialog modal-dialog-scrollable' id='content'>
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