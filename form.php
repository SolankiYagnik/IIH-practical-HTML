<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Application</h2>
        <form class="row g-3" enctype="multipart/form-data" id="myform">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Name">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="example@gmail.com">
            </div>
            <div class="col-6">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" name="contact_number" id="contact_number"
                    placeholder="7894561234">
            </div>
            <div class="col-sm-10">
                <label for="gender" class="form-label">Gender </label>
                <input class="form-check-input" type="radio" name="gender" id="gender" value="male" checked>
                <label class="form-check-label" for="male">
                    Male
                </label>
                <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
                <label class="form-check-label" for="female">
                    Female
                </label>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Profile Img</label>
                <input class="form-control" name="profile_img" type="file" id="profile_img" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-check-label" for="flexCheckDefault">
                    Hobbies :
                </label>
                <input class="form-check-input" type="checkbox" name="hobbies[]" value="project coordinator"
                    id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Project Coordinator
                </label>
                <input class="form-check-input" type="checkbox" name="hobbies[]" value="developer" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Developer
                </label>
                <input class="form-check-input" type="checkbox" name="hobbies[]" value="project manager"
                    id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Project Manager
                </label>
                <input class="form-check-input" type="checkbox" name="hobbies[]" value="hr" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    HR
                </label>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Country</label>
                <?php
                $url = 'http://127.0.0.1:8000/api/get/country';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                $result = curl_exec($ch);
                curl_close($ch);
                $resultArray = json_decode($result, true);
                // print_r($resultArray);die; 
                ?>
                <select id="country" name="country" class="form-select" id="country-list" onchange="getState(this.value)">
                <option value disabled selected>Select Country</option>
                <?php foreach($resultArray as $country) { ?>
                    <option value="<?= $country['id'] ?? '' ?>"><?= $country['name'] ?? ''; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select name="state" id="state-list" class="form-select" onchange="getCity(this.value)">
                    <option value="">Select State</option>
                </select>

            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <select name="city" id="city-list" class="form-select">
                    <option>Select City</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
         $("#myform").validate({
            ignore: ".ignore",
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                contact_number: {
                    required: true,
                    number: true
                },
                gender: "required",
                // profile_img: {
                //     required: true,
                //     extension: "png|jpg|jpeg"
                // },
                hobbies: "required",
                country: "required",
                state: "required",
                city: "required",
            },
            messages: {
                // profile_img: {
                //     required: "Please upload file.",
                //     extension: "Please upload file in these format only (jpg, jpeg, png)."
                // }
            },
            submitHandler: function(form) {
                // some other code
                // maybe disabling submit button
                // then:
                // var formData = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "http://127.0.0.1:8000/api/users",
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        $('#myform').trigger('reset');
                    }
                });
            }
        });

        $('#country').change( function() {
            var id = $(this).val();
            // alert(val);
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/get/state",
                data:'country_id='+id,
                success: function(data) {
                    // console.log(data);
                }
            });
        });

        function getState(val) {
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/get/state",
                data:'country_id='+val,
                beforeSend: function() {
                    $("#state-list").addClass("loader");
                },
                success: function(data) {
                    var html = '';
                    $.each(data, function(key, value) {
                        html += "<option value=" + value.id + ">" + value.name + "</option>";
                    });
                    $('#state-list').html(html);
                }
            });
        }

        function getCity(val) {
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/get/city",
                data:'state_id='+val,
                beforeSend: function() {
                    $("#city-list").addClass("loader");
                },
                success: function(data){
                    var html = '';
                    $.each(data, function(key, value) {
                        html += "<option value=" + value.id + ">" + value.name + "</option>";
                    });
                    $('#city-list').html(html);
                }
            });
        }

    </script>
</body>

</html>