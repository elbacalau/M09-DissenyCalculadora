<?php

class Historial
{
  
    public static function init(): void
    {
        if (!isset($_SESSION['historial'])) {
            $_SESSION['historial'] = []; 
        }
    }

    
    public static function addEntry(string $expression, $result): void
    {
        $_SESSION['historial'][] = [
            'expression' => $expression,
            'result' => $result
        ];
    }

    
    public static function getHistorial(): array
    {
        return $_SESSION['historial'] ?? [];
    }


    public static function clear(): void
    {
        $_SESSION['historial'] = [];
    }
}
