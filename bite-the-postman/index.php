<?
if(isset($_POST['email'])) {

  // EDIT THE 2 LINES BELOW AS REQUIRED
  $email_to = "cat@batthedog.uk";
  $email_subject = "Bat the Dog contact enquiry";

//$to = "cat@batthedog.uk";
//$to = "bat-the-dog@outlook.com";

  function died($error) {
    // your error code can go here
    echo "Sorry, but there appear to be error(s) in the form you've submitted.<br><br>";
    echo $error."<br /><br />";
    echo "Please return and repair.<br /><br />";
    die();
  }


  $name = htmlspecialchars(stripslashes(trim($_POST['name'])));
  $subject = htmlspecialchars(stripslashes(trim($_POST['subject'])));
  $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
  $message = htmlspecialchars(stripslashes(trim($_POST['message'])));


  // validation expected data exists
  if(!isset($_POST['name']) ||
    !isset($_POST['email']) ||
    !isset($_POST['phone']) ||
    !isset($_POST['comments'])) {
    died('We are sorry, but there appears to be a problem with the form you submitted.');
  }


  $first_name = htmlspecialchars(stripslashes(trim($_POST['name']))); // required
  $email_from = htmlspecialchars(stripslashes(trim($_POST['email']))); // not required
  $telephone = htmlspecialchars(stripslashes(trim($_POST['phone']))); // not required
  $comments = htmlspecialchars(stripslashes(trim($_POST['comments']))); // required

  $error_message = "";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

//  if(!preg_match($email_exp,$email_from)) {
//    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
//  }

  $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The name you\'ve entered appears to be invalid.<br />';
  }

  if(strlen($comments) < 2) {
    $error_message .= 'The message you\'ve entered appears to be empty.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

  $email_message = "Form details below.\n\n";


  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }


  $email_message .= "First Name: ".clean_string($first_name)."\n";
  $email_message .= "Email: ".clean_string($email_from)."\n";
  $email_message .= "Telephone: ".clean_string($telephone)."\n";
  $email_message .= "Comments: ".clean_string($comments)."\n";


  // create email headers
  $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

  @mail($email_to, $email_subject, $email_message, $headers);


?><!DOCTYPE html>
<html lang=en-GB>
<head>
  <meta charset=utf-8>
  <meta name=viewport content="width=device-width, initial-scale=1">
  <title>Bat the Dog | Eclectic Acoustic Duo</title>
  <meta name=description content="Musicians available for hire. Bat the Dog are Shalane & Rock n Roll Pete, an acoustic duo with an eclectic musical vocabulary to entertain your venues guests.">

  <meta name=apple-mobile-web-app-capable content=yes>

  <link rel=apple-touch-icon sizes=180x180 href="../i/favicon/apple-touch-icon.png">
  <link rel=icon type="image/png" sizes=32x32 href="../i/favicon/favicon-32x32.png">
  <link rel=icon type="image/png" sizes=16x16 href="../i/favicon/favicon-16x16.png">
  <link rel=manifest href="../i/favicon/site.webmanifest">
  <link rel=mask-icon href="../i/favicon/safari-pinned-tab.svg" color=#5bbad5>
  <link rel="shortcut icon" href=../"i/favicon/favicon.ico">
  <meta name=msapplication-TileColor content=#ffc40d>
  <meta name=msapplication-config content="../i/favicon/browserconfig.xml">
  <meta name=theme-color content=#dddddd>

  <link rel=canonical href="https://batthedog/" />

  <style id=local_css>
*, *::after, *::before {box-sizing: inherit;}
:root {
  --color: #fff;
  --color2: hsla(40, 100%, 47%, 1);
  --bgColor: #1a1a1a;
  --bgColor2: #000;
  --bgImage: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3Cfilter id='a'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.4'/%3E%3C/filter%3E%3C/defs%3E%3Crect filter='url(%23a)' opacity='.3' width='100%25' height='100%25'/%3E%3C/svg%3E");

  --headingColor: #fc0;
  --linkColor: hsla(40, 100%, 50%, 1);
  --linkColor: hsla(30, 100%, 50%, 1);
  --linkColorUnderline: hsla(40, 100%, 50%, 0.5);
  --linkColorUnderline: hsla(30, 100%, 50%, 0.5);
  --linkColorHover: hsla(60, 100%, 50%, 1);
  --linkFocus: hsla(40, 100%, 85%, 1);
  --linkFocus: hsla(30, 100%, 85%, 1);
  --focusOutline: hsla(40, 100%, 85%, .6) solid .25rem;
  --logoColor: hsl(30, 100%, 30%);
  --lineHeight: 1.65;
  --headings: 2.5rem;
}
@media (min-width: 48em) {
  :root {
    font-size: calc(1rem + ((1vw - 0.48rem) * 0.6944));

    --lineHeight: 1.5;
    --headings: 3.5rem;
  }
}
@media (min-width: 60em) {
  :root {
    --headings: 3.8rem;
  }
}

body {
  color: var(--color);
  background-color: var(--bgColor);
  background-attachment: fixed;
  background-image: var(--bgImage);

  font-family: sans-serif;
  text-rendering: optimizeLegibility;
  margin: 0;
  line-height: var(--lineHeight);
  box-sizing: border-box;
}
@media (min-width: 40em) {
  body {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--bgColor2);
    background-image: url(../i/contact.4.25.jpg);
    background-position: center right;
    background-repeat: no-repeat;
    background-size: cover;
  }
}
h1 {
  font-family: serif;
  font-weight: 100;
  font-size: var(--headings);
  line-height: 1.2;
  color: var(--headingColor);
  margin: 0;
}
[class^="lnk"]:link,
[class^="lnk"]:visited {
  color: var(--linkColor);
  text-decoration-color: var(--linkColorUnderline);
  transition: all .3s ease-out;
}
[class^="lnk"]:hover {
  color: var(--linkColorHover);
}
[class^="lnk"]:focus {
  color: var(--linkColorHover);
}

.sctn_ttl-thanks {
  text-shadow: 2px 2px 2px #c33, -2px -2px 2px #000;
}
@media (min-width:48em) {
  .sctn_ttl-thanks > .svg-logo {
    display: inline-block;
    width: 4.2rem;
    height: 4.2rem;
  }
}
.sctn_ttl-thanks > span {
  text-shadow: 2px 2px 2px #c33, -2px -2px 2px #000;
  color: var(--color2);
  font-size: smaller;
}
.svg-logo {
  fill: var(--logoColor);
  width: 2rem;
  height: 2rem;
  vertical-align: middle;
  transform: translateY(-0.2rem);
}
.message {font-size: 1.5rem}
  </style>
</head>
<body>

  <section class=sctn-thanks>
    <div class=sctn_inner>

      <h1 class=sctn_ttl-thanks>
        Thanks,<br>
        <svg class=svg-logo viewBox="0 0 960 960" aria-hidden=true focusable=false>
          <path d="M490 477c-67 8-129 51-166 107-41 68-70 141-75 219-12 58 38 115 94 110 69-6 123-63 191-75 55-16 111 8 165 23 48 13 108-1 125-53 12-53-22-103-48-145-54-65-109-136-188-172-31-16-65-18-98-14zM111 350c-35 5-66 28-72 66-19 99 56 212 156 219 42 3 74-33 79-75 13-86-45-176-124-203-14-7-26-8-39-7zm698-105c-81 14-124 104-123 182-4 57 34 126 95 122 87-10 134-111 126-193-2-53-39-114-98-111zM260 55c-45 6-77 59-77 105-6 91 47 197 142 216l27-3c59-18 78-92 68-149-11-75-61-157-139-170l-21 1zm316-43l-7 1c-73 22-102 107-100 181 0 65 37 145 108 151 10 1 20-2 31-6 79-40 104-145 81-226C678 58 632 5 576 12z"/>
        </svg>
        <span>Bat the Dog</span>
      </h1>

      <p class=message>We will be in touch.</p>
      <p><a class=lnk href="..">Back to site&hellip;</a></p>
    </div>
  </section>

  <script>setTimeout(function(){window.history.back();}, 3000);</script>

</body>
</html>





<?

}
?>
