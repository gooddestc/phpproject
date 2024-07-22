<?php

require_once("controller/controller.php");

$call->checkUserLoggedIn();


if(isset($_POST['submit']) && !empty($_POST['submit'])) {

 $firstName =  $_POST["firstname"];
$middleName = $_POST["middlename"];
$lastName =  $_POST["lastname"];
$userName = $_POST["username"];
$gender =   strtolower($_POST["gender"]);
$occupation =   $_POST["occupation"];
 $country =  $_POST["country"];

 if (!empty($firstName)  && !empty($middleName) && !empty($lastName) && !empty($userName) && !empty($gender) && !empty($occupation) && !empty($country) ){
    $mesg =  $call->ProfileEdit($firstName,$middleName,$lastName,$userName,$gender,$country,$occupation);
 } else {
  $mesg = "All fields are required";
 }

}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css">
    <style>
        form{
            width: 60% !important;
            height: 70% !important;
            margin: 100px auto 200px !important;
            border: 2px solid green !important;
            border-radius: 50px !important;
            box-sizing: border-box !important;
            padding: 50px !important;
            box-shadow: 10px 10px 10px black !important;;
        }
        body {
    display: flex;
    flex-direction: row;
    /* justify-content: space-between; */
}
.type{
    position: relative;
    left: 15%;
    width: 70%;
}

    </style>
</head>
<body>
    <section >
<?php 
require_once("sidebar.php");

?>
<form action="" method="post" class="type row g-3">
<?php if (isset($mesg) && !empty($mesg)) 
    {
      if ($mesg == 1) {
        ?> <p style="color: green ;border: 1px solid green;"><?php echo "success" ?></p>
        <?php 
            } else {
                ?> <p style="color: red ;border: 1px solid red"> <?php echo $mesg;  ?></p> 
                <?php
            }
     } else {
        ?> 
      
         <h2>Update user</h2> 
         <?php
    }?>
    <div class="row g-3">
  <div class="col-12">
    <input type="text" class="form-control" value="<?php echo $call->getUserData('firstname')  ?>" placeholder="First name" aria-label="First name" name="firstname">
  </div>
  <div class="col-12">
    <input type="text" class="form-control" value="<?php echo $call->getUserData('middlename')  ?>" placeholder="middle name" aria-label="middle name" name="middlename">
  </div>
  <div class="col-12">
    <input type="text" class="form-control" value="<?php echo $call->getUserData('lastname')  ?>" placeholder="Last name" aria-label="Last name" name="lastname">
  </div>
  <div class="col-12">
    <input type="text" class="form-control" value="<?php echo $call->getUserData('username')  ?>" placeholder="user name" aria-label="Last name" name="username">
  </div>
  <div class="col-12">
    <input type="text" class="form-control" value="<?php echo $call->getUserData('gender')  ?>" placeholder="gender" aria-label="Last name" name="gender">
  </div>
</div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" value="<?php echo $call->getUserData('email')  ?>" class="form-control" id="inputEmail4" name="email" disabled>
  </div>
  
  <div class="col-12">
    <label for="inputAddress" class="form-label">occupation</label>
    <input type="text" class="form-control" value="<?php echo $call->getUserData('occupation')  ?>" id="inputAddress" placeholder="occupation" name="occupation">
  </div>
  <div class="col-12">
  <label for="inputState" class="form-label">country</label>
    <select id="inputState" class="form-select" name="country">
      <option  selected><?php echo $call->getUserData('country')  ?></option>
      <option >...</option>
    </select>
  </div>
  
  
  
  
 
  <div class="col-12">
    <input type="submit" value="update" class="btn btn-primary w-100" name="submit">
  </div>

</form>
</section>
<script>
        const select = document.getElementById("inputState");
        const countries = [
            "Afghanistan",
"Albania",
"Algeria",
"Andorra",
"Angola",
"Antigua and Barbuda",
"Argentina",
"Armenia",
"Australia",
"Austria",
"Azerbaijan",
"Bahamas",
"Bahrain",
"Bangladesh",
"Barbados",
"Belarus",
"Belgium",
"Belize",
"Benin",
"Bhutan",
"Bolivia",
"Bosnia and Herzegovina",
"Botswana",
"Brazil",
"Brunei",
"Bulgaria",
"Burkina Faso",
"Burundi",
"Côte d'Ivoire (Ivory Coast)",
"Cabo Verde",
"Cambodia",
"Cameroon",
"Canada",
"Central African Republic",
"Chad",
"Chile",
"China",
"Colombia",
"Comoros",
"Congo (Congo-Brazzaville)",
"Costa Rica",
"Croatia",
"Cuba",
"Cyprus",
"Czechia (Czech Republic)",
"Democratic Republic of the Congo (Congo-Kinshasa)",
"Denmark",
"Djibouti",
"Dominica",
"Dominican Republic",
"Ecuador",
"Egypt",
"El Salvador",
"Equatorial Guinea",
"Eritrea",
"Estonia",
"Eswatini",
"Ethiopia",
"Fiji",
"Finland",
"France",
"Gabon",
"Gambia",
"Georgia",
"Germany",
"Ghana",
"Greece",
"Grenada",
"Guatemala",
"Guinea",
"Guinea-Bissau",
"Guyana",
"Haiti",
"Holy See (Vatican City)",
"Honduras",
"Hungary",
"Iceland",
"India",
"Indonesia",
"Iran",
"Iraq",
"Ireland",
"Israel",
"Italy",
"Jamaica",
"Japan",
"Jordan",
"Kazakhstan",
"Kenya",
"Kiribati",
"Kuwait",
"Kyrgyzstan",
"Laos",
"Latvia",
"Lebanon",
"Lesotho",
"Liberia",
"Libya",
"Liechtenstein",
"Lithuania",
"Luxembourg",
"Madagascar",
"Malawi",
"Malaysia",
"Maldives",
"Mali",
"Malta",
"Marshall Islands",
"Mauritania",
"Mauritius",
"Mexico",
"Micronesia",
"Moldova",
"Monaco",
"Mongolia",
"Montenegro",
"Morocco",
"Mozambique",
"Myanmar (Burma)",
"Namibia",
"Nauru",
"Nepal",
"Netherlands",
"New Zealand",
"Nicaragua",
"Niger",
"Nigeria",
"North Macedonia (formerly Macedonia)",
"Norway",
"Oman",
"Pakistan",
"Palau",
"Palestine State",
"Panama",
"Papua New Guinea",
"Paraguay",
"Peru",
"Philippines",
"Poland",
"Portugal",
"Qatar",
"Romania",
"Russia",
"Rwanda",
"Saint Kitts and Nevis",
"Saint Lucia",
"Saint Vincent and the Grenadines",
"Samoa",
"San Marino",
"Sao Tome and Principe",
"Saudi Arabia",
"Senegal",
"Serbia",
"Seychelles",
"Sierra Leone",
"Singapore",
"Slovakia",
"Slovenia",
"Solomon Islands",
"Somalia",
"South Africa",
"South Korea",
"South Sudan",
"Spain",
"Sri Lanka",
"Sudan",
"Suriname",
"Sweden",
"Switzerland",
"Syria",
"Tajikistan",
"Tanzania",
"Thailand",
"Timor-Leste",
"Togo",
"Tonga",
"Trinidad and Tobago",
"Tunisia",
"Turkey",
"Turkmenistan",
"Tuvalu",
"Uganda",
"Ukraine",
"United Arab Emirates",
"United Kingdom",
"United States of America",
"Uruguay",
"Uzbekistan",
"Vanuatu",
"Venezuela",
"Vietnam",
"Yemen",
"Zambia",
"Zimbabwe"

            // Add all countries here
        ];

        countries.forEach(country => {
            const option = document.createElement("option");
            option.value = country;
            option.text = country;
            select.appendChild(option);
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>