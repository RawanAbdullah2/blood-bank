<?php
session_start();
error_reporting(0);

$url='localhost';
    $username='root';
    $password='';
    $conn=mysqli_connect($url,$username,$password,"blood_donation");
    if(!$conn){
        die('Could not Connect My Sql:' .mysql_error());
    }
$user_name= $_SESSION["name"];

$massegeM="";


if(isset($_POST['SubimtM']))
{
    $nameM=$_POST["nameM"];
    $emailM=$_POST["emailM"];
    $massegeM = $_POST["massegeM"];
    $query="INSERT INTO massege(name_massege, email_massege,massege_contact) VALUES ('$nameM', '$emailM', '$massegeM')";
       if(mysqli_query($conn,$query)){
       $massegeM="Thank you, your message has reached the responsible party";
    }
       else{ $massegeM="Error:Please Try Again!!";
       }
    
}


if( isset($_POST['submitd1']))
{
    $user_phone= $_SESSION["nameoremal"];
    $blood_Type= $_SESSION["bloodType"];
    $hospital=$_POST['hospital'];    
    $nid=$_POST['nid'];
    $weight=$_POST['weight'];
    $allergies=$_POST['allergies'];
    $healthy=$_POST['healthy'];
    $BloodCategory=$_POST['BloodCategory'];
    $unit=$_POST['unit'];
    $lastdonation=$_POST['lastdonation1'];

    function Calculator($dob){
        if(!empty($dob)){
            $birthdate = new DateTime($dob);
            $today   = new DateTime('today');
            $age = $birthdate->diff($today)->d;
            return $age;
        }else{
            return 0;
        }
    }
    
    function Calculator1($dob1){
        if(!empty($dob1)){
            $birthdate1 = new DateTime($dob1);
            $today1   = new DateTime('today');
            $age1 = $birthdate1->diff($today1)->m;
            $age2 = $age1 * 30;
            return $age2;
        }else{
            return 0;
        }
    }
    function Calculator2($dob2){
        if(!empty($dob2)){
            $birthdate2 = new DateTime($dob2);
            $today2   = new DateTime('today');
            $age2 = $birthdate2->diff($today2)->y;
            return $age2;
        }else{
            return 0;
        }
    } 
    $dob2 = $lastdonation;
    $a2 = Calculator2($dob2);
    $dob = $lastdonation;
    $a = Calculator($dob);
    $dob1 = $lastdonation;
    $a1 = Calculator1($dob1);
    $sum = $a1 + $a;

    if ($sum > 90 || $sum == 90 && $a2 >=0 )
    {
        if ($weight >= 50){
        $query1="INSERT INTO donationu(NID,hospital_name,blood_cetegory,units,weightuser,allergies,healthy ,last_donation,user_number,blood_type)
        VALUES('$nid', '$hospital','$BloodCategory','$unit','$weight', '$allergies', '$healthy', '$lastdonation','$user_phone','$blood_Type')";
          
    if(mysqli_query($conn,$query1)){
            
    $query2="INSERT INTO $hospital (NID,Blood_category,blood_type,units,weightuser,allergies,healthy ,last_donation,user_number)
    VALUES ('$nid','$BloodCategory','$blood_Type','$unit', '$weight','$allergies', '$healthy', '$lastdonation','$user_phone')";
        if(mysqli_query($conn,$query2))
             { $massegeM="Your information sent to hospital ,we will contact with you soon.";}
    }
}

        else
            {$massegeM=" You can't donate, your weight should be 50 or more .";}
    }
    else
        {$massegeM=" You can't donate, you must complete 3 months from the last date you donates";}
}
   


if( isset($_POST['submitr']))
{
    $user_phone= $_SESSION["nameoremal"];
    $bloodType=$_POST['bloodType'];    
    $BloodCategory=$_POST['BloodCategory'];    
    $unit=$_POST['unit'];    
    $hospital=$_POST['hospital'];

   $query9="INSERT INTO request_users(user_number,hospital_Name,Blood_category,blood_type,units)
        VALUES('$user_phone',' $hospital','$BloodCategory','$bloodType','$unit')";
            if(mysqli_query($conn,$query9)){
            $massegeM="Your Request sent to responsible party ,we will contact with you soon.";}

            else{ $massegeM="Error:Please Try Again!!";}
}
                




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/232636cefb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="mystyle2.css" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js " integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI " crossorigin="anonymous "></script>

    <link rel="stylesheet" href="about.css">
    <link rel="styleSheet" href="main1.css">
    <link rel="styleSheet" href="home2.css">
    <link rel="styleSheet" href="home1.css">




    <title> Blood Bank</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-white navbar-warrner ">
        <a class="navbar-brand" href="home.php"><img src="logo.PNG " style="width: 200px; height: 90px;" /></a>
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="about_us.html">About Us</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="donation.php">Donation Benefits</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 160px; margin-left: 170px;background-color:white;color:black;border-radius:5px;font-weight:900">
                  <?php
                 echo $user_name;
                  ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item"  href="logout.php" style="background-color:white;color:black;">

                        <i class="fas fa-sign-out-alt"></i>Log Out</a>
                </div>
            </li>

        </ul>
    </nav>
    <?php 
if ($massegeM ==""){

}
else{
echo ' <div  style=" z-index:10000;position:absolute; top:20px; left:580px;color:black; background-color:red;
  width:450px; height:100px; padding:10px; border-radius:10px; text-align:center;font-size:22px;padding-top:10px;"> ', $massegeM ,'</div> ';}?>

    <div class="history">
        <p class="data">
            History:
        </p>

<?php
    $user_phone=  $_SESSION["phone"];


    $result = mysqli_query($conn,"SELECT last_donation,units,blood_type FROM donationu WHERE user_number='$user_phone'");

    $result1 = mysqli_query($conn,"SELECT units,Blood_category,blood_type FROM request_users WHERE user_number='$user_phone'");

    while($row = mysqli_fetch_assoc($result )){
    while( $row1 = mysqli_fetch_assoc($result1)){

        echo '<div class="data"> Donate:'.$row['last_donation']  .' ~~>  '. $row['units']  . '(' .  $row['blood_type'] .') </div>';

        echo '<div class="data">Take:'.$row1['Blood_category']  .'  ('. $row1['blood_type'] .') ~~> '. $row1['units']  .'</div>';

    }



}

   

?>



    </div>
    <hr class="h" />
    <div>
        <form>
            <input class="sub" style="top: 239px;" type="button" value="New Donation" onclick="OpenFormDonation()"> <br/>
            <input class="sub" style="top: 319px;" type="button" value="New Request" onclick="OpenFormRequest()"> <br/>
        </form>
    </div>

    <div id="Donationi" class="Donation">
        <span class="CloseForm " onclick="CloseDonation()" title="Close overlay">&#215</span>
        <div>
            <div class="div1">
                <form method="post" enctype="multipart/form-data">
                    <label class="sign"> New Donation </label> <br/>
        

                    <input class="in , fam" style="top: 112px;" type="text" name="nid" placeholder="Jordanian national ID"> <br/>
                    <input class="in , fam" style="top: 172px; " type="text" name="weight" placeholder="Weight"> <br/>
                    <input class="in , fam" style="top: 232px;" type="text" name="allergies" placeholder="Allergies"> <br/>
                    <input class="in , fam" style="top: 292px;" type="text" name="healthy" placeholder="Healthy (Infectious diseases)"> <br/>
                    <select class="in , fam" style="top: 352px;" name="hospital">
                        <option value="" selected disabled>Hospital</option>
                        <option value="aljazeera"> aljazeera</option>
                        <option value="elmadena_eltbiah">elmadena_eltbiah</option>  
                        <option value="elbasher">elbasher</option>                     
                   
                    </select> <br/>
                    <select class="in , fam" style="top: 412px;" name="BloodCategory">
                        <option value=""selected disabled>Blood Unit Category</option>
                        <option value="Whole blood"> Whole blood</option>
                        <option value="Platelets" > Platelets </option>  
                        <option value="Plasma" > Plasma</option>                     
                   
                    </select> <br/>
                    <input placeholder="the last time you donated" name="lastdonation1" style="top: 532px;" class="textbox-n , in , fam" type="text" onfocus="(this.type = 'date')" id="date"> <br/>

                    <input class="in , fam" style="top: 472px;" type="text" name="unit" placeholder="Units"> <br/>
                    <input class="margin1 , butn" type="submit" name="submitd1" value="CONFRIM"onclick="" > <br/>

                </form>

            </div>

        </div>
    </div>



    <div id="requesti" class="Request">
        <span class="CloseForm " onclick="CloseRequest()" title="Close overlay">&#215</span>
        <div>
            <div class="div1">
                <form method="post" enctype="multipart/form-data">
                    <label class="sign"> New Request </label> <br/>

                    <select class="in , fam" style="top: 112px;" name="bloodType">
                    <option value="" selected disabled>Blood Type</option>
                    <option  value="AB+"> AB+ </option>
                    <option  value="AB-" > AB- </option>
                    <option  value="A+" > A+ </option>
                    <option  value="A-"> A- </option>
                    <option  value="B+" > B+ </option>
                    <option  value="B-"> B- </option>
                    <option  value="O+" > O+ </option>
                    <option  value="O-"> O- </option>                    
                </select> <br/>
                    <select class="in , fam" style="top: 292px;" name="BloodCategory">
                    <option value=""selected disabled>Blood Unit Category</option>
                    <option value="Whole blood" > Whole blood</option>
                    <option  value="Platelets"> Platelets </option>  
                    <option value="Plasma"> Plasma</option>                     
               
                </select> <br/>
                    <input class="in , fam" style="top: 172px;" type="text" name="unit" placeholder="Units"> <br/>
                    <select class="in , fam" style="top: 232px;" name="hospital">
                        <option value=""selected disabled>Hospital</option>
                        <option value="aljazeera"> aljazeera</option>
                        <option value="elmadena_eltbiah">elmadena_eltbiah</option>  
                        <option value="elbasher">elbasher</option>                    
                   
                    </select>
                    <input class="margin1 , butn" type="submit" name="submitr" value="CONFRIM" onclick=""> <br/>

                </form>

            </div>

        </div>
    </div>

    <p class="p">
        <img src="Group.png" width="" height="" />
    </p>
    <p class="tit1">
        How often can you donate ?
    </p>

    <div id="img" class="carousel slide m-auto" data-ride="carousel" style="width: 450px; top: 400px; left:406px">
        <ol class="carousel-indicators">
            <li data-target="#img" data-slide-to="0" class="active"></li>
            <li data-target="#img" data-slide-to="1"></li>
            <li data-target="#img" data-slide-to="2"></li>
            <li data-target="#img" data-slide-to="3"></li>
            <li data-target="#img" data-slide-to="4"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block w-100" src="1.jpg" height="300px">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="2.png" height="300px">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="3.png" height="300px">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="4.png" height="300px">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="5.jpg" height="300px">
            </div>
            <a class="carousel-control-prev" href="#img" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#img" role="button" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">next</span>
            </a>
        </div>
    </div>

    <p class="howdona">
        Whole blood: This can be donated after every 56 days or 08 weeks.<br/> Platelets: Platelets can be donated every 7 days and up to 24 times in a year. <br/> Plasma: Every 28 days and up to 13 times in a year. <br/> Double Red Cells: These can be
        donated every 112 days or up to 3 times every year. <br/>
    </p>
    <div>
        <p class="border1">
            <img src="massege.png" width="500" height="600" />
        </p>


        <h1 class="ti">Feel Free to Send Us a massege</h1>
        <form class="massgeform" method="post" enctype="multipart/form-data">
            <label>Name:</label> <br>
            <input type="text" name="nameM" placeholder="Your Name"><br>

            <label>Email:</label> <br>
            <input type="email" name="emailM" placeholder="someone@example.com"><br>

            <label>Massege:</label> <br>
            <textarea name="massegeM" rows="6" cols="50" placeholder="Type your opinion heres"></textarea> <br>
            <input class="btnmas" type="submit"  name="SubimtM"value="S E N D" > 
        </form>


    </div>


    <footer class="footer1 d-flex flex-column">
        <img src="logo.PNG" style="width: 220px; height: 100px;" />
        <p>You are someone's Hero</p>
        <img src="social.png" />
        <hr class="hh" />
        <span>Copy Right 2020 © All Rights Reserved</span>
    </footer>



    <script>
        function OpenFormDonation() {
            document.getElementById("Donationi").style.display = "block";
        }
    </script>
    <script>
        function CloseDonation() {
            document.getElementById("Donationi").style.display = "none";
        }
    </script>
    <script>
        function OpenFormRequest() {
            document.getElementById("requesti").style.display = "block";
        }
    </script>
    <script>
        function CloseRequest() {
            document.getElementById("requesti").style.display = "none";
        }
    </script>

</body>

</html>