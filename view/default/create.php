<p><b>Добавити нову книжку</b><br></p>
<input checked class="books" type="radio" name="gender"> Книжки
<input class="authors" type="radio" name="gender"> Автори
<input class="publishers" type="radio" name="gender"> Видавництва
<div id="books">
    <form method="post" name="Books" style="width: 450px;height:250px ">
        <input type="text" value="<?php echo $_POST['book']['book_name'] ?>" class="input_form" name="book[book_name]">
        <label>Книга</label><br>

        <select class="input_form" id="country_a" name="book[author_name]" ">
        <?php foreach ($book->author as $pb): ?>
            <option value="<?php echo $pb['id'] ?>"><?php echo $pb['name']." ".$pb['last_name']; ?></option>
        <?php endforeach; ?>
        </select>
        <label>Імя та Прізвище автора</label><br>

        <select class="input_form" id="country_a" name="book[genre]" ">
        <?php foreach ($book->genres as $pb): ?>
            <option value="<?php echo $pb['genres_id'] ?>"><?php echo $pb['genre'] ?></option>
        <?php endforeach; ?>
        </select>
        <label>Жанр</label><br>

        <input type="text" value="<?php echo $_POST['book']['count_page'] ?>" class="input_form"
               name="book[count_page]"> <label>кіл. стор.</label><br>
        <input type="text" value="<?php echo $_POST['book']['date_published'] ?>" value="as" class="input_form"
               name="book[date_published]"> <label>рік виданя</label><br>

        <select class="input_form" id="country_a" name="book[publisher]" ">
        <option>Видавництва</option>
        <?php foreach ($book->publisher as $pb): ?>
            <option value="<?php echo $pb['id'] ?>"><?php echo $pb['name'] ?></option>
        <?php endforeach; ?>
        </select> <label>назва редакціі</label><br>

        <input type="text" value="<?php echo $_POST['book']['date_admission'] ?>" class="input_form"
               name="book[date_admission]"> <label>дата поступлення</label><br>
        <input type="submit" class="input_form" value="Додати"">
    </form>
</div>
<div id="authors">
    <form method="post" name="Books" style="width: 450px;height:250px ">
        <input type="text" class="input_form" name="authors[author_name]"> <label>Ім`я автора</label><br>
        <input type="text" class="input_form" name="authors[lost_name]"> <label>Прізвище автора</label><br>
        <input type="text" class="input_form" name="authors[year_birth]"> <label>Дата народження</label><br>
        <input type="text" class="input_form" name="authors[year_dead]"> <label>Дата смерті</label><br>
        <select class="input_form" id="country_a" name="authors[country]" ">
            <option>Країни</option>
            <?php foreach ($countries as $country): ?>
                <option value="<?php echo $country['country_id'] ?>"><?php echo $country['name'] ?></option>
            <?php endforeach; ?>
        </select> <label> Громадянин </label><br>
        <input type="submit" class="input_form" value="обрахувати"">
    </form>
</div>
<div id="publishers">
    <div id="a"></div>
    <form method="post" name="Books" style="width: 450px;height:250px ">
        <input type="text" class="input_form" name="publishers[name]"> <label>Назва</label><br>
        <select class="input_form" id="country_p" name="publishers[country]" onclick="country() ">
            <option>Країни</option>
            <?php foreach ($countries as $country): ?>
                <option value="<?php echo $country['country_id'] ?>"><?php echo $country['name'] ?></option>
            <?php endforeach; ?>
        </select> <label>Країна</label><br>
        <div id="vasya"></div>
        <script type="text/javascript">
            function country() {
                $('#country_p').change(function () {
                    var d = $("#country_p option:selected").val();
                    $.post("/books/ajax_create", {country: d}, function (data) {
                        $('#region').html(data);
                    });
                });
            }
        </script>
        <script type="text/javascript">
            function city() {
                $('#region').change(function () {
                    var d = $("#region option:selected").val();
                    $.post("/books/ajax_create", {region: d}, function (data) {
                        $('#city_id').html(data);
                    });
                });
            }
        </script>
        <select class="input_form" id="region" onclick="city()" name="publishers[region]">
            <option onclick="city()">Області</option>
        </select><br>

        <select class="input_form" id="city_id" name="publishers[city]">
            <option>Місто</option>
        </select><br>

        <input type="text" class="input_form" name="publishers[street]"> <label>Вулиця</label><br>
        <input type="text" class="input_form" name="publishers[house]"> <label>Дім</label><br>
        <input type="text" class="input_form" name="publishers[index]"> <label>Поштовий індекс</label><br>
        <input type="text" class="input_form" name="publishers[contact]"> <label>Контактна особа</label><br>
        <input type="submit" class="input_form" value="обрахувати"">
    </form>
</div>
<?php
if (count($error) != 0) {
    foreach ($error as $key => $value) {
        echo "<br>" . $value . "<br>";
    }
}
?>

<div id="answer">
    <p style="color: red"><b> <b/></p>
</div>
