<?php
    include_once 'header.php';
    $mode = mysqli_real_escape_string($conn, $_GET['mode']);
?>
    <div class="main_container">
        <div class="main_content">
            <div class="bookinfo__imgContainer">
                <!-- <img class="bookinfo__background" src="src/img/books/b1_cover.jpeg" alt="image 1 missing"> -->
            </div>
            <div class="bookinfo__container">
                <div class="bookinfo__section">
                    <div class="elem_search_container">
                        <?php
                            require_once 'display.php';

                            displayBooks($conn,$mode);
                        ?>
                    </div>
                </div>
            </div>
            
<?php
    include_once 'header.php';
?>