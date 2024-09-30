<?php
require('validators.php');


class Calculadora
{
    private $num1;
    private $num2;
    public $submit_value;


    use Validators;

    private function __construct($num1, $num2, $submit_value)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->submit_value = $submit_value;
    }


    public function basicCalc(): string
    {
        switch ($this->submit_value) {
            case 'Sumar':
                return $this->num1 + $this->num2;
            case 'Restar':
                return $this->num1 - $this->num2;
            case 'Multiplicar':
                return $this->num1 * $this->num2;
            case 'Dividir':
                if ($this->num2 != 0) {
                    return $this->num1 / $this->num2;
                } else {
                    return "No es pot dividir entre 0.";
                }
            default:
                return "Operación no válida.";
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num1 = (int)$_POST['num1'];
    $num2 = (int)$_POST['num2'];
    $submit_value = $_POST['submit'];

    // instancia la classe
    $calc = new Calculadora($num1, $num2, $submit_value);

    // Validaciones
    if (!$calc->isNotEmpty($num1) || !$calc->isNotEmpty($num2)) {
        echo "<p>Els camps no poden estar buits 🚫</p>";
    } elseif (!$calc->isNumeric($num1) || !$calc->isNumeric($num2)) {
        echo "<p>Els inputs han de ser numèrics 😭</p>";
    } else {
        $result = $calc->basicCalc();
        echo "<div>El resultat és: <b>$result</b></div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Basica</title>
</head>

<body>
    <div class="first-container">
        <form action="basic_calc.php" method="post">
            <input type="text" name="num1" required><br>
            <input type="text" name="num2" required><br>
            <input type="submit" name="submit" value="Sumar">
            <input type="submit" name="submit" value="Restar">
            <input type="submit" name="submit" value="Multiplicar">
            <input type="submit" name="submit" value="Dividir">
        </form>
    </div>
</body>

</html>