<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num = (int)$_POST['num'];
    $submit_value = $_POST['submit'];


    if (isset($submit_value)) {
        // instancia la classe
        $result = new Factorial($num, $submit_value);

        if ($submit_value === 'Factorial Iteratiu') {
            $result = $result->calcIterative();
            echo "El resultat del factorial iteratiu es: $result";
        }

        if ($submit_value === 'Factorial Recursiu') {
            $result = $result->calcRecursive($num);
            echo "El resultat del factorial recursiu es $result";
        }
    }
}

class Factorial
{
    public $num;
    public $submit_value;

    public function __construct($num, $submit_value)
    {
        $this->num = $num;
        $this->submit_value = $submit_value;
    }

    public function calcIterative(): int
    {
        $factorial = 1;
        for ($i = 1; $i <= $this->num; $i++) {

            $factorial *= $i;
        }

        return $factorial;
    }

    public function calcRecursive(int $n): int
    {
        if ($n < 2) {
            return 1;
        } else {
            return $n * $this->calcRecursive($n - 1);
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Factorial</title>
</head>

<body>

    <h1>Calculadora de Factorial</h1>

    <form action="" method="POST">
        <label for="num">Introduce un número:</label>
        <input type="number" id="num" name="num" required>

        <br><br>

        <input type="submit" name="submit" value="Factorial Iteratiu">
        <input type="submit" name="submit" value="Factorial Recursiu">
    </form>

</body>

</html>