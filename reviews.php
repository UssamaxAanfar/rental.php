<?php
session_start();

// Initialize reviews array in session
if (!isset($_SESSION['reviews'])) {
    $_SESSION['reviews'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Delete a review
        $index = intval($_POST['delete']);
        unset($_SESSION['reviews'][$index]);
        $_SESSION['reviews'] = array_values($_SESSION['reviews']); // Reindex the array
    } elseif (!empty($_POST['name']) && !empty($_POST['comment'])) {
        // Sanitize input
        $name = htmlspecialchars(trim($_POST['name']));
        $comment = htmlspecialchars(trim($_POST['comment']));
        
        // Store the review
        $_SESSION['reviews'][] = ['name' => $name, 'comment' => $comment];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REVIEWS</title>
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
 font-family: "Poppins", sans-serif;
margin: 0;
padding: 0;
box-sizing: border-box;

list-style: none;
text-decoration: none;

}
header{
position: fixed;
width: 100%;
top : 0;
right: 0;
z-index: 1000;
display: flex;
align-items: center;
justify-content: space-between;
background: #ccc8c6;
padding: 10px 400px; 

}
.navbar{
    display:flex;
background: #ccc8c6;
margin-bottom: 5%;
}
.navbar li{
position: relative;V
}

.navbar a{
font-size: 1rem;
padding: 20px 25px;
color: #444;
font-weight: 400;
}

.heading{
    text-align: center;

}
.heading span{
    font-weight: 500;
    text-transform: uppercase;
    margin-right: 10px;
}
.heading h1{
    font-size: 2rem;
    margin: 0;
}
.reviews-container{
display: grid;
grid-template-columns: repeat(auto-fit, minmax(250px, auto));
margin-top: 2rem;
}
.rev-imga{
    width: 70px;
    height: 70px;
}
.rev-imga img{
width: 100%;
height: 100%;
border-radius: 50%;
border: 2px solid #8c0bc3;
}
.reviews-container .box{
display: flex;
flex-direction: column;
align-items: center;
text-align: center;
padding: 20px;
box-shadow: 1px 4px 41px rgba(0, 0, 0, 0.1);
border-radius: 0.5rem;

}
.reviews-container .box h2{
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0.5rem 0 0.5rem;
}
.reviews-container .box p{
    font-style: italic;
}
.reviews-container .box .stars .bx{
    color: #8c0bc3;
}
.letters{
    background: #8c0bc3;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.letters h2{
    color: #fff;
    font-size: 1.5rem;
}
.letters .box{
    margin-top: 1rem;
    background: #fff;
    border-radius: 0.5rem;
    padding: 4px 8px;
    width: 380px;
    display: flex;
    justify-content: space-between;
}
.letters .box input {
border: none;
outline: none;

}
.letters .box .btn{
background: #8c0bc3;
color: #fff;
padding: 8px 10px;
border-radius: 0.5rem;
}
    </style>
</head>
<body>
    <header>       
        <ul class="navbar">
            <li><a href="file:///C:/Users/hp/Desktop/PROJET%20HTML%20CSS%20JS/home.html" >Home</a></li>
            <li><a href="#ride">ride</a></li>
            <li><a href="#services">services</a></li>
            <li><a href="#reviews">reviews</a></li>
        </ul>
    </header>

    <section class="reviews" id="reviews">
        <div class="heading">
            <span>Commentaires </span>
            <h1> Que dit notre client</h1>
        </div>
        
        <div class="reviews-container">
            <?php foreach ($_SESSION['reviews'] as $index => $review): ?>
                <div class="box">
                    <div class="rev-imga">
                        <img src="path/to/default/image.jpg" alt="">
                    </div>
                    <h2><?php echo $review['name']; ?></h2>
                    <p><?php echo $review['comment']; ?></p>
                    <form method="POST" action="">
                        <button type="submit" name="delete" value="<?php echo $index; ?>" class="btn">Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <section class="letters">
            <h2>Ajouter un Commentaire</h2>
            <form method="POST" action="">
                <div class="box">
                    <input type="text" name="name" placeholder="Votre nom" required>
                    <input type="text" name="comment" placeholder="Votre commentaire" required>
                    <button type="submit" class="btn">Soumettre</button>
                </div>
            </form>
        </section>
    </section>
</body>
</html>