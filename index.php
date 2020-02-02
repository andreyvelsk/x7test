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
                        $page = htmlspecialchars($_GET['page']);
                        $limit = 10;
                        $sql = "select count(*) from posts";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->execute();
                            $page_count = (int)(($stmt->fetch()[0]-1)/$limit +1);
                        }
                        if($page < 1) $page = 1;
                        if ($page > $page_count) $page = $page_count;
                        $sql = "select * from posts LIMIT :limit OFFSET :offset";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bindValue(':offset', (int)$page*$limit - $limit, PDO::PARAM_INT);
                            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $key => $row) {
                            ?>
                                <div class="post">
                                    <div class="post-info">
                                        <h4>
                                            <a href="/post.php?id=<?=$row['id'];?>">
                                                <?= $row['title']?>
                                                <?= $row['id']?>
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
                        <nav>
                            <ul class="pagination">
                            <li class="page-item <?php if($page==1) echo "disabled"?> ">
                                <a class="page-link" href="/?page=1">First</a>
                            </li>
                            <li class="page-item <?php if($page==1) echo "disabled"?> ">
                                <a class="page-link" href="/?page=<?=$page-1?>"><</a>
                            </li>
                        <?php
                        $counter = 0;
                        for ($i=1; $i<=$page_count; $i++){
                            if ($i < $page - 3 || $i > $page + 3) continue;
                            if ($i == $page) $active = "active";
                            else $active = "";
                            echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                            $counter++;
                        }

                        ?>
                            <li class="page-item <?php if($page==$page_count) echo "disabled"?> ">
                                <a class="page-link" href="/?page=<?=$page+1?>">></a>
                            </li>
                            <li class="page-item <?php if($page==$page_count) echo "disabled"?> ">
                                <a class="page-link" href="/?page=<?=$page_count?>">Last</a>
                            </li>
                            </ul>
                        </nav>
                        <?php                        
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