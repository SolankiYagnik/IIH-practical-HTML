<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application Users Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Users List</h2>
        <a href="form.php" class="btn btn-primary">Create</a>
        <?php
            $url = 'http://127.0.0.1:8000/api/users';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            curl_close($ch);
            $resultArray = json_decode($result, true);
            // print_r($resultArray);die;
        ?> 
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Gender</th>
                        <th>Profile Img</th>
                        <th>Hobbies</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th colspan="5">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultArray as $user) { ?> 
                    <tr>
                        <td><?= $user['id'] ?? '' ?></td>
                        <td><?= $user['name'] ?? '' ?></td>
                        <td><?= $user['email'] ?? '' ?></td>
                        <td><?= $user['contact_number'] ?? '' ?></td>
                        <td><?= $user['gender'] ?? '' ?></td>
                        <td><?= $user['profile_img'] ?? '' ?></td>
                        <td><?= $user['hobbies'] ?? '' ?></td>
                        <td><?= $user['country_id'] ?? '' ?></td>
                        <td><?= $user['state_id'] ?? '' ?></td>
                        <td><?= $user['city_id'] ?? '' ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            <a href="show.php/<?= $user['id'] ?>" class="btn btn-primary btn-sm">Show</a>
                            <button value="<?= $user['id'] ?>" id="delete_user" type="button" class="btn btn-primary btn-sm">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $('#delete_user').click(function(){
            var id = $(this).val();

            $.ajax({
                type: "DELETE",
                url: "http://127.0.0.1:8000/api/users/"+id,
                data: id,
                dataType: "json",
                success: function (response) {
                    alert('User deleted successfully!');
                    location.reload();
                }
            });
        });
    </script>
</body>

</html>