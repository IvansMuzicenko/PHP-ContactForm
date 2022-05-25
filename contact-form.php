<div>
    <h1>Contact us!</h1>
    <?php
        function hasHeaderInjection($str) {
            return preg_match("/[\r\n]/", $str);
        }
        if (isset($_POST["contactSubmit"])) {
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $msg = $_POST['message'] ; 

            if (hasHeaderInjection($name) || hasHeaderInjection($email)) {
                die();
            }

            if (!$name || !$email || !$msg) {
                echo '<h4 style="color: red;">All fields required.</h4> <a href="contact-form.php" class="button block">Try again</a>';
                exit;
            }

            $to = "ivans.muzicenko@gmail.com";

            $subject = "$name sent a message via contact form";

            $message .= "Name: $name \r\n";
            $message .= "Email: $email \r\n\r\n";
            $message .= "Message:\r\n$msg";

            if (isset($_POST['subscribe']) && $_POST['subscribe']) {
                $message .= "\r\n\r\n Please add $email to mail subscribe list. \r\n";
            }

            $message = wordwrap($message, 72);

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= "From: " . $name . " <" . $email . ">\r\n";
            $headers .= "X-Priority: 1\r\n";
            $headers .= "X-MSMail-Priority: High\r\n\r\n";

            mail($to, $subject, $message, $headers);
    ?>

        <h5>Thanks for contacting us!</h5>
        <p>We will response as soon as possible!</p>

        <?php }; ?>

    <form method="POST" action="" id="contact-form">
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        <br>
        
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email">
        <br>
        
        <label for="message">Message</label>
        <textarea id="message" name="message"></textarea>
        <br>
        
        <input type="checkbox" id="subscribe" value="true" name="subscribe"> <label for="subscribe">Subscribe to newsletter</label>
        <br>
        
        <input type="submit"  name="contactSubmit" value="Submit">
        <br>

    </form>
</div>