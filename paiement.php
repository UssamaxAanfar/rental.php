<?php
 
class PaymentValidator {
    private $errors = [];

    public function validateCard(string $cardNumber, string $expiryDate, string $cvv): bool {
        $this->validateCardNumber($cardNumber);
        $this->validateExpiryDate($expiryDate);
        $this->validateCVV($cvv);
        
        return empty($this->errors);
    }

    private function validateCardNumber(string $cardNumber): void {
        if (empty($cardNumber)) {
            $this->errors[] = "Numéro de carte est requis.";
        } elseif (!preg_match("/^\d{16}$/", $cardNumber)) {
            $this->errors[] = "Numéro de carte doit contenir 16 chiffres.";
        }
    }

    private function validateExpiryDate(string $expiryDate): void {
        if (empty($expiryDate)) {
            $this->errors[] = "Date d'expiration est requise.";
        } else {
            list($month, $year) = explode('/', $expiryDate);
            $month = (int)$month;
            $year = (int)$year + 2000;

            if ($month < 1 || $month > 12) {
                $this->errors[] = "Mois d'expiration invalide.";
            }
        }
    }

    private function validateCVV(string $cvv): void {
        if (empty($cvv)) {
            $this->errors[] = "CVV est requis.";
        } elseif (!preg_match("/^\d{3}$/", $cvv)) {
            $this->errors[] = "CVV doit contenir 3 chiffres.";
        }
    }

    public function getErrors(): array {
        return $this->errors;
    }
}

class PaymentProcessor {
    private $validator;

    public function __construct(PaymentValidator $validator) {
        $this->validator = $validator;
    }

    public function processPayment(array $paymentData): string {
        $isValid = $this->validator->validateCard(
            $paymentData['card-number'],
            $paymentData['expiry'],
            $paymentData['cvv']
        );

        if (!$isValid) {
            return $this->displayErrors($this->validator->getErrors());
        }

        return $this->displaySuccess();
    }

    private function displayErrors(array $errors): string {
        $output = "<div class='errors'>";
        foreach ($errors as $error) {
            $output .= "<p>$error</p>";
        }
        $output .= "</div>";
        return $output;
    }

    private function displaySuccess(): string {
        return "<div class='success-message'>
                <h3>Paiement effectué avec succès!</h3>
                <p>Merci d'avoir réservé votre véhicule.</p>
               </div>";
    }
}

class RentalSummary {
    private $car;
    private $duration;
    private $pricePerDay;

    public function __construct(string $car, int $duration, float $pricePerDay) {
        $this->car = $car;
        $this->duration = $duration;
        $this->pricePerDay = $pricePerDay;
    }

    public function getTotal(): float {
        return $this->duration * $this->pricePerDay;
    }

    public function render(): string {
        return "<div class='summary'>
                <p><strong>Voiture :</strong> {$this->car}</p>
                <p><strong>Durée :</strong> {$this->duration} JOURS</p>
                <p><strong>Prix par jour :</strong> {$this->pricePerDay} DH</p>
                <p><strong>Total :</strong> {$this->getTotal()} DH</p>
               </div>";
    }
}

// Usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validator = new PaymentValidator();
    $processor = new PaymentProcessor($validator);
    $result = $processor->processPayment($_POST);
}

$rentalSummary = new RentalSummary("Mercedes G63", 25, 10500);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
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
        background: #ccc8c6;
        padding: 15px 100px;
    }

    .navbar {
        display: flex;
    }

    .navbar li {
        position: relative;
    }

    .navbar a {
        font-size: 1rem;
        padding: 10px 20px;
        color: #444;
        font-weight: 500;
    }

    .navbar a::after {
        width: 100%;
        height: 3px;
        background: #ffac38;
        position: absolute;
        bottom: -4px;
        left: 0;
    }

    .navbar a:hover::after {
        width: 100%;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
    }

    .container h2 span {
        color: blueviolet;
    }

    header .container h1 {
        color: #000000;
    }

    .container h2 {
        font-size: 3rem;
        padding: 20px 20px;
        font-weight: 500;
        color: #000000;
        letter-spacing: 2px;
    }

    header {
        background-color: #ccc8c6;
        color: #fff;
        padding: 9px 0;
    }

    footer {
        background-color: #f9f9f9;
        padding: 2px 0;
    }

    main {
        padding: 20px 0;
        background-color: #fff;
        background-size: cover;
        background: url(https://traduc.com/blog/wp-content/uploads/sites/2/2020/01/paiement-international.jpg)
    }

    .summary, form {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #444;
        border-radius: 5px;
    }

    button {
        padding: 10px 20px;
        background-color: blueviolet;
        color: #fffefe;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button a {
        color: rgb(248, 248, 248);
    }

    button:hover {
        background-color: #444;
    }

    footer .container p {
        color: #000000;
    }

    .errors {
        color: red;
        margin-bottom: 10px;
    }
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
    }

    .success-message h3 {
        margin-bottom: 10px;
    }

    .success-message p {
        margin: 0;
    }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h2>Récapitulatif de la <span>Location</span></h2>
            <?php echo $rentalSummary->render(); ?>
            
            <h2>Informations de <span>Paiement</span></h2>
            <?php if (isset($result)) echo $result; ?>
            
            <form id="payment-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="card-number"><strong>Numéro de Carte :</strong></label>
                <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>
                
                <label for="expiry"><strong>Date d'Expiration :</strong></label>
                <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
                
                <label for="cvv"><strong>CVV :</strong></label>
                <input type="text" id="cvv" name="cvv" placeholder="123" required>
                
                <button type="submit">Payer Maintenant</button>

            </form>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2024, designed by Oussama</p>
    </footer>
</body>
</html>