<?php
    $url='localhost';
    $username='root';
    $password='';
    $conn=mysqli_connect($url,$username,$password,"blood_donation");
    if(!$conn){
        die('Could not Connect My Sql:' .mysql_error());
    }
    $massege="";

    
if( isset($_POST['submitSU']))
{

        $phoneNumber=$_POST['phoneNumber'];

        if (strlen($phoneNumber) == '10')
        {
        

                $sql=mysqli_query($conn,"SELECT * FROM users where phone_number='$phoneNumber'");

                if(mysqli_num_rows($sql)>0)
                {
                    $massege=" This Account is Already Exists";
                    
                }
                else
                {
                    session_start();

                    $name=$_POST['name'];
                    $password=$_POST['password'];
                    $bloodType=$_POST['bloodType'];
                    $gender=$_POST['gender'];
                    $age=$_POST['age'];
                    $query="INSERT INTO users(	phone_number, name,password,blood_type, gender,age) VALUES
                    ('$phoneNumber', '$name', 'md5($password)', '  $bloodType', ' $gender','$age')";
                        if(mysqli_query($conn,$query))
                        {
                            $_SESSION["phone"] = $phoneNumber;

                            $_SESSION["name"] = $name;
                            $_SESSION["password"]=$password; 
                            $_SESSION["bloodType"]=$bloodType; 
                            header("Location: mainScreen.php"); 
                        }
                        else
                        { $massege="Error:Please Try Again!!";}
                }

        } 
        else
        {
        $massege=" This Number is not correct";
        }
}



if( isset($_POST['submitSH'])){

    $sql=mysqli_query($conn,"SELECT * FROM pending_hospital ");

        $name_hospital=$_POST['name1'];
        $emailhospital=$_POST['email1'];
        $phone_number=$_POST['phonenumber'];

        $file =$_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $folder="upload/";
        $new_file_name = strtolower($file);
        $final_file=str_replace(' ','-',$new_file_name);
        if(move_uploaded_file($file_loc,$folder.$final_file))
        {
                    
                if (strlen($phone_number) =='10' || strlen($phone_number) == '9' )
                {
                    $query="INSERT INTO pending_hospital(	name_hospital, emailhospital,phone_number,legal_document) VALUES
                    ('$name_hospital', '$emailhospital', '$phone_number', '  $final_file')";
                    if(mysqli_query($conn,$query)){
                         $massege="The request has been delivered and will be considered,Thank you";}
                    else {$massege="A defect occurred in the request and didn't reach the responsible party"; }
                
                }
                else{
                    $massege=" This Number is not correct";}
        }
        else{
             $massege= "Error.Please try again";}
        
}



if(isset($_POST['submitLU']))
{
    session_start();

    extract($_POST);
    $phone=$_POST['nameoremal'];
    $password=$_POST['password1'];
    $sql=mysqli_query($conn,"SELECT * FROM users where phone_number=$phone and password='md5($password)'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["nameoremal"] = $row['phone_number'];
        $_SESSION["password1"]=$row['password']; 
        $_SESSION["name"]=$row['name']; 
        $_SESSION["bloodType"]=$row['blood_type']; 
        header("Location: mainScreen.php"); 
    }
    else
    {
        $massege=  "Invalid Email ID/Password";
    }
}


if(isset($_POST['submitLH']))
{
    session_start();
    $usernameOrEmail=$_POST["nameho"];
    $password1=$_POST["password2"];
    $idhospital = $_POST["hospitalid"];
    $sql=mysqli_query($conn,"SELECT * FROM hospital where ID='$idhospital' and hospital_password='$password1' ");
    $row = mysqli_fetch_array($sql);
    if(is_array($row))
    {
       $_SESSION["nameho"] = $row['name_hospital'];
        $_SESSION["password2"]=$row['hospital_password']; 
        $_SESSION["phonenumber"]=$row['phone_number']; 
        $_SESSION["hospitalid"]=$row['ID']; 
        header("Location:mainScreenDoctor.php"); 
        
    }
    else
    {
        $massege= "Invalid Email ID/Password";
    }
    
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/232636cefb.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="home.css">
        <title> Blood Bank</title>
    </head>
 <body>
<?php 
if ($massege ==""){

}
else{
echo ' <div  style=" z-index:10000;position:absolute; top:20px; left:580px;color:black; background-color:red;
  width:450px; height:100px; padding:10px; border-radius:10px; text-align:center;font-size:22px;padding-top:30px;"> ', $massege ,'</div> ';}?>
          
        <div class="row no-gutters">

            <div class="leftside col-md-6 no-gutters ">
                <img src="logo.PNG" alt=" logoimage" class="logo">
                <p class="hometext">“A single pint can save three &nbsp
                    <span style="--i:1;color: red; ">L</span>
                    <span style="--i:2;color: red; ">I</span>
                    <span style="--i:3; color: red;">V</span>
                    <span style="--i:4; color: red;"> E</span>
                    <span style="--i:5; color: red;"> S</span> ,a single gesture can create a million
                    <span style="--i:1; color: red;">S</span>
                    <span style="--i:2; color: red;">M</span>
                    <span style="--i:3; color: red;">I</span>
                    <span style="--i:4; color: red;"> L</span>
                    <span style="--i:5; color: red;"> E</span>
                    <span style="--i:5; color: red;"> S</span> ”

                </p>
                <button class="loginbtn" onclick="OpenFormLog()">LOGIN</button>
                <p class="account">Don’t have an account ? <a href="#" style="color: #24B8E7;" onclick="openUserSign()">Sign up</a></p>
                <a href="about_us.html"><button class="aboutbtn">About us</button></a>
                <a href="donation.php"> <button class="benefitsbtn">Donation Benefits</button></a>
                <button class="joinbtn" onclick="openHospitalSign()">New Hospital ? Join Us !</button>

            </div>

            <div class="col-md-6 no-gutters rightside">
                <img src="homeimage.jpg" alt=" homeimage" class="homeimage">
            </div>

            <div id="logInWindowi" class="logInWindow">
                <span class="CloseForm " onclick="CloseFormLog()" title="Close overlay">&#215</span>
                <div>
                    <p class="line1"></p>
                    <p class="line2"></p>

                    <div class="div1">
                        <form>
                            <label class="sign"> Login </label> <br/>

                            <input class="margin1 , butn" type="button" value="User" onclick="openUserLogin()"> <br/>
                            <input class="margin1 , butn" style=" top: 266px;" type="button" value="Hospital" onclick="openHospitalLogin()"> <br/>

                        </form>
                    </div>

                </div>

            </div>

            <div id="logInUseri" class="logInUser">
                <span class="CloseForm " onclick="closeUserLogin()" title="Close overlay">&#215</span>
                <div>
                    <p class="line1"></p>
                    <p class="line2"></p>

                    <div class="div1">
                        <form method="post" enctype="multipart/form-data">

                            <label class="sign" style="top:38px;font-size:22px;left:213px ;"> Login User </label> <br/>

                            <input class="in , fam" style="top: 140px;" type="number" name="nameoremal" placeholder="Phone Number"> <br/>
                            <input class="in , fam" style="top: 210px;" type="password" name="password1" placeholder="Password"> <br/>
                            <input class="margin1 , butn" style="top: 314px;"name="submitLU" type="submit" value="CONFRIM" onclick=""> <br/>

                        </form>
                    </div>

                </div>
            </div>

            <div id="logInhospitali" class="logInhospital">
                <span class="CloseForm " onclick="closeHospitalLogin()" title="Close overlay">&#215</span>
                <div>
                    <p class="line1" style="width: 170px;left:490 ;"></p>
                    <p class="line2" style="width: 178px;left: 825;"></p>

                    <div class="div1">
                        <form method="post" enctype="multipart/form-data">

                            <label class="sign" style="top:38px;font-size:22px;left:187px ;"> Login Hospital </label> <br/>
                            <input class="in , fam" style="top: 142px;" type="text" name="nameho" placeholder="Username"> <br/>
                            <input class="in , fam" style="top: 214px;" type="text" name="hospitalid" placeholder="Hospital ID"> <br/>
                            <input class="in , fam" style="top: 286px;" type="password" name="password2" placeholder="Password"> <br/>
                            <input class="margin1 , butn" style="top:370px;" type="submit" name="submitLH" value="CONFRIM" > <br/>

                        </form>
                    </div>

                </div>
            </div>

            <div id="signUpUseri" class="signUpUser">
                <span class="CloseForm " onclick="closeUserSign()" title="Close overlay">&#215</span>
                <div>
                    <p class="line1"></p>
                    <p class="line2"></p>
                    <div class="div1">
                        <form method="post" enctype="multipart/form-data">

                            <label class="sign" style="left:200px ;"> Sign up </label> <br/>
                          
                            <input class="in , fam" style="top: 122px;" type="text" name="name" placeholder="Name"> <br/>
                            <input class="in , fam" style="top: 170px;" type="password" name="password" placeholder="Password"> <br/>
                            <input class="in , fam" style="top: 220px;" type="text" name="phoneNumber" placeholder="Phone Number"> <br/>
                            <select class="in , fam" style="top: 270px;" name="bloodType">
                                <option value="--" selected disabled>Blood Type</option>
                                <option value="AB+"> AB+ </option>
                                <option value="AB-"> AB- </option>
                                <option  value="A+"> A+ </option>
                                <option  value="A-"> A- </option>
                                <option  value="B+"> B+ </option>
                                <option  value="B-"> B- </option>
                                <option  value="O+"> O+ </option>
                                <option  value="O-"> O- </option>                    
                             </select> <br/>
                      
                            <select class="in , fam" style="top: 320px; width: 35%;" name="gender">
                                <option value="--"selected disabled>Gender</option>
                                <option value="Male"> Male </option>
                                <option value="Female"> Female </option>
                            </select>
                            <input class="in , fam" style="top: 320px; left:305px ; width:35%;" type="text" name="age" placeholder="Age"> <br/>
                    <input class="margin1 , butn" style="top:390px;" type="submit"name="submitSU" value="CONFRIM" > <br/>

                        </form>
                    </div>

                </div>
            </div>



            <div id="signUpHospitali" class="signUpHospital">
                <span class="CloseForm " onclick="closeHospitalSign()" title="Close overlay">&#215</span>
                <div>
                    <p class="line1"></p>
                    <p class="line2"></p>

                    <div class="div1">

                        <form method="post" enctype="multipart/form-data">
                            <label class="sign" style="left:200px ;"> Sign up </label> <br/>
                            
                            <input class="in , fam" style="top: 120px;" type="text" name="name1" placeholder="Name"> <br/>
                            <input class="in , fam" style="top: 180px;" type="email" name="email1" placeholder="Email"> <br/>
                            <input class="in , fam" style="top: 240px;" type="text" name="phonenumber" placeholder="Phone Number"> <br/>
                            <label class="la" style="top: 210px;">Legal Document<input type="file" name="file" placeholder="Legal Document"> 
                        <i class="fas fa-folder-plus fa-2x"></i>
                    </label><br/>
                            <input class="margin1 , butn" style="top:380px" type="submit"  name="submitSH"value="CONFRIM" > <br/>
                        </form>
                    </div>

                </div>
            </div>



        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js " integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo " crossorigin="anonymous "></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js " integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI " crossorigin="anonymous "></script>


        <script>
            function OpenFormLog() {
                document.getElementById("logInWindowi").style.display = "block";
            }
        </script>
        <script>
            function CloseFormLog() {
                document.getElementById("logInWindowi").style.display = "none";
            }
        </script>

        <script>
            function openUserLogin() {
                document.getElementById("logInUseri").style.display = "block";
                document.getElementById("logInWindowi").style.display = "none";

            }
        </script>

        <script>
            function closeUserLogin() {
                document.getElementById("logInUseri").style.display = "none";

            }
        </script>

        <script>
            function openHospitalLogin() {
                document.getElementById("logInhospitali").style.display = "block";
                document.getElementById("logInWindowi").style.display = "none";

            }
        </script>
        <script>
            function closeHospitalLogin() {
                document.getElementById("logInhospitali").style.display = "none";

            }
        </script>

        <script>
            function openUserSign() {
                document.getElementById("signUpUseri").style.display = "block";
                document.getElementById("logInWindowi").style.display = "none";

            }
        </script>

        <script>
            function closeUserSign() {
                document.getElementById("signUpUseri").style.display = "none";

            }
        </script>

        <script>
            function openHospitalSign() {
                document.getElementById("signUpHospitali").style.display = "block";
                document.getElementById("logInWindowi").style.display = "none";

            }
        </script>

        <script>
            function closeHospitalSign() {
                document.getElementById("signUpHospitali").style.display = "none";

            }
        </script>


    </body>

    </html>