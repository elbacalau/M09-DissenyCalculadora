<?php
trait Validators
{
    public function isNotEmpty($input) {
        return !empty($input);
    }

    public function isNumeric($input) {
        return is_numeric($input);
    }

}
