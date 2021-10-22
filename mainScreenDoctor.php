<?php
session_start();
$hospital_name=  $_SESSION["nameho"];


$url='localhost';
    $username='root';
    $password='';
    $conn=mysqli_connect($url,$username,$password,"blood_donation");
    if(!$conn){
        die('Could not Connect My Sql:' .mysql_error());
    }
$massegeM="";



if( isset($_POST['submitrh']))
{
    
    $hospital_id=$_SESSION["hospitalid"]; 
    $hospital=$_POST['hospital'];    
    $bloodType=$_POST['bloodType'];    
    $units=$_POST['units'];    
    $BloodCategory=$_POST['BloodCategory']; 
    
   $query7="INSERT INTO request_hospital (hosptal_name,blood_type,units,blood_category,hospital_Id)
        VALUES('$hospital','$bloodType','$units','$BloodCategory','$hospital_id')";
            if(mysqli_query($conn,$query7)){
            $massegeM="Your Request sent to responsible party ,we will contact with you soon.";}
            else{ $massegeM="Error:Please Try Again!!";}

}

if(isset($_POST['SubimtM']))
{
    $nameM=$_POST["nameM"];
    $emailM=$_POST["emailM"];
    $massegeMi = $_POST["massegeM"];
    $query="INSERT INTO massege (name_massege, email_massege,massege_contact) VALUES ('$nameM', '$emailM', '$massegeMi')";
       if(mysqli_query($conn,$query)){
       $massegeM="Thank you, your message has reached the responsible party";
    }
       else{ $massegeM="Error:Please Try Again!!";
       }
    
}

if(isset($_POST['data'])){
if($hospital_name=='aljazeera' ){
    header('Location: http://localhost/phpmyadmin/sql.php?server=1&db=blood_donation&table=aljazeera&pos=0');
}

else if($hospital_name=='elmadena_eltbiah' ){
    header('Location: http://localhost/phpmyadmin/sql.php?server=1&db=blood_donation&table=elmadena_eltbiah&pos=0');

}

else  if($hospital_name=='elbasher' ){
    header('Location: http://localhost/phpmyadmin/sql.php?server=1&db=blood_donation&table=elbasher&pos=0');

}
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/232636cefb.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="about.css">
    <link rel="styleSheet" href="main.css">
    <link rel="stylesheet" href="home3.css">

    <link rel="styleSheet" href="mainScreenDoctor.css">


    <title> Blood Bank</title>

    <style>
        .swiper-container {
            position: absolute;
            width: 100%;
            bottom: 0px;
        }
        
        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 370px;
            height: 553px;
        }
        
        .swiper-pagination {
            position: absolute;
            top: 780px;
            left: 750px;
        }
        
        .swiper-wrapper {
            align-items: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-white navbar-warrner ">
        <a class="navbar-brand" href="home.php"><img src="logo.PNG " style="width: 200px; height: 90px;" /></a>

        </div>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 320px; margin-left: 900px;background-color: #E51B23;;color:white;border-radius:5px">
                    <i class="fas fa-user-cog"></i> Admin <?php
                 echo $hospital_name;
                  ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="logoutH.php">
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


    <p class="line1"></p>
    <p class="latest">Latest Operations</p>
    <p class="line2"></p>



    <div class="swiper-container">
        <div class="swiper-wrapper">
<?php
error_reporting(0);
$name_of_hospital =$hospital_name;
    $result = mysqli_query($conn,"SELECT * FROM $name_of_hospital");

    while($row = mysqli_fetch_assoc($result)){
        

        echo '<div class="swiper-slide">';
        echo ' <div class="sliderInfo">' ;
             echo ' <h1 class="TakeInfo">Donate '.$row['last_donation']  .'</h1>';
             echo ' <p class="numberOfBlood">'. $row['units'].' Blood Bags ( ' . $row['blood_type']. ' )</p>' ;
             echo ' <label>National ID:</label><br>';
             echo ' <div class="formfield">'.$row['NID'] .'</div>';
             echo ' <label>Phone Number:</label><br>';
             echo ' <div class="formfield">'.$row['user_number'] .'</div>';
             echo ' <label>Weight:</label><br>';
             echo ' <div class="formfield">'.$row['weightuser'] .'</div>';
             echo ' <label>Blood Type:</label><br>';
             echo ' <div class="formfield"> '.$row['blood_type'] .'</div>';
             echo ' <label>Units:</label><br>' ;
             echo ' <div class="formfield"> '.$row['units'].'</div>';
             echo ' <label>Hospital:</label><br>';
             echo ' <div class="formfield">'. $name_of_hospital .'</div>';
             echo ' <label>Allergies:</label><br>';
             echo ' <div class="formfield">'.$row['allergies'] .'none</div>';
             echo ' <label>Halth:</label><br>';
             echo ' <div class="formfield">'.$row['healthy'] .'</div>';
             echo ' <label>Blood unit category:</label><br>';
             echo ' <div class="formfield">'.$row['Blood_category'].'</div>';
             echo ' </div>';
             echo '</div>';
        
    }

?>
    
        </div>
    </div>
    <div class="swiper-pagination"></div>


    <button class="mainbtn" onclick=" OpenFormRequest()"> New Request </button>
    <form  method="post" enctype="multipart/form-data">
    <button class="mainbtn" type="submit" name="data" style="left: 906px"> Go to Database</button>;
    </form>



    <div id="Requesti" class="Request">
        <span class="CloseFormRe " onclick="CloseRequest()" title="Close overlay">&#215</span>
        <div>
            <div class="div1">
                <form method="post" enctype="multipart/form-data">
                    <label class="sign"> New Request </label> <br/>
                    <select class="in , fam" style="top: 102px;" name="hospital">
                        <option value=""selected disabled>Hospital</option>
                        <option value="aljazeera"> aljazeera</option>
                        <option value="elmadena_eltbiah">elmadena_eltbiah</option>  
                        <option value="elbasher">elbasher</option>                     
                   
                    </select>

                    <select class="in , fam" style="top: 170px;" name="bloodType">
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
                    <input class="in , fam" style="top: 232px;" type="text" name="units" placeholder="Units"> <br/>
                    <select class="in , fam" style="top: 292px;" name="BloodCategory">
                    <option value=""selected disabled>Blood Unit Category</option>
                    <option value="Whole blood" > Whole blood</option>
                    <option  value="Platelets"> Platelets </option>  
                    <option value="Plasma"> Plasma</option>                     
                   
                    </select> <br/>
                    <input class="margin1 , butn" type="submit" name="submitrh" value="CONFRIM" onclick=""> <br/>

                </form>

            </div>

        </div>

    </div>

    <div>
        <p class="border1">
            <img src="massege.png" width="500" height="600" />
        </p>


        <h1 class="ti">Feel Free to Send Us a massege</h1>
        <form class="massgeform" method="post" enctype="multipart/form-data">
            <label>Name:</label> <br>
            <input type="text"name="nameM" placeholder="Your Name"><br>

            <label>Email:</label> <br>
            <input type="email" name="emailM" placeholder="someone@example.com"><br>

            <label>Massege:</label> <br>
            <textarea  rows="6"name="massegeM" cols="50" placeholder="Type your opinion heres"></textarea> <br>
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


    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js " integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js " integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI " crossorigin="anonymous "></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 10,
                stretch: 1,
                depth: 250,
                modifier: 1,
                slideShadows: true,
            },
            loop: true,
            pagination: {
                el: '.swiper-pagination',
            },
        });
    </script>

    <script>
        function OpenFormRequest() {
            document.getElementById("Requesti").style.display = "block";
        }
    </script>
    <script>
        function CloseRequest() {
            document.getElementById("Requesti").style.display = "none";
        }
    </script>

</body>

</html>