<?php
//Message variables
$msg = '';
$msgClass = '';
//Check for form submission
if(filter_has_var(INPUT_POST,'submit')){
    //Get form values
    $fname = ucfirst(trim(htmlspecialchars($_POST['fname'])));
    $lname = ucfirst(trim(htmlspecialchars($_POST['lname'])));
    $email = trim(htmlspecialchars($_POST['email']));
    $message = trim(htmlspecialchars($_POST['message']));

    //Check for empty fields
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($message)){
        //Validate email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === False){
            //Invalid email entered
            $msg = 'Please enter valid email address';
            $msgClass = 'alert-danger';
        }else{
            //Process email
            $toEmail = 'yourmail@email.com';
            $subject = 'Contact form from {$fname} {$lname}';
            $body = '<h2>Contact Message</h2><h4>Name:</h4><p>'.$fname.'" "' .$lname.'</p><h4>Email:</h4><p>'.$email.'</p><h4>Message:</h4><p>'.$message.'</p>';

            //Email headers
            $headers = "MIME-Version: 1.0" ."\r\n";
            $headers .="Content-Type: text/html;charset=UTF-8" ."\r\n";

            //Additional headers
            $headers .="From " .$fname.'" "' .$lname ."<" .$email. ">"."\r\n";

            //Send Email
            if(mail($toEmail, $subject, $body, $headers)){
                $msg = 'Your message has been sent';
                $msgClass = 'alert-success';
            }else{
               $msg = 'Sorry '.$fname.' our servers may be down and message was not sent, Please contact us directly at <a href="mailto:youremail@email.com">youremail@email.com</a>';
                $msgClass = 'alert-danger';
            }
        }

    }else{
        //Error Message
        $msg = 'Please fill in all fields';
        $msgClass = 'alert-danger';
    }
}

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="contact.css">
    </head>

    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 bg-primary p-3 text-center">
                        <h1 class="display-5 text-white">PHP Contact Form</h1>
                    </div>
                </div>
                </container>
        </header>
        <section class="bg-light my-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="contactForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group input-group">
                                <span class="input-group-addon" id="basic-addon3">First Name</span>
                                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="basic-addon3" value="<?php echo isset($_POST['fname'])? $fname : '';?>">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" id="basic-addon3">Last Name</span>
                                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="basic-addon3" value="<?php echo isset($_POST['lname'])? $lname : '';?>">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" id="basic-addon3">Email</span>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="basic-addon3" value="<?php echo isset($_POST['email'])? $email : '';?>">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Your message here..."><?php echo isset($_POST[ 'message'])? $message : '';?></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-outline-primary" name="submit" id="submit">Submit</button>
                            </div>
                            <div class="<?php echo $msgClass;?> p-3">
                                <?php echo $msg;?>
                            </div>
                        </form>
                    </div>
                </div>
                </container>
        </section>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <hr>
                        <p><small class="text-muted">
                        <?php echo "&copy;" .date("Y")." ".$_SERVER['HTTP_HOST']; ?>
                    </small></p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>

    </html>
