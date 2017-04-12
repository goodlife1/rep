<p>Пошук</p>
<input checked class="books" type="radio" name="gender"> Пошук по слову
<input class="authors" type="radio" name="gender"> Автори
<input class="publishers" type="radio" name="gender" > Видавництва
<div id="books">
<form method="post">
    <input type="text" class="input_form" name="search"> <input type="submit" class="input_form" value="Пошук""><br>
</form>
<?php
if (isset($result)) {
    foreach ($result as $key => $value) {
        foreach ($value as $k) {
            echo "<br>" . $k . "<br>";
        }
    }
} ?>
</div>
<div id="authors">
    <form  method="post" name="Books" style="width: 450px;height:250px ">

        <input type="text" class="input_form" name="find[author]" ><br>
        <input type="submit" class="input_form" value="Шукати">
    </form>
</div>
<div id="publishers">
    <form  method="post" name="Books" style="width: 450px;height:250px ">
        <input type="text" class="input_form" name="find[publishers]" ><br>
        <input type="submit" class="input_form" value="Шукати">
    </form>
</div>