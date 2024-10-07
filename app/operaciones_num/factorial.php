<?php

// define('NUMERO_FACT', 5);
require_once '../utils/const.php';
require_once '../validators.php';


class Factorial
{

    use Validators;

    private $num;
    private $tipo_factorial;

    public function __construct($num, $tipo_factorial)
    {
        // arrodonir el numero per evitar decimals
        $this->num = $num;
        $this->tipo_factorial = $tipo_factorial;
    }

    public function calcIterative(): int
    {

        if ($this->num < 0) {
            return 0;
        }

        $factorial = 1;
        for ($i = 1; $i <= $this->num; $i++) {
            $factorial *= $i;
        }
        return $factorial;
    }

    public function calcRecursive(int $n = null): int
    {
        if ($n === null) {
            $n = $this->num;
        }

        if ($n < 0) {
            return 0; 
        } elseif ($n < 2) {
            return 1; // 0! = 1, 1! = 1
        } else {
            return $n * $this->calcRecursive($n - 1);
        }
    }
}

