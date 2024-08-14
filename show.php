<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Display Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Users List</h2>
        <a href="../index.php" class="btn btn-primary">Back</a>
        <?php
            $parts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            $url = "http://127.0.0.1:8000/api/users/$parts[3]";
            // print_r($url);die;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            curl_close($ch);
            $user = json_decode($result, true);
            // print_r($user);die;
        ?> 

            <h4>ID : <?= $user['id'] ?? '' ?></h4>
            <h4>Name : <?= $user['name'] ?? '' ?></h4>
            <h4>Email : <?= $user['email'] ?? '' ?></h4>
            <h4>Contact Number : <?= $user['contact_number'] ?? '' ?></h4>
            <h4>Gender : <?= $user['gender'] ?? '' ?></h4>
            <h4>Profile Img : <?= $user['profile_img'] ?? '' ?></h4>
            <h4>Hobbies : <?= $user['hobbies'] ?? '' ?></h4>
            <h4>Country : <?= $user['country_id'] ?? '' ?></h4>
            <h4>State : <?= $user['state_id'] ?? '' ?></h4>
            <h4>City : <?= $user['city_id'] ?? '' ?></h4>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</body>

</html>