<html>
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title> Register</title>
    <style>
        body {
            background: linear-gradient(45deg, #EECFBA, #C5DDE8);
        }

        H3 {
            font-size: 140%;
            font-family: Verdana, Georgia, Helvetica, sans-serif;
            color: #20B2AA;
        }

        fieldset {
            border: border: 1rem solid;
            width: 1000px;
            background: linear-gradient(45deg, #EECFBA, #ffff80);
        }

        input[type=submit], input[type=reset] {
            background-color: #20B2AA;
            color: white;
            padding: 4px 16px;
            margin: 4px 2px;
            border: 1px solid #ccc;
            width: 100px;
        }

        input[type=text] {
            border-radius: 4px;
            padding: 12px 20px;
            margin: 4px 0;
            border: 1px solid #ccc;
            width: 250px;
        }

        input[type=password] {
            border-radius: 4px;
            padding: 12px 20px;
            margin: 4px 0;
            border: 1px solid #ccc;
            width: 250px;
        }

        input[type=email] {
            border-radius: 4px;
            padding: 12px 20px;
            margin: 4px 0;
            border: 1px solid #ccc;
            width: 250px;
        }

        .notvalid {
            background: rgba(255, 0, 0, .2);
        }
    </style>
</head>
<body>
<form method="post" id="register_form" action="">
    <center>
        <fieldset style="width:0px">
            <legend><h3>Register</h3></legend>
            <input type="text" name="login" id="login" placeholder="Login"><br>
            <div id="valid_login_message" style="color:indianred"></div>
            <br><input type="email" name="email" id="email" required placeholder="E-mail"><br>
            <div id="valid_email_message" style="color:indianred"></div>

            <br><input type="password" name="pass" required placeholder="Password"><br>
            <br><input type="text" name="firstname" placeholder="Firstname"><br>
            <br><input type="text" name="lastname" placeholder="Lastname"><br>
            <br><input type="text" name="phnumber" placeholder="Phone Number">
            <hr>
            <input type="submit" value="Submit" name="submitButton">
            <input type="reset" value="Reset" name="resetButton"><br>
            <font size="2" color="gray" face="Arial">If you have account. Please click <a
                        href="login">here</a></font>
        </fieldset>
    </center>
</form>
<div id="registerresult_form"></div>
<script src="ajax/ajaxRegister"></script>
</body>
</html>
