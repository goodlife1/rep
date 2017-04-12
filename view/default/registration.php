
<form  method="post">
    <p><b>Реєстрація</b><br></p>
<input class="books" type="text" name="name"> Ім`я<br >
<input class="authors" type="password" name="password"> Пароль<br>
<!--<input class="authors" type="password" name="repassword"> Повторіть пароль<br>-->
<input class="publishers" type="email" name="email"> Емаїл<br>
    <button type="submit" class="btn btn-primary">Primary</button>
    <?php
    if (isset($model->errors)):
    foreach ($model->errors as $error): ?>
        <p style="color: white"><?php echo $error ?></p>
    <?php endforeach;
    endif;
    ?>
</form>


<style>
    input{
        color: black;
    }
    form{
        border-radius: 20%;
        margin-top: 5%;
        padding: 5%;
        background-color: cadetblue;
        width: 45%;
        color: white;
    }
    input{
        margin-bottom: 5px;
    }
</style>

