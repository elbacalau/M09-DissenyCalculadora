<?php

function renderView($result, $history): void
{
    echo <<<HTML
        <h1>Calculadora de Strings</h1>
        <form action="" method="post">
            <input type="text" name="cadenaText1" placeholder="Primera cadena" value=""> 
            <input type="text" name="cadenaText2" placeholder="Segunda cadena" value=""> 
            <div>
                <input type="submit" name="submit" value="Concatenar cadenas">
                <input type="submit" name="submit" value="Eliminar Substring">
            </div>
            <div>
                <br>
                <input type="submit" name="view_history" value="Ver Historial">
                <input type="submit" name="clean_history" value="Borrar Historial"> 
            </div>
    HTML;

    if (!empty($history)) {
        echo "<h3>Historial de Operaciones:</h3>";
        echo "<ul>";
        foreach ($history as $entry) {
            echo "<li>{$entry['result']}</li>";
        }
        echo "</ul>";
    }

    echo "</form>";
}
