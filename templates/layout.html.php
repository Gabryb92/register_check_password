<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">
    <title><?php echo $title ?></title>
</head>
<body>
    
    <header class="container d-flex justify-content-center">
        <h1>Test Register</h1>
    </header>

    <?php if(isset($error)):?>
        <div class='container alert alert-danger mt-2'><?=$error?></div>
    <?php endif?>

    <?php if(isset($message)):?>
        <div class='container alert alert-success mt-2'><?=$error?></div>
    <?php endif?>
    

    <main class="container">
        <div class="row d-flex justify-content-center p-5">
            <div class="col-12 col-md-10 justify-content-center align-items-center flex-column border p-3">
                <?php echo $output ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>