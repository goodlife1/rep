<div class="panel panel-info" style="margin-right: 5%">
    <div class="panel-heading"><?php echo $model['name'] ?></div>
    <div class="panel-body" style="background-color: whitesmoke">
        <img src="<?php echo $model['image_path'] ?>" class="img-rounded" alt="Cinque Terre" width="304" height="236"
             style="float: left;padding: 3%">
        <div style="height: 90%">
            <b><p>Date: <?php echo $model['year_production'] ?></p></b><br>
            <div style=" margin-right: 5%"><p><?php echo $model['description'] ?></p></div>
        </div>
        <!--create comment-->
        <script src="/public/js/starrr.js"></script>
        <script>

            function marks(mark, id) {
                $.ajax({
                    type: 'POST',
                    url: '/books/comment_mark/' + mark + "/" + id,
                    data: 'address=asd',
                    success: function (data) {



                    }
                });
            }
            var number = 1;
            var name;
            function col() {
                $.ajax({
                    type: 'POST',
                    url: '/books/comments/<?php echo $id?>/' + number,
                    data: 'position=' + number,
                    success: function (data) {
                        var comment = "";
                        console.log(data);
                        if (data.parent != null) {
                            for (var i = 0; i < data.parent.length; i++) {
                                name = data.parent[i].name;
                                if (data.parent[i].mark == null) {
                                    data.parent[i].mark = 0;

                                }
                                comment += " <div class=\"conteiner\" style=\"width: 100%;height: auto;overflow:hidden;\">" +
                                    "<b style=\"float: left;margin-left: 3%\">" + data.parent[i].name + "</b><br>" +
                                    "<img src=\"" + data.parent[i].img + "\" class=\"img-circle\" alt=\"Cinque Terre\" width=\"40\" height=\"40\"style=\"float: left;margin-left: 3%\">" +
                                    "<div class=\"form-control\" style=\"width: 70%; height: auto; margin-left: 1%;float: left;\">" +
                                    "<p style='margin-bottom: 0%'>" + data.parent[i].created_at + "<button type=\"button\" class=\"btn btn-link btn-xs reply\" id='" + data.parent[i].name + "' parent=\"" + data.parent[i].comment_id + "\" \">reply</button></p>";

                                if (data.parent[i].id != <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 0; ?> && <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 0; ?>) {
                                    comment += "<input id=\"" + data.parent[i].comment_id + "\"  value=\"" + data.parent[i].mark + "\" type=\"text\" class=\"rating rating-input \" data-min=\"0\" data-max=\"5\" data-step=\"1\" data-size=\"s\" title=\"\">";
                                }
                                if(data.parent[i].rating != null){
                                    comment += "<p>rating = "+data.parent[i].rating+"</p>"

                                }
                                comment += "<p>" + data.parent[i].comment + "</p></div>";
                                if (data.parent[i].id == <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 0; ?> ) {
                                    comment += "<button id ='" + data.parent[i].comment_id + "' type=\"button\" class=\"btn btn-link btn-xs edit\">edit</button><br>" +
                                        "<button id ='" + data.parent[i].comment_id + "' type=\"button\" class=\"btn btn-link btn-xs delet\">delete</button>";
                                }

                                if (data.children[data.parent[i]['comment_id']] != null) {

                                    var lenght = Object.keys(data.children[data.parent[i]['comment_id']]).length;
                                    var model = data.children[data.parent[i]['comment_id']];

                                    for (var j = 0; j < lenght; j++) {
                                        if (model[j].mark == null) {
                                            model[j].mark = 0;

                                        }
                                        comment += "<div class=\"conteiner\" style=\"width: 100%;height: auto;overflow:hidden;\">" +
                                            "<b style=\"float: left;margin-left: 13%\">" + model[j].name + "</b><br>" +
                                            "<img src=\"" + model[j].img + "\" class=\"img-circle\" alt=\"Cinque Terre\" width=\"40\" height=\"40\"style=\"float: left;margin-left: 13%\">" +
                                            "<div class=\"form-control\" style=\"width: 60%; height: auto; margin-left: 1%;float: left\">" +
                                            "<p style='margin-bottom: 0%'>" + model[j].created_at + " <button type=\"button\" class=\"btn btn-link btn-xs reply\" id='" + model[j].name + "' parent=\"" + data.parent[i].comment_id + "\" \">reply</button></p>";
                                        if (model[j].id != <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 0; ?> && <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 0; ?>) {
                                            comment += "<input id=\"" + model[j].comment_id + "\"  value=\"" + model[j].mark + "\" type=\"text\" class=\"rating rating-input \" data-min=\"0\" data-max=\"5\" data-step=\"1\" data-size=\"s\" title=\"\">";
                                        }
                                        if(model[j].rating != null){
                                            comment += "<p>rating = "+model[j].rating+"</p>"

                                        }
                                        comment += "<p>" + model[j].comment + "</p></div>";
                                        if (model[j].id == <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 0; ?>) {

                                               comment+= "<button id='" + model[j].comment_id + "' type=\"button\" class=\"btn btn-link btn-xs edit\" edit>edit</button></br>" +
                                                "<button id='" + model[j].comment_id + "' type=\"button\" class=\"btn btn-link btn-xs delet\">delete</button></div>";
                                        }
                                    }
                                }

                                comment += "</div>";


                                jQuery(document).ready(function () {
                                    $(".rating").rating({
                                        starCaptions: function (val) {
                                            if (val < 3) {
                                                return val;
                                            } else {
                                                return 'high';
                                            }
                                        },
                                        starCaptionClasses: function (val) {
                                            if (val < 3) {
                                                return 'label label-danger';
                                            } else {
                                                return 'label label-success';
                                            }
                                        },
                                        hoverOnClear: false
                                    });
                                    var $inp = $('#rating-input');

                                    $inp.rating({
                                        min: 0,
                                        max: 5,
                                        step: 1,
                                        size: 'lg',
                                        showClear: false
                                    });

                                    $('#btn-rating-input').on('click', function () {
                                        $inp.rating('refresh', {
                                            showClear: true,
                                            disabled: !$inp.attr('disabled')
                                        });
                                    });


                                    $('.btn-danger').on('click', function () {
                                        $("#kartik").rating('destroy');
                                    });

                                    $('.btn-success').on('click', function () {
                                        $("#kartik").rating('create');
                                    });

                                    $inp.on('rating.change', function () {
                                    });


                                    $('.rb-rating').rating({
                                        'showCaption': true,
                                        'stars': '3',
                                        'min': '0',
                                        'max': '3',
                                        'step': '1',
                                        'size': 'xs',
                                        'starCaptions': {
                                            0: 'status:nix',
                                            1: 'status:wackelt',
                                            2: 'status:geht',
                                            3: 'status:laeuft'
                                        }
                                    });
                                    $("#input-21c").rating({
                                        min: 0, max: 8, step: 0.5, size: "xl", stars: "8"
                                    });
                                });

                                $(document).ready(function () {

                                    $('.reply').click(function () {
                                        $('.new_comment').val($(this).attr('id') + " >> ");
                                        $('.parent').val($(this).attr('parent'));
                                        var target_top = $('.img-rounded').offset().top;
                                        $('html, body').animate({scrollTop: target_top}, 'slow');
                                    });
                                    $('.delet').click(function () {
                                        var id = $(this).attr('id');
                                        $.ajax({
                                            type: 'POST',
                                            url: '/books/delete_comment/' + id,
                                            data: 'address=asd',
                                            success: function (data) {
                                                col();
                                            }
                                        });
                                    });
                                    $('.edit').click(function () {
                                        $('.edit_comment').css("display", "block");
                                        $(".new_comment").val("Перепишіть свій коментар ...");
                                        $('.parent').val($(this).attr('id'));
                                        var target_top = $('.img-rounded').offset().top;
                                        $('html, body').animate({scrollTop: target_top}, 'slow');
                                    });
                                    $(".edit_comment").click(function () {
                                        var message = $('.new_comment').val();
                                        var parent = $('.parent').val();
                                        $.ajax({
                                            type: 'POST',
                                            url: "/books/edit_comment/" + parent + "",
                                            data: 'comment=' + message,
                                            success: function (data) {
                                                $('.edit_comment').css("display", "none");
                                                col();
                                            }
                                        });
                                    });

                                });

                                $(".comments").html(comment);
                                $(".rating").change(function () {
                                    console.log($(this).val() + $(this).attr('id'));
                                    marks($(this).val(), $(this).attr('id'));
                                });


                            }
                        }else {
                            $(".comments").html("");
                        }



                    }
                    ,
                    dataType: 'json'
                })
                ;
            }
        </script>

        <?php if (isset($_SESSION['user'])): ?>
            <div class="conteiner">
                <div class=" ">
                    <form method="post" action="books/new_comment" style="margin-top: 30%" class="form">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control new_comment" rows="5" id="comment"
                                  style="width: 70%;margin-left: 8%"></textarea>
                        <input class="parent" type="text" hidden value="0">
                        <button type="reset" class="btn btn-primary btn-xs edit_comment"
                                style="margin-left:70%;margin-top: 1%;display: none">
                            edit
                        </button>
                        <button type="reset" class="btn btn-primary btn-xs send"
                                style="margin-left:70%;margin-top: 1%">
                            відправити
                        </button>


                    </form>
                </div>
            </div>
            <script>

                $('.send').click(function () {
                    var message = $('.new_comment').val();
                    var parent = $('.parent').val();
                    $.ajax({
                        type: 'POST',
                        url: '/books/new_comment/' + parent,
                        data: 'comment=' + message + '&book_id=<?php echo $id; ?>',
                        success: function (data) {
                            col();
                        }

                    });



                });

            </script>
        <?php endif; ?>

        <!-- end create coment-->
        <div style="position: relative; margin-top: 2%" class="comments">

            <!--            --><?php //endforeach; ?>
        </div>
        <script src="/public/js/pagination.js"></script>

        <!--    Pagination   -->
        <div style=" width: 100%; height: 5%;margin-top: 5%">
            <div class=""
            ">
            <p class=" demo2" style="margin-left: 25%">

            </p>
        </div>

        <script>
            $('.demo2').bootpag({
                total: <?php echo $comments+3?>,
                page: 1,
                maxVisible: 5
            }).on('page', function (event, num) {
                number = num;
                var commen = "";
                var name;
                $.ajax({
                    type: 'POST',
                    url: '/books/comments/<?php echo $id?>/' + num,
                    data: 'position=' + num,
                    success: function (data) {
                        col();
                    },
                    dataType: 'json'
                })
                ;
            })
            ;
        </script>
    </div>
    <!--   End Pagination -->
</div>

<script>


    $(document).ready(function () {

        col();
    });

</script>


