
            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;500;600;700&display=swap');

        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            text-decoration: none;
        }

        header {
            position: fixed;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #ccc8c6;
            padding: 10px 20px;
        }

        .navbar {
            display: flex;
        }

        .navbar li {
            position: relative;
        }

        .navbar a {
            font-size: 1rem;
            padding: 20px 25px;
            color: #444;
            font-weight: 500;
        }

        main {
            padding: 100px 20px 20px; /* Add top padding to avoid overlap with header */
        }

        .cars-details {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .cars-details h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        .cars-details h1 span {
            color: blueviolet;
        }

        .cars-details img {
            max-width: 40%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cars-details ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
            margin-bottom: 20px;
        }

        .cars-details ul li {
            margin-bottom: 10px;
            color: rgb(2, 2, 3);
        }

        .cars-details ul li strong {
            color: blueviolet;
        }

        .buy-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: blueviolet;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 16px;
        }

        .buy-button:hover {
            background-color: #444;
        }

        .buy-button a {
            color: white;
        }

        .buy-button:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
    <header>
        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#ride">Ride</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#reviews">Reviews</a></li>
        </ul>
    </header>

    <main>
        <div class="cars-details">
        
            <img src="<?php echo $car['image']; ?>" alt="<?php echo $car['name']; ?>">
            <h1><?php echo $car['name']; ?></h1>
            <ul>
                <li><strong>Modèle commercial:</strong> <?php echo $car['model']; ?></li>
                <li><strong>Boîte de vitesse:</strong> <?php echo $car['transmission']; ?></li>
                <li><strong>Nombre de rapport:</strong> <?php echo $car['gear_count']; ?></li>
                <li><strong>Transmission:</strong> <?php echo $car['drive_type']; ?></li>
                <li><strong>Énergie:</strong> <?php echo $car['fuel_type']; ?></li>
                <li><strong>Cylindrée:</strong> <?php echo $car['engine_capacity']; ?></li>
            </ul>
            <button class="buy-button"><a href="<?php echo $car['rent_link']; ?>">Rent now</a></button>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2024, designed by Oussama</p>
    </footer>
</body>
</html>