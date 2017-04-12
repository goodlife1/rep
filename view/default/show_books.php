<div id="title" style="margin-left: 200px"><h1>SoftGroup </h1><h3>Тестове Завдання</h3> </div>
<br>
<div class="books">
    <?php foreach ($model as $m): ?>

        <div class="book" style="float: left;width: 200px;height:auto; ">
            <p><a href="/books/show/<?php echo $m['id']; ?>" style="color: white"> <?php echo $m['name'] ?></a></p>
            <img class="img-thumbnail" height="200" src="<?= $m['image_path'] ?>" width="200" style="height: 150px; width: 150px;"></img>

        </div>
    <? endforeach; ?>
    <br>
</div>

<style>
    .pagination bootpag{
        width: 100%
    }
    .book {
        background-color: cadetblue;
        margin-left: 5%;
        margin-top: 1%;
        color: white;
        padding: 1%;
        border-radius: 5%;


    }
</style>
<br/>

<script src="/public/js/pagination.js"></script>

<div style=" width: 100%; height: 5%;margin-top: 65%">
<div class=""">
    <p class=" demo2" style="margin-left: 25%">

    </p>
</div>
</div>
<script>
    $('.demo2').bootpag({
        total: <?php echo $count?>,
        page: 1,
        maxVisible: 10
    }).on('page', function(event, num){
        $.ajax({
            type: 'POST',
            url: '/books',
            data: 'position=' + num,

            success: function (data) {
                var content = data.map(function(d) {
                    return "<div class=\"book\" style=\"float: left;width: 200px;height:auto; \">" +
                        "<p><a href=\"/books/show/"+d.id+"\" style=\"color: white\">"+d.name+"</a></p>" +
                        "<img class=\"img-thumbnail\" height=\"200\" src=\""+d.image_path+"\" width=\"200\" style=\"height: 150px; width: 150px;\">"+


                    "</div>";
                });
                $('.books').html(content);




            },
            dataType: 'json'
        });
    });
</script>

