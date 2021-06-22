<?php
    $page_previous = $page - 1;
    $page_next = $page + 1; 
    
    function pagePrint ($page_previous, $page_next, $page) {
        if($page != 1) {
            $status = "page-item";
        } else {
            $status = "page-item disabled";
        };
        echo "
        <nav aria-label='...'>
            <ul id='butts' class='pagination justify-content-center'>
                <li class='$status'>
                <a class='page-link' href='?page=". $page_previous ."' tabindex='-1' aria-disabled='true' >Назад</a>
                </li>
                <li class='page-item'>
                <a class='page-link' href='?page=". $page_next ."' >Вперёд</a>
                </li>
            </ul>
        </nav>";
    };
    pagePrint($page_previous, $page_next, $page);
?>