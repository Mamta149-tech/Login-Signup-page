<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $link = mysqli_connect("localhost", "root", "mamta1234@", "cerebrokids");
    if(mysqli_connect_error())
    {
        die("Error in connection to the database");
    }
        $email = $_POST['mEmail'];
        $password = $_POST['mPassword'];
        $query = "SELECT * FROM `user` WHERE `email` = '$email'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        if(mysqli_num_rows($result) == 0)
        {
            echo "<script>";
            echo 'alert("Email does not exists...");';
            echo "</script>";
        }
        else if($password != $row['password'])
        {
            echo "<script>";
            echo 'alert("Email or password incorrect...");';
            echo "</script>";
        }
        else
        {
            echo "<script>";
            echo 'alert("Successfully logged in...");';
            echo 'window.location.href = "Thankyou.html";';
            echo "</script>";
        }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cerebro Kids</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style> 
            .navtitle
            {
                color: black;
            }
            .navtitle:hover
            {
                color: blue;
            }
            .card-registration .select-input.form-control[readonly]:not([disabled]) {
                font-size: 1rem;
                line-height: 2.15;
                padding-left: .75em;
                padding-right: .75em;
            }
            .card-registration .select-arrow {
                top: 13px;
            }
            .bgstyle
            {
                background-color: #abe9cd;
                background-image: linear-gradient(315deg, #abe9cd 0%, #3eadcf 74%);
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-light bg-white shadow">
            <div class="container-fluid">
                <img class="ms-5" src="https://www.cerebrokids.com/ckimages/nikko.png" alt="" width="60" height="60" class="d-inline-block align-text-top">
                <a class="text-decoration-none navtitle" href="#">
                    <span class="fs-2 fw-bold">CerebroKids</span><br><span>The Financial Literacy Academy</span>
                </a>
            </div>
        </nav>
    <div class="container-fluid bgstyle">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img
                                    src="https://www.lifeofpix.com/wp-content/uploads/2018/06/275-ake9822-chim-1600x1090.jpg"
                                    alt="Sample photo"
                                    width="550"
                                    height="600"
                                    style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;"
                                />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase text-center">Login</h3>

                                    <form method="POST" enctype="multipart/form-data" id = "form1" runat = "server" name='form' onsubmit="return validateForm()">

                                        <div class="form-outline mb-4">
                                            <input type="email" required id="mEmail" name="mEmail" class="form-control form-control-lg" placeholder="Email"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" required id="mPassword" name = "mPassword" class="form-control form-control-lg" placeholder="Password"/>
                                        </div>

                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="reset" class="btn btn-light btn-lg">Reset all</button>
                                            <button type="submit" class="btn btn-warning btn-lg ms-2" name="submit" value="upload">Login</button>
                                        </div>
                                        <p class="text-center text-muted mt-5 mb-0">Want to create new account? <a href="index.php" class="fw-bold text-body"><u>Register here</u></a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small pt-4">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2021 Copyright:
            <a class="text-decoration-none text-dark fw-bold" href="#"> CerebroKids</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

    </body>
</html>