<?php
$postid = htmlspecialchars($_GET['id']);
include "addcomment.php";
include_once "header.php"; 

$sql = "select * from posts WHERE id = :id";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindValue(':id', (int)$postid);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row != null) {
        ?>
            <div class="title">
                <div class="container">
                    <div class="title-text">
                        <h1>
                            <?= $row['title']?>
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
                            <?= $row['content']?>
                        </div>
                        <div class="content-date">
                            <?= $row['date']?>
                        </div>
                    </div>
                    <!--/content-->
                </div>

                <h2>Комментарии</h2>
                <?php
                    $sql = "select c.* from comments c WHERE idpost = :idpost";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bindValue(':idpost', (int)$postid);
                        $stmt->execute();
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($rows != null) {
                            foreach ($rows as $key => $row) {
                                ?>
                                    <div class="comment">
                                        <div class="comment-item">
                                            <div class="comment-text">
                                                <?= nl2br($row['commenttext'])?>
                                            </div>
                                            <div class="comment-meta">
                                            <?= $row['commentuser']?>, <?= $row['commentdate']?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                
                        } else {
                            ?>
                                <div class="content">
                                    Нет комментариев
                                </div>
                            <?php
                        }
                    }                    
                ?>
                <?php  
                if (isset($_SESSION['username'])) { 
                ?>
                <h2>Добавить комментарий</h2>
                <form action="/post.php?id=<?=$postid;?>" method="post" class="contactform contactform-comment">
                <?php include('errors.php'); ?>
                    <div class="contactform-row">
                        <input class="contactform-input" type="text" name="username" placeholder="Имя">
                    </div>
                    <div class="contactform-row">
                        <textarea class="contactform-input" name="comment" placeholder="Комментарий"></textarea>
                    </div>                
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="button-main" name="add_comment">
                            Отправить
                        </button>
                    </div>
                </form>
                <?php 
                }
                ?>
            </div>

            <!--page-->
        <?php
        }
        else {
            echo "404";
        }
    }
?>

<?php include_once "footer.php"; ?>