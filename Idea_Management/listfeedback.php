<?php include_once "header.php" ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        margin: 50px auto;
        max-width: 800px;
        padding: 0 20px;
        margin-top: 75px;
    }

    .post {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .post h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .post p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0062cc;
    }

    .comment-form {
        display: none;
        margin-top: 20px;
    }

    .comment-form textarea {
        width: 100%;
        height: 100px;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        resize: none;
    }

    .comment-list {
        margin-top: 20px;
    }

    .comment {
        background-color: #f5f5f5;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .comment p {
        font-size: 14px;
        margin-bottom: 5px;
    }

    .comment span {
        font-size: 12px;
        color: #777;
    }

    .button {
        display: inline-block;
        background-color: royalblue;
        color: white;
        padding: 12px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border: none;
        border-radius: 150px;
        cursor: pointer;
        float: right;
    }

    .button-download {
        display: inline-block;
        background-color: black;
        color: white;
        padding: 12px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border: none;
        border-radius: 150px;
        cursor: pointer;
        float: left;
        margin-top: 20px;
        margin-bottom: 20px;

    }

    textarea {
        border: 0;
        outline: 0;
        padding: 1em;
        border-radius: 8px;
        display: block;
        width: 100%;
        margin-top: 1em;
        font-family: "Merriweather", sans-serif;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        resize: none;
    }
</style>
<?php
include_once("config.php");
if (isset($_SESSION["username"])) {
    $us = $_SESSION["username"];
    $sqlString = "SELECT * from account where email= '$us'";
    $result = mysqli_query($conn, $sqlString);
    $row2 = mysqli_fetch_array($result);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlString = "SELECT post.title, feedback.*
FROM post
JOIN feedback ON feedback.post_Id = post.post_Id
WHERE post.post_Id = '$id'
ORDER BY feedback.likes DESC
";
$result = mysqli_query($conn, $sqlString);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

?>

            <body>
                <div class="container">

                    <h1>Post title: <?php echo $row['title']  ?></h1>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="half left cf">
                            <input type="text" name="" id="input-name" readonly value="<?php echo $row['anonymous']; ?>" />
                        </div>
                        <textarea name="feedback" type="text" id="input-message" placeholder="Message" readonly><?php echo $row['feedback']; ?></textarea>
                        <?php
                        if ($row2["role"] == 1) {
                        ?>
                            <button class="button-download">
                                <a href="<?php echo $row['file_path']; ?>" download="<?php echo $row['file_name']; ?>" style="color: #fff;">Download file</a>
                            </button>
                        <?php
                        }
                        ?>
                    </form>
                    <br>
                    <div class="actions">
                        <button id="view-more" class="button" style="background-color:black"onclick="window.location='comment.php?id=<?php echo $row['feedback_Id']; ?>'">Details</button>
                        <button class="button" style="background-color:black"><a style="color:white">Total Like</a>: <?php echo $row['likes'] ?></button>
                    </div>
                </div>
            </body>
        <?php }
    } else {
        ?>

        <body>
            <div class="container">

                <h1 style="text-align:center; color: red">No response</h1>

            </div>
        </body>
<?php
    }
}
?>

<?php
include_once "footer.php"
?>
