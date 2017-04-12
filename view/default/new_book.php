<div class="panel panel-primary" style="margin-right: 10%">
    <div class="panel-heading">Нова книжка</div>
    <div class="panel-body">
        <form enctype="multipart/form-data" method="post" action="/books/new_book" style="width: 450px;margin-left: 10% ">
                <div class="form-group">
                    <label for="name">Назва</label>
                    <input type="text" class="form-control" name="name">
                </div>
            <div class="form-group">
                <label for="comment">Опис</label>
                <textarea class="form-control" name="description" rows="5" id="comment"></textarea>
            </div>
                <div class="form-group">
                    <label for="pwd">Рік видавництва</label>
                    <input type="text" name="year" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <input type="file" name="img" class="form-control" id="file">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            <?php
            if (isset($model->errors)):
                foreach ($model->errors as $error): ?>
                    <p style="color: red"><?php echo $error ?></p>
                <?php endforeach;
            endif;
            ?>
            </form>
    </div>
</div>
</div>

    <?php
    if (count($book->errors) != 0) {
        foreach ($book->errors as $key => $value) {
            echo "<br>" . $value . "<br>";
        }
    }
    ?>