<?php
    include_once 'header.php';
?>

    <div class="main_container">
        <div class="main_content">
            <div class="bookinfo__imgContainer">
                <!-- <img class="bookinfo__background" src="src/img/books/b1_cover.jpeg" alt="image 1 missing"> -->
            </div>
            <div class="bookinfo__container">
                <form action="includes/new-book.be.php" method="post" enctype="multipart/form-data">
                    <div class="bookinfo__section">
                        <h1 class="bookinfo__htxt">ADD NEW PRODUCT</h1>
                        <div class="newproduct__form">
                            <div class="form__row">
                                <label for="name">BOOKS'S NAME</label>
                                <input type="text" name="name" placeholder="Type here...">
                            </div>
                            
                            <div class="form__row">
                                <label for="version">BOOKS'S VERSION</label>
                                <input type="text" name="version" placeholder="Type here...">
                            </div>

                            <div class="form__row">
                                <label for="version">BOOKS'S TITLE</label>
                                <input type="text" name="title" placeholder="Type here...">
                            </div>

                            <div class="form__row">
                                <label for="author">BOOKS'S AUTHOR</label>
                                <input type="text" name="author" placeholder="Type here...">
                            </div>

                            <div class="form__row">
                                <label for="category">BOOKS'S CATEGORY</label>
                                <input list="categoryList" name="category" placeholder="Select here...">
                            </div>

                            <div class="form__row">
                                <label for="price">BOOKS'S PRICE</label>
                                <input type="number" step="0.01" min="0" name="price" placeholder="Type here...">
                            </div>

                            <div class="form__row">
                                <label for="grade">BOOKS'S GRADE</label>
                                <input type="number" step="0.01" min="0" max="5" name="grade" placeholder="Type here...">
                            </div>
                        </div>

                    </div>
    
                    <div class="bookinfo__section">
                        <h1 class="bookinfo__htxt">PRODUCT DESCRIPTION </h1>
                        <div class="newproduct__form">
                            <div class="form__row">
                                <label for="name">BOOKS'S SYNOPSYS</label>
                                <input type="text" name="description" placeholder="Type here...">
                            </div>
                        </div>
    
                    </div>
    
                    <div class="bookinfo__section">
                        <h1 class="bookinfo__htxt">PRODUCT PICTURE</h1>
                        <div class="newproduct__form">
                            <div class="form__row">
                                <label for="name">UPLOAD BOOKS'S COVER</label>
                                <input type="file" name="cover">
                            </div>
                        </div>
                    </div>
                    <input class="newproduct__submit" type="submit" name="submit" value="SUBMIT">
                    <datalist id="categoryList">
                        <option value="FANTASY"></option>
                    </datalist>
                </form>
            </div>

<?php
    include_once 'footer.php';
?>