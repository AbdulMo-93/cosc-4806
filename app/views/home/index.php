<h1>Hey, <?=$_SESSION['username']?></h1>
    <p class="lead"> <?= date("F jS, Y"); ?></p>
    <a href="/logout"> logout! </a>
      

    <?php require_once '../app/views/templates/footer.php' ?>
