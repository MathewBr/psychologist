<section id="feedback">
    <div class="wrapper">
        <h4>Отправьте заявку, и я вам перезвоню<br> для согласования даты и времени проведения сессии.</h4>
        <div class="feedback">
            <form action="feedback" method="post" class="needs-validation">
                <div id="session">
                    <h5>Пожалуйста, выберите тип сессии:</h5>
                    <div class="radioGroup">
                        <div class="form-check">
                            <input class="form-check-input" id="single" type="radio" name="typesession" value="single" checked>
                            <label for="single">Стандартная сессия</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="multi" type="radio" name="typesession" value="multi">
                            <label for="multi">Неоднократные посещения</label>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="email">Ваш Email</label>
                    <input id="email" type="email" name="email" placeholder="mail@example.com" class="form-control" required>
<!--                    <div class="invalid-feedback">Please choose a username.</div>-->
                </div>
                <div class="group">
                    <label for="mane">Ваше имя</label>
                    <input id="mane" type="text" name="name" placeholder="Олег Петров" class="form-control" required>
                </div>
                <div class="group">
                    <label for="phone">Ваш телефон</label>
                    <input class="phone" id="phone" type="text" name="phone" placeholder="+7(999)999-99-99" class="form-control" required>
                </div>
                <div class="group">
                    <label for="topic">Тема консультации</label>
                    <textarea id="topic" name="topic" placeholder="Тема"></textarea>
                </div>
                <button class="mainbutton send">Отправить</button>
            </form>
            <div class="illustration">
                <img class="show" src="img/standardform.png">
                <img class="nonshow" src="img/multipleform.jpg">
            </div>
        </div>
    </div>
</section>