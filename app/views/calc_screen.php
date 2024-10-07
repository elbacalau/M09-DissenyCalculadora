<?php

function renderView($result, $history): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['clean_history'])) {
            $history = Historial::clear();
            $history = [];
        }
    }


    echo <<<HTML
        <form action="" method="post">
            <input type="hidden" name="expression" value="{$result}">
            <div>
                <input type="submit" name="submit" value="1">
                <input type="submit" name="submit" value="2">
                <input type="submit" name="submit" value="3"><br>
                <input type="submit" name="submit" value="4">
                <input type="submit" name="submit" value="5">
                <input type="submit" name="submit" value="6"><br>
                <input type="submit" name="submit" value="7">
                <input type="submit" name="submit" value="8">
                <input type="submit" name="submit" value="9"><br>
                <input type="submit" name="submit" value="0">
            </div>
            <div>
                <input type="submit" name="submit" value="+">
                <input type="submit" name="submit" value="-">
                <input type="submit" name="submit" value="x">
                <input type="submit" name="submit" value="/">
                <input type="submit" name="submit" value="=">
                <input type="submit" name="submit" value="C">
                <input type="submit" name="submit" value="factorial">
            </div>
            <div>
                <br>
                <input type="submit" name="view_history" value="Ver Historial">
                <input type="submit" name="clean_history" value="Borrar Historial"> 
            </div>
        </form>
HTML;

    // TODO: arreglar ver historial para que se muestre correctamente

    if (!empty($history)) {
        echo "<h3>Historial de Operaciones:</h3>";
        echo "<ul>";
        foreach ($history as $entry) {
            echo "<li>{$entry['expression']} = {$entry['result']}</li>";
        }
        echo "</ul>";
    }
}
