


<?php
// define variables and set to empty values
$nameErr = $collegeErr = $dateOfWorkshopErr = $collegeWhereErr = $contactErr = $emailErr  =  $rateErr = "";
$name = $college  = $dateOfWorkshop = $collegeWhere = $contact = $email =  $comment = $rate = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $flag = 1;
  if (empty($_POST["name"])) {
    $nameErr = "<br><br>Name is required";
       $flag = 0;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "<br><br>Only letters and white space allowed";
      $flag = 0;
    }

  }

  if (empty($_POST["college"])) {
    $collegeErr = "<br><br>College is required";
    $flag = 0;
  } else {
    $college = test_input($_POST["college"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$college)) {
      $collegeErr = "<br><br>Only letters and white space allowed";
      $flag = 0;
    }

  }

  if (empty($_POST["dateOfWorkshop"])) {
    $dateOfWorkshopErr = "<br><br>Date Of Workshop is required";
    $flag = 0;
  } else {
    $dateOfWorkshop = test_input($_POST["dateOfWorkshop"]);
    // check if name only contains letters and whitespace
  }

  if (empty($_POST["collegeWhere"])) {
    $collegeWhereErr = "<br><br>College Where Workshop Was Conducted is required";
    $flag = 0;
  } else {
    $collegeWhere = test_input($_POST["collegeWhere"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$collegeWhere)) {
      $collegeWhereErr = "<br><br>Only letters and white space allowed";
      $flag = 0;
    }

  }

  if (empty($_POST["contact"])) {
    $contactErr = "<br><br>Contact Number is required";
    $flag = 0;
  } else {
    $contact = test_input($_POST["contact"]);

  }

  if (empty($_POST["email"])) {
    $emailErr = "<br><br>Email is required";
    $flag = 0;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "<br><br>Invalid email format";
      $flag = 0;
    }

  }


  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["rate"])) {
    $rateErr = "<br><br>Rating is required";
    $flag = 0;
  } else {
    $rate = test_input($_POST["rate"]);
  }
  if($flag==1){
    $to = "harsh@elan.org.in";
    $subject = "HTML email";

    $message = "
    <html>
    <head>
    <title>Elan Workshop Feedback Form</title>
    </head>
    <body>
    <p>Elan Workshop Feedback Form</p>
    <table>
    <tr>
    <th><strong>Name</strong></th>
    <th>$name</th>
    </tr>

    <tr>
    <th><strong>College</strong></th>
    <th>$college</th>
    </tr>

    <tr>
    <th><strong>Date Of Workshop(dd-mm-yyyy)</strong></th>
    <th>$dateOfWorkshop</th>
    </tr>

    <tr>
    <th><strong>College Where Workshop Was Conducted</strong></th>
    <th>$collegeWhere</th>
    </tr>

    <tr>
    <th><strong>Contact Number</strong></th>
    <th>$contact</th>
    </tr>

    <tr>
    <th><strong>Topic</strong></th>
    <th>Azure Skynet Workshop </th>
    </tr>

    <tr>
    <th><strong>Email</strong></th>
    <th>$email</th>
    </tr>


    <tr>
    <th><strong>Comment</strong></th>
    <th>$comment</th>
    </tr>

    <tr>
    <th><strong>Rate</strong></th>
    <th>$rate</th>
    </tr>

    </table>
    </body>
    </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <harsh@elan.org.in>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";
    $answer="";
    if (mail($to,$subject,$message,$headers))
    $answer =  '<div class="alert alert-warning">
      <strong>
      Thank You For Your Valuable Feedback.
      </strong>
    </div>';
    else
    $answer = '<div class="alert alert-danger">
      <strong>
      Some Error Occured While Sending Feedback.
      </strong>
    </div>';

  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<link rel='shortcut icon' href='assets/img/elan.jpg' type='image/x-icon'/ >
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/css/jquery-ui.css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="assets/css/feedback.css">

<title>Feedback Azure Skyne</title>
</head>
<body style="background-image: url('assets/img/feedback_bg.jpg');">


<div class="container container-table">
  <div class="row vertical-center-row">
    <div class="text-center col-md-5 col-md-offset-3">
      <h2>AZURE SKYNET WORKSHOP FEEDBACK FORM</h2>
      <hr>
      <p><span class="error"></span></p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-inline">

        <fieldset div="container-fluid">
          <div class="row">
            <label class="control-label col-sm-2" for="usr">Name:</label>
            <input type="text" class="col-sm-9" id="usr" name="name" value="<?php echo $name;?>" required>
            <span class="error"> <?php echo $nameErr;?></span>
          </div>
        </fieldset>


        <br><br>

        <fieldset div="container-fluid">
          <div class="row">
            <label class="control-label col-sm-2" for="usr">College:</label>
            <input type="text" class="col-sm-9" id="usr" name="college" value="<?php echo $college;?>" required>
            <span class="error"> <?php echo $collegeErr;?></span>
          </div>
        </fieldset>


        <br><br>

        <fieldset div="container-fluid">
          <div class="row">
            <label class="control-label col-sm-4" for="usr">Date Of Workshop:</label>
            <input type="text" class="col-sm-7" id="datepicker" name="dateOfWorkshop" value="<?php echo $dateOfWorkshop;?>" required>
            <span class="error" > <?php echo $dateOfWorkshopErr;?></span>
          </div>
        </fieldset>


         <br><br>

         <fieldset div="container-fluid">
           <div class="row">
             <label class="control-label col-sm-5" for="usr">College Where Workshop Was Conducted:</label>
             <input type="text" class="col-sm-6" id="usr" name="collegeWhere" value="<?php echo $collegeWhere;?>" required>
             <span class="error" > <?php echo $collegeWhereErr;?></span>
           </div>
         </fieldset>



        <br>

        <fieldset div="container-fluid">
          <div class="row">
            <label class="control-label col-sm-3" for="usr">Contact No.:</label>
            <input type="number" class="col-sm-8" id="usr" name="contact" value="<?php echo $contact;?>" required>
            <span class="error"> <?php echo $contactErr;?></span>
          </div>
        </fieldset>

      <br><br>


      <fieldset div="container-fluid">
        <div class="row">
          <label class="control-label col-sm-2" for="usr">&nbsp;E-mail:</label>
          <input type="email" class="col-sm-8" id="usr" name="email" value="<?php echo $email;?>" required>
          <span class="error"> <?php echo $emailErr;?></span>
        </div>
      </fieldset>




        <br><br>

        <fieldset div="container-fluid">
          <div class="row">
            <label class="control-label col-sm-3" for="comment">Comments : </label>
            <textarea class="col-sm-8" rows="4" id="comment" name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
          </div>
        </fieldset>



         <br><br>

         <fieldset div="container-fluid">
           <label class="control-label col-sm-4" for="sel1">Rate Out Of 10: </label>

           <div class="row select_style">
             <select class="col-sm-7" id="sel1" name="rate" >
               <option value="10">10</option>
               <option value="9">9</option>
               <option value="8">8</option>
               <option value="7">7</option>
               <option value="6">6</option>
               <option value="5">5</option>
               <option value="4">4</option>
               <option value="3">3</option>
               <option value="2">2</option>
               <option value="1">1</option>
             </select>
            </div>
         </fieldset>

          <div class="container">
            <div class="row">
              <div class="col-sm-1"></div>
              <input type="submit" name="submit" value="Submit" class="btn red col-sm-3">
            </div>
          </div>

      </form>
      <br><br>



          <?php
        echo $answer;
        ?>



     </div>
  </div>
</div>


</body>
<script type="text/javascript" src="assets/js/jquery.1.8.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui.js">  </script>

<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  $("select").val("<?php echo $rate;?>").change();;


</script>
</html>
