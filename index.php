<?php
require_once "dbconnect.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600|Playfair+Display:700|Roboto:400,700" rel="stylesheet">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
</head>
<body>
    <?php include_once "header.php"; ?>

    <div class="title">
        <div class="container">
            <div class="title-text">
                <h1>
                    Главная
                </h1>
            </div>
        </div>
    </div>

    <!--page-->
    <div class="container">
        <div class="row content">
            <!--content-->
            <div class="col-md-12">
                <div class="content-main">

                    <?php
                        $page = $_GET['page'];
                        $sql = "select * from posts LIMIT 10 OFFSET :offset";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bindValue(':offset', (int)$page, PDO::PARAM_INT);
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $key => $row) {
                            ?>
                                <div class="post">
                                    <div class="post-info">
                                        <h4>
                                            <a href="/post.php?id=<?=$row['id'];?>">
                                                <?= $row['title']?>
                                            </a>
                                        </h4>
                                        <p class="post-text">
                                            <?= substr($row['content'], 0, 200) . "...";?>
                                        </p>
                                        <div class="post-meta">
                                            <button class="button-main" onclick="window.location.href = '/post.php?id=1';">
                                                Подробнее
                                            </button>
                                            <span>
                                                <?= $row['date']?>
                                            </span>
                                        </div>
                                    </div>
                            </div>
                            <!--end post -->
                            <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <!--/content-->
        </div>
    </div>

    <!--page-->
<?php include_once "footer.php";?>
</body>
</html>