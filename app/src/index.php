<!DOCTYPE html>
<!-- 
    основной фалй файл шаблона через который просходят все манипуляции
 -->

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css" />

    <style type="text/css" media="all">
        @import url("/app/css/app.css");
    </style>

    <script src="/app/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="/app/js/main.js"></script>
</head>

<body>
    <?php

    require_once 'core.php'; // рекуярим необходимый файл

    $Apic = new ApiController(); // создаем эземпляр нашего класса

    $response = $Apic->Cards(2); // в переменной указан класс который берет метод который в свою очередь возвращает кредитки


    ?>

    <div class="container">
        <div class="row ">
            <div class="col-md-4 col-md-offset-4">
                <div class="credit-card-div">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row ">
                                <div class="col-md-12">
                                    <select id="card-number" type="text" class="form-control" placeholder="Enter Card Number">
                                        <?php
                                        $number = 0;
                                        foreach ($response as $respo) {
                                            echo "<option value=$number>" . $respo['number'] . "</option>";
                                            $number++;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row ">
                                <div id="card-info">
                                    <span class="help-block text-muted small-font"></span>
                                    <select id="expiry-date" class="card-expiration-date" type="text" placeholder="date of expire">
                                        <?php
                                        $number = 0;
                                        foreach ($response as $respo) {
                                            $expiration_dates = $respo['action_date'];
                                            echo "<option value=$number>" . $expiration_dates . "</option>";
                                            $number++;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div id="form-container" class="row" class="container">
                                    <form id="my-form">
                                        <button type="submit" class="button">Отправить заявку</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!-- ./credit-card-div -->

            </div>
        </div>
    </div><!-- /.container -->


</body>

</html>
