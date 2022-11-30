<section id="details">
    <div>
        <ul id="switch">
            <li class="<?=$type == 'single' ? 'selected' : ''?>" data-id="single">Разовое посещение</li>
            <li class="<?=$type == 'course' ? 'selected' : ''?>" data-id="course">Курс</li>
            <li class="<?=$type == 'talk' ? 'selected' : ''?>" data-id="talk">&laquo;Просто поговорить&raquo;</li>
        </ul>
    </div>

    <!--#details-content-single, #details-content-course, #details-content-talk-->

    <div id="details-content-single" style="display: <?=$type == 'single' ? 'flex' : 'none'?>">
        <div>
            <h3>Разовое посещение</h3>
            <p>Разовая консультация с разбором основных проблем. Часто одной сессии достаточно, чтобы решить текущую проблему.</p>
            <p>В случае, если будет принято решение продолжить работу, мы согласуем с Вами дату, время, стоимость будущих сессий.</p>
            <p>Сессия будет проведена после оплаты.</p>
            <a href="#feedback"><button class="mainbutton revers my-signup">Записаться</button></a>
        </div>
        <div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="50000">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/depositphotos_250418.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/upl_1619631016_62206.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div id="details-content-course" style="display: <?=$type == 'course' ? 'flex' : 'none'?>">
        <div>
            <h3>Курс</h3>
            <p>Курс из нескольких личных встреч, консультаций и менторством специалиста.</p>
            <p>Шаг за шагом разбираются и прорабатываются все ваши проблемы.</p>
            <p>Сессия будет проведена после оплаты.</p>
            <a href="#feedback"><button class="mainbutton revers my-signup">Записаться</button></a>
        </div>
        <div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="50000">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/photo.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/usluga-personal.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>

    <div id="details-content-talk" style="display: <?=$type == 'talk' ? 'flex' : 'none'?>">
        <div>
            <h3>Тариф «Просто поговорить».</h3>
            <p>Это, когда Вы не можете с кем-то поделиться или никому доверить свои переживания, свою боль свой страх и испытываете негативные эмоции.
                Предлагаю Вам терапевтическую сессия, когда во время общения, Вы проговариваете свою ситуацию, высказываете всё, что «накипело на душе», свои обиды. страхи, переживания.</p>
            <p>Это очень полезно – разделить с кем-то трудную минуту, оформить свои чувства в слова, дать выход зажатым эмоциям. Это как открыть дамбу, чтобы отпустить избыток воды, дать выход негативной энергии. Успокоится. Часто, этого бывает достаточно, чтобы вновь найти комфортный внутренний баланс.</p>
            <p>Сессия будет проведена после оплаты.</p>
            <a href="#feedback"><button class="mainbutton revers my-signup">Записаться</button></a>
        </div>
        <div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="50000">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/2de6bdedd16a5f10b555.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/chto-lechat-u-psihol.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>

    <?php require_once WIDGETS . '/feedback.php';?>
</section>
