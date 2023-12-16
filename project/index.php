<?php

$db_name = 'contact_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    $date = $_POST['date'];
    $date = filter_var($date, FILTER_SANITIZE_STRING);
    $guests = $_POST['guests'];
    $guests = filter_var($guests, FILTER_SANITIZE_NUMBER_INT);

    $select_contact = $conn->prepare("SELECT * FROM `contact_form` WHERE name = ? AND number = ? AND guests = ?");
    $select_contact->execute([$name, $number, $guests]);

    if ($select_contact->rowCount() > 0) {
        $message[] = 'Message sent already!';
    } else {
        $insert_contact = $conn->prepare("INSERT INTO `contact_form` (name, number, date, guests) VALUES (?, ?, ?, ?)");
        $insert_contact->execute([$name, $number, $date, $guests]);
        $message[] = 'Message sent successfully!';

        // Redirect to view_messages.php after successful message insertion
        header("Location: view_messages.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedai Sun</title>

    <!--font awasome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!--custom css file link-->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
            <div class="message">
                <span>' . $msg . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
?>

<!--header section start-->

<header class="header">
    
    <section class="flex">

        <a href="#home" class="logo"><img src="images/logo.png" alt=""></a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#menu">menu</a>
            <a href="#team">team</a>
            <a href="#contact">contact</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

</header>

<!--header section ends-->

<!--home section start-->

<div class="home-bg">

    <section class="home" id="home">

        <div class="content">
            <h3>Kedai Sun</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti ea cumque amet nihil, eos sapiente?</p>
            <a href="#about" class="btn">about us</a>
        </div>

    </section>

</div>

<!--home section ends-->

<!--about section start-->

<section class="about" id="about">

    <div class="image">
        <img src="images/about-img.svg" alt="">
    </div>

    <div class="content">
        <h3>Baked your memories</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus quidem perferendis, id sapiente itaque, recusandae quos praesentium sed consequatur assumenda odio officiis excepturi deleniti repudiandae omnis explicabo nostrum ducimus iusto.</p>
        <a href="#menu" class="btn">our menu</a>
    </div>

</section>

<!--about section ends-->

<!--facility section start-->

<section class="facility">

    <div class="heading">
        <h3>our facility</h3>
    </div>

    <div class="box-container">

        <div class="box">
            <img src="images/icon-1.png" alt="">
            <h3>varieties of drinks</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, magnam.</p>
        </div>

        <div class="box">
            <img src="images/icon-2.png" alt="">
            <h3>varieties of coffees</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, magnam.</p>
        </div>

        <div class="box">
            <img src="images/icon-3.png" alt="">
            <h3>dessert</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, magnam.</p>
        </div>

        <div class="box">
            <img src="images/icon-4.png" alt="">
            <h3>appetizer</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, magnam.</p>
        </div>
        
        <div class="box">
            <img src="images/icon-5.png" alt="">
            <h3>main course</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, magnam.</p>
        </div>

    </div>

</section>

<!--facility section ends-->

<!--menu section start-->

<section class="menu" id="menu">

    <div class="heading">
        <h3>popular menu</h3>
    </div>

    <div class="box-container">

        <div class="box">
            <img src="images/menu-1.jpg" alt="">
            <h3>smoothies</h3>
        </div>

        <div class="box">
            <img src="images/menu-2.jpeg" alt="">
            <h3>cappuccino</h3>
        </div>

        <div class="box">
            <img src="images/menu-3.jpg" alt="">
            <h3> cheesecake</h3>
        </div>

        <div class="box">
            <img src="images/menu-4.webp" alt="">
            <h3>lumpia</h3>
        </div>

        <div class="box">
            <img src="images/menu-5.jpg" alt="">
            <h3>Lasagna Panggang</h3>
        </div>

    </div>

</section>

<!--menu section ends-->

<!--team section start-->

<section class="team" id="team">

    <div class="heading">
        <h3>our team</h3>
    </div>
    
    <div class="box-container">

        <div class="box">
            <img src="images/our-team-1.jpeg" alt="">
            <h3>lala</h3>
        </div>

        <div class="box">
            <img src="images/our-team-2.jpeg" alt="">
            <h3>lili</h3>
        </div>

        <div class="box">
            <img src="images/our-team-3.jpeg" alt="">
            <h3>lulu</h3>
        </div>

    </div>

</section>

<!--team section ends-->

<!--contact section start-->

<section class="contact" id="contact">

    <div class="heading">
        <h3>contact here</h3>
    </div>

    <div class="row">

        <div class="image">
            <img src="images/contact-img.png" alt="">
        </div>

        <form action="" method="post">
            <h3>book a table</h3>
            <input type="text" name="name" required class="box" maxlength="20" placeholder="enter your name">
            <input type="number" name="number" required class="box" maxlength="20" placeholder="enter your number" min="0" max="999999999999" onkeypress="if(this.value.length == 12)" return false>
            <input type="number" name="guests" required class="box" maxlength="20" placeholder="how many guests" min="0" max="10" onkeypress="if(this.value.length == 2)" return false>
            <input type="date" name="date" required class="box">
            <input type="submit" name="send" value="send message" class="btn">
        </form>

    </div>

</section>

<!--contact section ends-->

<!--footer section starts-->

<section class="footer" id="footer">

    <div class="box-container">

        <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>our email</h3>
            <p>210601110010@student.uin-malang.ac.id</p>
            <p>silviyatus.yulianti33@gmail.com</p>
        </div>

        <div class="box">
            <i class="fas fa-clock"></i>
            <h3>opening hours</h3>
            <p>08:00am to 09:00pm</p>
        </div>
    
        <div class="box">
            <i class="fas fa-map-marker-alt"></i>
            <h3>shop location</h3>
            <p>malang, indonesia</p>
        </div>
    
        <div class="box">
            <i class="fas fa-phone"></i>
            <h3>our number</h3>
            <p>+6285748437010</p>
        </div>

    </div>

    <div class="end">UAS PEMPROGRAMAN KOMPUTER oleh <span>SILVIYATUS YULIANTI 210601110010</span> |Terima Kasih </div>

</section>

<!--footer section ends-->


<!--custom js file link-->

<script src="js/script.js"></script>
</body>
</html>