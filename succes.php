<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image au Milieu de la Page</title>
    <style>
body, html {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    text-align: center;
}

.centered-image img {
    max-width: 100%;
    max-height: 100%;
}
 .btn-container {
    display: flex;
    justify-content: center;
    margin-top: 20px; 
}


.button {
  background-color: #474fa0;  
  color: white; 
  padding: 15px 32px; 
  font-size: 20px;  
  cursor: pointer; 
  border-radius: 5px; 
}
.button:hover{
    background: #fe5b3d;
}



    </style>
</head>
<body>
    <div class="container">
        <div class="centered-image">
            <img src="https://icpih.com/media-intestinal-health-ihsig/PAYMENT-SUCCESS.png" alt="">
            <div class="btn-container">
                <button class="button"> <a href="file:///C:/Users/hp/Desktop/PROJET%20HTML%20CSS%20JS/home.html"> Back to home </a></button>
            </div>
        </div>
    </div>
    
</body>
</html>