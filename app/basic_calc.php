<?php

require_once './validators.php'; 
require_once '../vendor/autoload.php';
require_once './views/calc_screen.php';
require_once './utils/const.php';
require_once 'factorial.php';


session_start();
class Calculadora
{
    private $expression;
    public $submit_value;

    use Validators;

    // constructor
    public function __construct($expression, $submit_value)
    {
        $this->expression = $expression;
        $this->submit_value = $submit_value;
    }

   
    public function basicCalc(): string
{
    
    if ($this->submit_value === '=') {

        // verificar la divisio entre 0
        if (strpos($this->expression, '/0') !== false) {
            return 'Error: No es pot dividir entre 0';
        }

        try {
            
            $this->expression = str_replace('x', '*', $this->expression);

            $parser = new \Math\Parser();
            $result = $parser->evaluate($this->expression);

            
            return (string)$result;
        } catch (ParseError $e) {
            return 'Expression no válida';
        }

    
    } elseif ($this->submit_value === 'C') {
        return '';

    
    } elseif ($this->submit_value === 'factorial') {
        $factorial = new Factorial(NUMERO_FACT, TIPO_FACT);

        if (TIPO_FACT === 'recursiu') {
            $result = $factorial->calcRecursive();
        } elseif (TIPO_FACT === 'iteratiu') {
            $result = $factorial->calcIterative();
        } else {
            return 'Error: Tipo de factorial no válido';
        }

        return (string)$result;

    
    } else {
        
        return $this->expression . $this->submit_value;
    }
}


    
    public static function handleRequest(): void
    {

        $history = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['clean_history'])) {
                Historial::clear();
            }

            $calc = self::processForm();
            if ($calc) {
                $calc->display();
            }
        } else {
            $calc = new self('', '');
            $calc->renderForm('', $history);
        }
    }

    
    private static function processForm(): Calculadora
    {
        $expression = $_POST['expression'] ?? '';
        $submit_value = $_POST['submit'] ?? '';

        return new self($expression, $submit_value);
    }

    private function display(): void
    {
        $result = $this->basicCalc();

        echo "<div><b>Resultado/Expresión:</b> $result</div>";

        $this->renderForm($result, Historial::getHistorial());
    }

    
    private function renderForm($result, $history)
    {
        renderView($result, $history);    
    }
    
}

Calculadora::handleRequest();




