<section id="details">
    <div>
        <ul id="switch">
            <li class="selected" data-id="single">Разовое посещение</li>
            <li data-id="course">Курс</li>
            <li data-id="talk">&laquo;Просто поговорить&raquo;</li>
        </ul>
    </div>

    <div id="details-content">
        <div>
            <h3>Разовое посещение</h3>
            <p>Разовая консультация с разбором основных проблем. Часто одной сессии достаточно, чтобы решить текущую проблему.</p>
            <p>В случае, если будет принято решение продолжить работу, мы согласуем с Вами дату, время, стоимость будущих сессий.</p>
            <p>Сессия будет проведена после оплаты.</p>
            <button class="mainbutton revers">Записаться</button>
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
<!--            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">-->
<!--                <div class="carousel-indicators">-->
<!--                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>-->
<!--                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>-->
<!--                </div>-->
<!--                <div class="carousel-inner">-->
<!--                    <div class="carousel-item active">-->
<!--                        <img src="img/depositphotos_250418.jpg" class="d-block w-100" alt="...">-->
<!--                    </div>-->
<!--                    <div class="carousel-item">-->
<!--                        <img src="img/upl_1619631016_62206.jpg" class="d-block w-100" alt="...">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">-->
<!--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--                    <span class="visually-hidden">Previous</span>-->
<!--                </button>-->
<!--                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">-->
<!--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--                    <span class="visually-hidden">Next</span>-->
<!--                </button>-->
<!--            </div>-->
        </div>
    </div>

    <?php require_once WIDGETS . '/feedback.php';?>
</section>
