<?php
require_once __DIR__ . "/backend/helper.php";
session_start();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="backend/assets/css/bootstrap.css">
    <link rel="stylesheet" href="backend/assets/css/index.css">
    <link rel="stylesheet" href="backend/assets/css/responsive.css">

</head>

<body>

    <div id="Register" class="Register pt-5">
        <div class="body">
            <form class=" w-50 m-auto" method="POST" action="backend/register.php">
                <div class="header text-center">
                    <img src="backend/assets/images/10001.png" class="m-auto" alt="">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="item">
                            <div class="mb-4">
                                <label for="FirstName" class="form-label">first Name:</label>
                                <input type="text" class="form-control" id="FirstName" name="firstName"
                                    value="<?php echo old('firstName') ?>">
                                <?php echo getErr('firstName'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="item">
                            <div class="mb-4">
                                <label for="LastName" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="LastName" name="lastName"
                                    value="<?php echo old('lastName') ?>">
                                <?php echo getErr('lastName'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="item">
                            <div class="mb-4">
                                <label for="Email" class="form-label">Email:</label>
                                <input type="text" class="form-control" id="Email" name="email"
                                    value="<?php echo old('email') ?>">

                                <?php echo getErr('email'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="item">
                            <div class="mb-4">
                                <label for="Password" class="form-label">password:</label>
                                <input type="text" class="form-control" id="Password" name="password"
                                    value="<?php echo old('password') ?>">

                                <?php echo getErr('password'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="item">
                            <div class="mb-4">
                                <label for="Age" class="form-label">Age:</label>
                                <input type="number" class="form-control" id="Age" name="age"
                                    value="<?php echo old('age') ?>">

                                <?php echo getErr('age'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="item">
                            <div class="mb-4">
                                <label for="Phone" class="form-label">Phone:</label>
                                <input type="text" class="form-control" id="Phone" name="phone"
                                    value="<?php echo old('phone') ?>">

                                <?php echo getErr('phone'); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add</button>
            </form>
        </div>
    </div>

    <div id="Search" class="p-5">
        <form id="searchForm" method="POST" class=" w-25 m-auto">
            <div class="mb-4">
                <input type="hidden" name="page" id="ChangePage" value="1">
                <label for="Search" class="form-label">Search:</label>
                <input type="text" class="form-control" id="SearchInput" name="search">
            </div>
            <button type="submit" class="btn btn-success w-100">Search</button>
        </form>
    </div>

    <div id="Data">
        <div class="table-responsive w-75 m-auto">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Age</th>
                        <th scope="col">Phone</th>
                        <th scope="col">options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php require_once __DIR__ . "/components/trOfStudents.php"; ?>
                </tbody>
            </table>
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination text-align-center">
            <?php include __DIR__ . "/components/pagination.php" ?>
        </ul>
    </nav>


    <script src="backend/assets/js/bootstrap.js"></script>
    <script src="backend/assets/js/jquery.js"></script>
    <script src="backend/assets/js/sweetalert.js"></script>
    <script src="backend/assets/js/index.js"></script>
</body>

</html>