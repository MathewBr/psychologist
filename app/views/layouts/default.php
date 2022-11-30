<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $insertedMeta ?>

    <base href="/">

<!--    <link rel="shortcut icon" href="img/psychology.png" type="image/png" />-->
    <link rel="icon" href="img/psychology.png" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="js/summernote/summernote.css">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito">
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
<!--    <link href="carousel/carousel.css" rel="stylesheet">-->
<!--    <script src="ckeditor4/ckeditor.js"></script>-->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/imask"></script>
</head>
<body>
<header>
    <nav class="active">
        <div id="logo"><a href="<?=PATH?>"><img src="img/logo.png" alt=""></a></div>
        <div id="menu">
            <a href="<?=PATH?>#introduce">Обо мне</a>
            <a href="<?=PATH?>#price">Тарифы</a>
            <?php  ?>
<!--            <a href="http://www.host1851972.hostland.pro/" target="_blank">Статьи</a>-->
            <a href="main/showblog" target="_blank">Статьи</a>
            <a href="<?=PATH?>#mycontact">Свяжитесь со мной</a>
        </div>
        <div id="burg"><span></span><span></span><span></span></div>
    </nav>
</header>

<?php echo $content; ?>

<footer id="mycontact">
    <h2>Мои контакты</h2>
    <div class="contact">
        <div>
            <div class="picture"><img src="img/icons-phone-96.png"></div>
            <div class="label">Контакты</div>
            <div class="info">
                <span>E-mail: psy.shipilova@yandex.ru</span><br/>
                <span>WhatsApp +7 977 938 9259</span>
            </div>
        </div>
        <div>
            <div class="picture"><img src="img/icon-location-96.png"></div>
            <div class="label">Адрес</div>
            <div class="info">
                <span>Кабинет на шаболовке</span>
            </div>
        </div>
        <div>
            <div class="picture"><img src="img/icon-skype.png"></div>
            <div class="label">Skype</div>
            <div class="info">
                <span>Skype: iramir14</span>
            </div>
        </div>
    </div>
</footer>
<div id="screen" class="nonActiveMenu"></div>
<div id="cross"><span></span><span></span><span></span></div>

<!-- Button trigger modal -->
<button id="modal" style="display: none" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalbogy" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<?php
$logs = R::getDatabaseAdapter()
    ->getDatabase()
    ->getLogger();
//debug($logs->grep( 'SELECT' ));
?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script src="js/layout.js"></script>
<!--<script src="carousel/carousel.js"></script>-->
<script>
    if (document.getElementById('topic')){
        ClassicEditor.create( document.querySelector( '#topic' ), {
            toolbar: [ 'bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList' ]
        }).catch( error => {
            console.error( error );
        });
    }
</script>
<script>
    let phones = document.querySelectorAll('.phone');
    let maskOptions = {
        mask: '+{7}(000)000-00-00'
    };
    for (let phone of phones){
        let mask = IMask(phone, maskOptions);
    }
</script>
</body>
</html>
