<?php
    $mobile = $name = $fname = $roll = $laddress = $paddress = $gender = $email = "";
    require("./assets/day4/php_handler/saveData.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Registration</title>
        <link rel="stylesheet" href="./assets/day4/css/index.css"/>
    </head>
    <body>
        <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="name" placeholder="Student Name" value="<?= $name ?>" required /> <br />
            <input type="text" name="fatherName" placeholder="Father's Name" value="<?php echo $fname?>" required /> <br />
            <input type="text" name="roll" placeholder="Roll No." value="<?php echo $roll?>" required /> <br />
            Postal Address: <br>
            <textarea name="postalAddress" rows="10" cols="50"  required><?php echo $laddress?></textarea> <br>
            Permanent Address: <br>
            <textarea name="permanentAddress" rows="10" cols="50" required ><?php echo $paddress?></textarea><br>
            <input type="text" id="mobile" placeholder="Mobile No." name="mobile" pattern="[0-9]{10}" title="mobile number without country code" value="<?php echo $mobile?>" required/><br>
            Gender: 
            Male <input type="radio" name="gender" value="male" <?php if(isset($gender) && $gender == "male" ) echo "checked"?> required/>
            Female <input type="radio" name="gender" value="female" <?php if(isset($gender) && $gender == "female" ) echo "checked"?> required/><br>
            <input type="email" name="email" placeholder="E - mail" value="<?php echo $email?>" required/><br>
            <input type="reset" class="button" value="Reset"/>
            <input type="submit" class="button" value="Submit" />
            <input type="button" class="button" value="Display" onclick="display()"/>
        </form>
        <script>
            function display() {
                let mobile = document.getElementById("mobile").value;
                let pattern = new RegExp("[^0-9]");
                let res = pattern.test(mobile.toString());
                if (mobile.length != 10 || res) {
                    alert("Invalid mobile number");
                    return;
                }
                let form = document.getElementById("form");
                form.submit();
            }

            function sendAJAX(mobile) {
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                    } 
                };
                xhttp.open("POST", "/index.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(`mobile=${mobile}&display=fetch`);
            }

            function reset() {
                document.getElementById("form").reset();
            }
        </script>
    </body>
</html>