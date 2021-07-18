<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $link = mysqli_connect("localhost", "root", "mamta1234@", "cerebrokids");
    if(mysqli_connect_error())
    {
        die("Error in connection to the database");
    }
    
        $filename=  $_FILES["imgfile"]["name"];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["imgfile"]["name"]);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mother = $_POST['mother'];
        $father = $_POST['father'];
        $address = $_POST['address'];
        $pincode = $_POST['pincode'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $email = $_POST['mEmail'];
        $password = $_POST['mPassword'];
    
      if ((($_FILES["imgfile"]["type"] == "image/gif")|| ($_FILES["imgfile"]["type"] == "image/jpeg") || ($_FILES["imgfile"]["type"] == "image/png")  || ($_FILES["imgfile"]["type"] == "image/pjpeg")) && ($_FILES["imgfile"]["size"] < 200000))
      {
        $query = "SELECT `id` FROM `user` WHERE `email` = '".mysqli_real_escape_string($link, $_POST['mEmail'])."'";
        $result = mysqli_query($link, $query);
        $query1 = "SELECT `id` FROM `user` WHERE `file_path` = '$target_file'";
        $result1 = mysqli_query($link, $query1);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<script>";
            echo 'alert("This email address has already been taken. Redirecting to login page......");';
            echo 'window.location.href = "Login.php";';
            echo "</script>";
        }
        else if(mysqli_num_rows($result1) > 0)
        {
            echo "<script>";
            echo 'alert("Image already uploaded...");';
            echo "</script>";
          
        }
        else
        {
            move_uploaded_file($_FILES["imgfile"]["tmp_name"],"uploads/$filename");
            $query = "INSERT INTO `user` (`fname`, `lname`, `mother`, `father`, `address`, `pincode`, `city`, `state`, `country`, `gender`, `email`, `password`, `file_path`) VALUES ('$fname', '$lname', '$mother', '$father', '$address', '$pincode', '$city', '$state', '$country', '$gender', '$email', '$password', '$target_file')";
            $sql = mysqli_query($link, $query);
            if($sql)
            {
                echo "<script type='text/javascript'>";
                echo "alert('Sign Up successful.......')";
                echo "</script>";
                echo "<script type='text/javascript'>";
                echo 'window.location.href = "Login.php";';
                echo "</script>";
            }
            else
            {
                echo "<script type='text/javascript'>";
                echo "alert('Error occurred.......')";
                echo "</script>";
            }
        }
      }
      else
      {
        echo "<script>";
        echo 'alert("Enter valid image...");';
        echo "</script>";
      }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
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
            #message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
        </style>
    </head>
    <body>
        <nav class="navbar navbar-light bg-white shadow">
            <div class="container-fluid">
                <img class="ms-5" src="https://www.cerebrokids.com/ckimages/nikko.png" alt="" width="60" height="60" class="d-inline-block align-text-top">
                <a class="text-decoration-none navtitle" href="#">
                    <span class="fs-2 fw-bold">Sign Up</span><br><span>Registration</span>
                </a>
            </div>
        </nav>
    <div class="container-fluid bgstyle">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img
                                    src="http://blog.rismedia.com/wp-content/uploads/2017/04/iStock-516722846-e1493106639326.jpg"
                                    alt="Sample photo"
                                    width="550"
                                    height="600"
                                    style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;"
                                />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase text-center">Registration form</h3>

                                    <form method="POST" enctype="multipart/form-data" id = "form1" runat = "server" name='form' onsubmit="return validateForm()">

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <span class="fs-3">ProfilePicture: </span><input type ='file' id = "imgfile" name="imgfile"  required />
                                            </div>
                                            <div class="col-md-6 mb-4">
                                            <img id = "myid" src = "https://tse1.mm.bing.net/th?id=OIP.FUYG2ULJI1LzxUqxK9pCZQHaHa&pid=Api&P=0&w=300&h=300" alt = "new image" height="150" width="120" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" required id="fname" name="fname" class="form-control form-control-lg" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" placeholder="First name"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" id="lname" name="lname" class="form-control form-control-lg" placeholder="Last name"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" id="mother" name="mother" class="form-control form-control-lg" placeholder="Mother's name"/>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" required id="father" name="father" class="form-control form-control-lg" placeholder="Father's name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4">
                                        <input type="text" required id="address" name="address" class="form-control form-control-lg" placeholder="Address"/>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <input type="text" required id="pincode" name="pincode" class="form-control form-control-lg" placeholder="Pincode" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" minlength="6" maxlength="6"/>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <input type="text" required id="city" name="city" class="form-control form-control-lg" placeholder="City" onkeypress="return(event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <input type="text" required id="state" name="state" class="form-control form-control-lg" placeholder="State" onkeypress="return(event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <input type="text" required id="country" name="country" class="form-control form-control-lg" placeholder="Country" onkeypress="return(event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/>
                                            </div>
                                        </div>

                                        <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                            <h6 class="mb-0 me-4">Gender: </h6>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input
                                                class="form-check-input"
                                                type="radio"
                                                name="gender"
                                                id="female"
                                                name="female"
                                                value="Female"
                                                required
                                                />
                                                <label class="form-check-label" for="femaleGender">Female</label>
                                            </div>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input
                                                class="form-check-input"
                                                type="radio"
                                                name="gender"
                                                id="male"
                                                name="male"
                                                value="Male"
                                                required
                                                />
                                                <label class="form-check-label" for="maleGender">Male</label>
                                            </div>

                                            <div class="form-check form-check-inline mb-0">
                                                <input
                                                class="form-check-input"
                                                type="radio"
                                                name="gender"
                                                id="other"
                                                name="other"
                                                value="Other"
                                                required
                                                />
                                                <label class="form-check-label" for="otherGender">Other</label>
                                            </div>

                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" required id="mEmail" name="mEmail" class="form-control form-control-lg" placeholder="Email"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" required id="mPassword" name = "mPassword" class="form-control form-control-lg" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                                        </div>

                                        <div id="message">
                                            <h3>Password must contain the following:</h3>
                                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                            <p id="number" class="invalid">A <b>number</b></p>
                                            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" required id="confirmpassword" name="confirmpassword" class="form-control form-control-lg" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input
                                            class="form-check-input me-2"
                                            type="checkbox"
                                            value=""
                                            id="form2Example3c"
                                            required
                                            />
                                            <label class="form-check-label" for="form2Example3">
                                            I agree all statements in <a href="#!">Terms of service</a>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="reset" class="btn btn-light btn-lg">Reset</button>
                                            <button type="submit" class="btn btn-warning btn-lg ms-2" name="submit" value="upload">Register</button>
                                        </div>

                                        <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="Login.php" class="fw-bold text-body"><u>Login here</u></a></p>
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

    <script>
        function validateForm() {
  var pass = document.forms["form"]["mPassword"].value;
  var confpass = document.forms["form"]["confirmpassword"].value;
  if (pass != confpass) {
    alert("Password and Confirm password field should have same value...");
    return false;
  }
  return true;
}

var myInput = document.getElementById("mPassword");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

        function display(input) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(event) {
         $('#myid').attr('src', event.target.result);
      }
      reader.readAsDataURL(input.files[0]);
   }
}

$("#imgfile").change(function() {
   display(this);
});
    </script>
    </body>
</html>
