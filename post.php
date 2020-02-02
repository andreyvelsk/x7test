<?php 
include_once "header.php"; 

$postid = htmlspecialchars($_GET['id']);
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
                    $sql = "select c.*, u.email from comments c LEFT JOIN users u ON c.iduser = u.id WHERE idpost = :idpost";
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
                                                <?= $row['commenttext']?>
                                            </div>
                                            <div class="comment-meta">
                                            <?= $row['email']?>, <?= $row['commentdate']?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                
                        } else {
                            echo "no comments";
                        }
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
</body>
</html>