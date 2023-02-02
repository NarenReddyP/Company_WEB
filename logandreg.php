<?php
session_start();
ini_set('display_errors',1);

$hostname = "localhost";
$username = "root";
$password = "";
$dbname   = "company_web";

$conn = mysqli_connect($hostname,$username,$password,$dbname);

if(!$conn){
  die("Mysql database connection erorr!!" . mysqli_connect_error());
}

if(isset($_POST['SUBMITsUP'])){

$UserName  = mysqli_real_escape_string($conn, $_POST['user']);
$Email     = mysqli_real_escape_string($conn, $_POST['email']);
$mobile    = mysqli_real_escape_string($conn, $_POST['mobile']);
$Password  = mysqli_real_escape_string($conn, $_POST['password']);
$Cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

$hashpassword = md5($_POST['cpassword']);
#$error = $name_error = $email_error = $password_error = $mobile_error = $cpassword_error;
 #$emaisess = $_SESSION['Email'];
 $rows     = "select * from `user_login_tbl` where email='$Email' ";
 $res      = mysqli_query($conn,$rows);

if (!preg_match("/^[a-zA-Z ]+$/",$UserName)) {
$name_error = "<strong>**Name must contain only alphabets and space**</strong>";
}
else if(mysqli_num_rows($res) > 0){
  $row = mysqli_fetch_assoc($res);
  if($Email==isset($row['Email'])){
  $_SESSION['fail']=0;

  }
}
else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)) {
$email_error = "<strong>**Please Enter Valid Email ID**</strong>";
}
else if(strlen($Password) < 6) {
$password_error = "<strong>**Password must be minimum of 6 characters**</strong>";
}
else if(strlen($mobile) < 10) {
$mobile_error = "<strong>**Mobile number must be minimum of 10 characters**</strong>";
}
else if($Password != $Cpassword) {
$cpassword_error = "<strong>**Password and Confirm Password doesn't match**</strong>";
}
#$error = $name_error = $email_error = $password_error = $mobile_error = $cpassword_error;

else if (empty($_POST['UserID'])) {

  $sql = "INSERT INTO `user_login_tbl` (`UserName`, `Email`,`Mobile`, `Password`, `Cpassword`,`Date`) VALUES ('$UserName', '$Email','$mobile', '$Password', '$hashpassword', now())";
if(mysqli_query($conn, $sql)) {
  echo '<div class="alert alert-success alert-dismissable" id="flash-msg">
<h4 style="color:#439A97;background-image: linear-gradient(to bottom right, #810CA8, #CB1C8D);width: 51.8%;"><i class="icon fa fa-check"></i>You have registered successfully</h4>
</div>';
#header("location: /PHP_WORK/CompleteWeb/GlassLoginform/logandreg.php");
#exit();
} else {
echo "Error: " . $sql . "" . mysqli_error($conn);
}
}
mysqli_close($conn);
}


/*
#$emaisess = $_SESSION['email'];
 $rows = "select * from `user_login_tbl` where email='$Email' ";

 $res = mysqli_query($conn,$rows);

if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);

    if($Email==isset($row['Email']))
    {
$_SESSION['fail']=0;

         }
  }
    else{

      $sql = "INSERT INTO `user_login_tbl` (`UserName`, `Email`, `Password`, `Cpassword`) VALUES ('$UserName', '$Email', '$Password', '$hashpassword')";

      if(mysqli_query($conn,$sql)){

        #header("Location: /PHP_WORK/CompleteWeb/GlassLoginform/index.php");
        echo '<div class="alert alert-success alert-dismissable" id="flash-msg">
      <h4 style="color:#439A97;background-image: linear-gradient(to bottom right, #810CA8, #CB1C8D);width: 51.8%;"><i class="icon fa fa-check"></i>You have registered successfully</h4>
      </div>';

      }else{
         echo "ERROR: Could not able to execute $sql.". mysqli_error($conn);

         }
    }
#if(empty($_POST['email'])){
} */

if(isset($_POST['SUBMITsIN'])){

  $UserName = mysqli_real_escape_string($conn, $_POST['user']);
  $Password = mysqli_real_escape_string($conn, $_POST['password']);


  $rowss = "select * from `user_login_tbl` where `UserName`='$UserName' and `Password`='$Password' ";

  $result = mysqli_query($conn,$rowss);

  $numrows = mysqli_num_rows($result);

  if($numrows > 0){
      $resul = mysqli_fetch_assoc($result);

    $_SESSION['UserID']=$resul['UserID'];
    header("Location: /PHP_WORK/CompleteWeb/GlassLoginform/index.php");
  }else{
    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg1">
  <h4 style="color:#CB1C8D;"><i class="icon fa fa-check"></i>Entered username and password was invalid plz enter valid credentials</h4>
  </div>';
  }
#){

    #header("Location: /PHP_WORK/CompleteWeb/GlassLoginform/index.php");

  #}else{
   #echo "ERROR: Could not able to execute $rowss.". mysqli_error($conn);

#  }
}

?>



<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<title>Sign In & SignUp Form</title>


<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;

}
body, input{
  font-family: 'Poppins', sans-serif;
}
.container{
  position: relative;
  width: 100%;
  min-height: 100vh;
  background-color: #fff;
  overflow: hidden;
}
.container:before{
  content: '';
  position: absolute;
  width: 2000px;
  height: 2000px;
  border-radius: 50%;
  background: linear-gradient(-45deg, #F72585, #B5179E, #7209B7, #4361EE); /*#4481eb, #04befe */
  top: -10%;
  right: 48%;
  transform: translateY(-50%);
  z-index: 6;
  transition: 1.8s ease-in-out;
}

.forms-container{
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.signin-signup{
  position: absolute;
  top: 50%;
  left: 75%;
  transform: translate(-50%, -50%);
  width: 50%;
  display: grid;
  grid-template-columns: 1fr;
  z-index: 5;
  transition: 1s 0.7s ease-in-out;
}

form{
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0 5rem;
  overflow: hidden;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
  transition: 0.2s 0.7s ease-in-out;
}

form.sign-in-form{
  z-index: 2;
}
form.sign-up-form{
  z-index: 1;
  opacity: 0;
}

.title{
  font-family: 'Teko',sans-serif;
  font-size: 2.0rem;
  text-align: center;
  text-transform: uppercase;
  color: #F72585;
  margin-bottom: 10px;
}
.title:hover{
  letter-spacing: 1px;
  background: linear-gradient(-45deg, #F72585, #B5179E, #7209B7, #4361EE);
    border-radius: 30px;
    padding: 0px 25px;
    color: #fff;
}
.input-field{
  max-width: 380px;
  width: 100%;
  height: 55px;
  background-color: #f0f0f0;
  margin: 10px 0;
  border-radius: 55px;
  display: grid;
  grid-template-columns: 15% 85%;
  padding: 0 0.4rem;
}
.input-field i{
  text-align: center;
  line-height: 55px;
  color: #acacac;
  font-size: 1.1rem;
}
.input-field input{
  background: none;
  outline: none;
  border: none;
  line-height: 1;
  font-weight: 600;
  font-size: 1.1rem;
  color: #333;
}
.input-field input::placeholder{
  color: #aaa;
  font-weight: 500;
}
.btn{
  width: 150px;
  height: 49px;
  border: none;
  outline: none;
  border-radius: 49px;
  cursor: pointer;
  background-color: #F72585;   /*#5995fd; #149bcc(blue) */
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  margin: 10px 0;
  transition: 0.5s;
}
.btn:hover{
  /* background-color: #075270; #4d84e2;*/
  background: linear-gradient(-45deg, #F72585, #B5179E, #7209B7, #4361EE);
}
.social-text{
  padding: 0.7rem 0;
  font-size: 1rem;
}

.social-media{
  display: flex;
  justify-content: center;
}
.social-icon{
  height: 46px;
  width: 46px;
  border: 1px solid #333;
  margin: 0 0.45rem;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  color: #333;
  font-size: 1.1rem;
  border-radius: 50%;
  transition: 0.3s;
}
.social-icon:hover{
  color: #F72585;
  border-color: #F72585;
  background: linear-gradient(-45deg, #F72585, #B5179E, #7209B7, #4361EE);
}
.panels-container{
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}
.panel{
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: space-around;
  text-align: center;
  z-index: 7;
}
.left-panel{
  pointer-events: all;
  padding: 3rem 17% 2rem 12%;
}
.right-panel{
  pointer-events: none;
  padding: 3rem 12% 2rem 17%;
}

.panel .content{
  color: #fff;
  transition: 0.9s 0.6s ease-in-out;
}
.panel h3{
  font-weight: 600;
  line-height: 1;
  font-size: 1.5rem;
}
.panel p{
  font-size: 0.95rem;
  padding: 0.7rem 0;
}
.btn.transparent{
  margin: 0;
  background: none;
  border: 2px solid #fff;
  width: 130px;
  height: 41px;
  font-weight: 600;
  font-size: 0.8rem;
}

.image{
  width: 100%;
  transition: 1.1s 0.4s ease-in-out;
}

.right-panel .content, .right-panel .image{
  transform: translateX(800px);
}

/* ANIMATION  */
.container.sign-up-mode:before{
  transform: translate(100%, -50%);
  right: 52%;
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content{
  transform: translate(-800px);
}
.container.sign-up-mode .right-panel .content,
.container.sign-up-mode .right-panel .image{
  transform: translateX(0px);
}

.container.sign-up-mode .left-panel{
  pointer-events: none;
}
.container.sign-up-mode .right-panel{
  pointer-events: all;
}

.container.sign-up-mode .signin-signup{
  left: 25%;
}

.container.sign-up-mode form.sign-in-form{
  z-index: 1;
  opacity: 0;
}
.container.sign-up-mode form.sign-up-form{
  z-index: 2;
  opacity: 1;
}

/* ------ Media Query for 870------- */

@media (max-width: 870px){
 .container{
   min-height: 800px;
   height: 100vh;
 }
 .container:before{
   width: 1500px;
   left: 1500px;
   left: 30%;
   bottom: 68%;
   transform: translateX(-50%);
   right: initial;
   top: initial;
   transition: 2s ease-in-out;

 }
 .signin-signup{
   width: 100%;
   left: 50%;
   top: 95%;
   transform: translate(-50%, -100%);
   transition: 1s 0.8s ease-in-out;
 }

 .panels-container{
   grid-template-columns: 1fr;
   grid-template-rows: 1fr 2fr 1fr;
 }
  .panel{
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    padding: 2.5rem 8%;
  }

  .panel .content{
    padding-right: 15%;
    transition: 0.9s 0.8s ease-in-out;
  }
  .panel h3{
    font-size: 1.2rem;
  }
  .panel p{
    font-size: 0.7rem;
    padding: 0.5rem 0;
  }

  .btn.transparent{
    width: 110px;
    height: 35px;
    font-size: 0.7rem;
  }

  .image{
    width: 200px;
    transition: 0.9s 0.6s ease-in-out;
  }

  .left-panel{
    grid-row: 1 / 2;
  }

  .right-panel{
    grid-row: 3 / 4;
  }

 .right-panel .content, .right-panel .image{
   transform: translateY(300px);
 }

.container.sign-up-mode:before{
  transform: translate(-50%, 100%);
  bottom: 32%;
  right: initial;
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content{
  transform: translateY(-300);
}

.container.sign-up-mode .signin-signup{
  top: 5%;
  transform: translate(-50%, 0);
  left: 50%;
}

}

/* ------ Media Query for 570------- */


@media (max-width: 570px){
form{
  padding: 0 1.5rem;
}
.image{
  display: none;
}
.panel .content{
  padding: 0.5rem 1rem;
}
.container:before{
  bottom: 72%;
  left: 50%;

}
.container.sign-up-mode:before{
  bottom: 28%;
  left: 50%;
}

}

.text-danger{
  color: #CB1C8D;

}

</style>


</head>
<body>

<div class="container">
  <div class="forms-container">
    <div class="signin-signup">

    <!--Sign In Form-->

<?php
if(isset($_SESSION['fail']))
{
  echo '<div class="alert alert-danger alert-dismissable" id="flash-msg22">
<h4 style="color:#CB1C8D;><i class="icon fa fa-check"></i>Email address is already exists!</h4>
</div>';
}

unset($_SESSION['fail']);

?>
<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
<span class="text-danger"><?php if (isset($mobile_error)) echo $mobile_error; ?></span>
<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
      <form action="logandreg.php" class="sign-in-form" method="POST" enctype="multipart/form-data">

        <h2 class="title">Sign In</h2>
        <?php echo '' ?>
       <div class="input-field">
         <i class="fas fa-user"></i>
         <input type="text"  name="user" placeholder="UserName" >
       </div>
       <div class="input-field">
         <i class="fas fa-lock"></i>
         <input type="password" name="password" placeholder="Password">
       </div>
       <div class="text-end">
       <a href="forgotPassword.php" class='btn m-1 text-primary' style="background:transparent;color:#7F167F;font-size:12px;text-decoration:none;">Forgot Password ?</a>
       </div>
       <input type="submit" name="SUBMITsIN" value="login" class="btn solid">

       <p class="social-text">Or Sign in with social platforms</p>
       <div class="social-media">
         <a href="#" class="social-icon">
           <i class="fab fa-facebook-f"></i>
         </a>
         <a href="#" class="social-icon">
           <i class="fab fa-twitter"></i>
         </a>
         <a href="#" class="social-icon">
           <i class="fab fa-google"></i>
         </a>
         <a href="#" class="social-icon">
           <i class="fab fa-linkedin-in"></i>
         </a>
       </div>
     </form>

    <!--Sign Up Form-->

     <form action="logandreg.php" class="sign-up-form" method="POST" enctype="multipart/form-data">
       <h2 class="title">Sign Up</h2>
      <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" name="user" placeholder="UserName">

      </div>
      <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" placeholder="Email">

      </div>
      <div class="input-field">
        <i class="fas fa-mobile"></i>
        <input type="tel" name="mobile" placeholder="Phone number" minLength="10" maxLength="10" pattern="[7-9]{1}[0-9]{9}">
      </div>
      <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password">

      </div>
      <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" name="cpassword" placeholder="Confirm password">

      </div>
      <input type="submit" name="SUBMITsUP"  value="Sign Up" class="btn solid">

      <p class="social-text">Or Sign up with social platforms<br/>*Ph.no starting with 9/8/7 and other 9 digit using any number</p>
      <div class="social-media">
        <a href="#" class="social-icon">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="social-icon">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="social-icon">
          <i class="fab fa-google"></i>
        </a>
        <a href="#" class="social-icon">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
    </form>

  </div>
  </div>

 <div class="panels-container">
 <div class="panel left-panel">
   <div class="content">
     <h3>New here ?</h3>
     <p>The pain itself is the main reason to love the customer. Does it prevent some people from doing so?</p>
     <button class="btn transparent" id="sign-up-btn">Sign up</button>
   </div>

   <img src="ImgLR/World_1.svg" class="image" alt="">
 </div>

 <div class="panel right-panel">
   <div class="content">
     <h3>One of us ?</h3>
     <p>The pain itself is the main reason to love the customer. Does it prevent some people from doing so?</p>
     <button class="btn transparent" id="sign-in-btn">Sign in</button>
   </div>

   <img src="ImgLR/Developer_activity1.svg" class="image" alt="">
 </div>
</div>
</div>

<script src="GJS/app.js"></script>
<script>

$(document).ready(function () {
    $("#flash-msg").delay(3000).fadeOut("slow");
});

$(document).ready(function () {
    $("#flash-msg1").delay(3000).fadeOut("slow");
});

$(document).ready(function () {
    $("#flash-msg22").delay(3000).fadeOut("slow");
});

$(document).ready(function () {
    $(".text-danger").delay(3000).fadeOut("slow");
});

</script>



</body>
<?Php
?>
