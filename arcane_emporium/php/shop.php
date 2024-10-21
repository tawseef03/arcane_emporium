<?php

session_start();

$mysqli = require __DIR__ . '/database.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arcane Emporium</title>
    <link rel="stylesheet" href="../css/shop.css">
</head>
<body>
    <header>
        <div class="header">Arcane Emporium</div>
    </header>

    <div class="shop">
    <?php
        //Fetch all items from the database
        $rows = mysqli_query($mysqli, "SELECT * FROM items ORDER BY id ASC")
        ?>
        <?php foreach ($rows as $row) : ?>

            <div class="box">
                <span><img src="../img/<?php echo $row["image"]; ?>" width=150 height=150 title="<?php echo $row['image']; ?>"></span><br>
                <span><?php echo $row["name"]; ?></span><br>
                <span><?php echo $row["description"]; ?></span><br>
                <span style="color: #FFD700"><?php echo $row["price"]; ?> gold</span>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>