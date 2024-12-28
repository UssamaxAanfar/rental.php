<?php
                // Simulate fetching car details from a database
                $car = [
                    'name' => 'Land Rover Range Rover Sport',
                    'image' => 'c:/Users/hp/Downloads/2024_land-rover_range-rover-evoque_4dr-suv_p250-dynamic-se_fq_oem_1_1280.avif', // Update path as needed
                    'model' => 'Land Rover',
                    'transmission' => 'Automatique Séquentielle à 8 rapports',
                    'architecture' => '6 cylindres en V',
                    'drive_type' => '2 roues motrices (2WD ou 4x2)',
                    'fuel_type' => 'Diesel',
                    'engine_capacity' => '2.993 cm³',
                    'rent_link' => 'file:///C:/Users/hp/Desktop/PROJET%20HTML%20CSS%20JS/Payement.html'
                ];
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details 2</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

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
            padding: 80px 20px 20px; /* Add top padding to avoid overlap with header */
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

        .buy-button a {
            color: white;
        }

        .buy-button:hover {
            background-color: #444;
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
                <li><strong>Architecture:</strong> <?php echo $car['architecture']; ?></li>
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