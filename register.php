<?php include('server.php') ?>
<?php include_once "header.php"; ?>
<div class="title">
    <div class="container">
        <div class="title-text">
            <h1>
                Регистрация
            </h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row content justify-content-center">
        <form action="/register.php" method="post" class="contactform">
        <?php include('errors.php'); ?>
            <div class="">
                <div class="contactform-row">
                    <input class="contactform-input" type="text" name="email" placeholder="Email">
                </div>
                <div class="contactform-row">
                    <input class="contactform-input" type="password" name="password1" placeholder="Пароль">
                </div>      
                <div class="contactform-row">
                    <input class="contactform-input" type="password" name="password2" placeholder="Повторите пароль">
                </div>             
                <div class="d-flex justify-content-center">
                    <button type="submit" class="button-main" name="reg_user">
                        Отправить
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once "footer.php";?>