<?php

require_once '../history/historial_operaciones.php';
require_once '../views/string_screen.php'; 

session_start();

class StringCalculator
{
    private $cadena_text;
    private $submit_value;

    public function __construct($cadena_text1 = '', $cadena_text2 = '', $submit_value = '') 
    {
        $this->cadena_text = '';
        $this->submit_value = $submit_value;


        if ($this->submit_value === 'Concatenar cadenas') {
            $this->cadena_text = $cadena_text1 . $cadena_text2; 
        } else {
            $this->cadena_text = $cadena_text1; 
        }
    }

    private function processString(): string
    {
        $result = '';

        if ($this->submit_value === 'Concatenar cadenas') { 
            $result = $this->cadena_text;
            Historial::addEntry($this->cadena_text, $result); 
        } elseif ($this->submit_value === 'Eliminar Substring') {
            $substring = $_POST['cadenaText2'] ?? '';
            $result = str_replace($substring, '', $this->cadena_text);
            Historial::addEntry($this->cadena_text, $result);
        }

        return $this->cadena_text;
    }

    public static function handleRequest(): void
    {
        try {
            $history = [];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['view_history'])) {
                    $history = Historial::getHistorial();
                } elseif (isset($_POST['clean_history'])) {
                    Historial::clear();
                } else {

                    $calc = new self(
                        $_POST['cadenaText1'] ?? '', 
                        $_POST['cadenaText2'] ?? '', 
                        $_POST['submit'] ?? ''
                    ); 
                    $calc->display(); 
                    return; 
                }
            }

            (new self)->display(); 
        } catch (Exception $e) {
            error_log("Error en StringCalculator: " . $e->getMessage()); 
            echo "Error."; 
        }
    }

    private function display(): void 
    {
        $result = $this->processString(); 
        echo "<div><b>Resultado/Expresión:</b> $result</div>";
        $this->renderForm($result, Historial::getHistorial());
    }

    private function renderForm($result, $history)
    {
        renderView($result, $history);
    }
}

StringCalculator::handleRequest();