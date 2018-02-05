<?php

/**
 * Created by PhpStorm.
 * User: mpijierro
 * Date: 18/02/17
 * Time: 13:43
 */

namespace MPijierro\Identity;

class Identity
{
    public function isValidIban($aIbanNumber)
    {

        $iban = new \IBAN();

        return $iban->Verify($aIbanNumber);

    }

    public function documentIsValid($documentId)
    {

        return ($this->isValidCif($documentId) OR $this->isValidNif($documentId) OR ($this->isValidNie($documentId)));

    }

    public function isValidCif($cif)
    {

        $cifRegEx1 = '/^[ABEH][0-9]{8}$/i';
        $cifRegEx2 = '/^[KPQS][0-9]{7}[A-J]$/i';
        $cifRegEx3 = '/^[CDFGJLMNRUVW][0-9]{7}[0-9A-J]$/i';

        if (preg_match($cifRegEx1, $cif) || preg_match($cifRegEx2, $cif) || preg_match($cifRegEx3, $cif)) {
            $control = $cif[strlen($cif) - 1];
            $suma_A = 0;
            $suma_B = 0;

            for ($i = 1; $i < 8; $i++) {
                if ($i % 2 == 0) {
                    $suma_A += intval($cif[$i]);
                } else {
                    $t = (intval($cif[$i]) * 2);
                    $p = 0;

                    for ($j = 0; $j < strlen($t); $j++) {
                        $p += substr($t, $j, 1);
                    }
                    $suma_B += $p;
                }
            }

            $suma_C = (intval($suma_A + $suma_B))."";
            $suma_D = (10 - intval($suma_C[strlen($suma_C) - 1])) % 10;

            $letras = "JABCDEFGHI";

            if ($control >= "0" && $control <= "9") {
                return ($control == $suma_D);
            }

            return (strtoupper($control) == $letras[$suma_D]);
        }

        return false;
    }

    public function isValidNif($nif)
    {
        $nifRegEx = '/^[0-9]{8}[A-Z]$/i';

        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";

        if (preg_match($nifRegEx, $nif)) {
            return ($letras[(substr($nif, 0, 8) % 23)] == $nif[8]);
        }

        return false;
    }

    public function isValidNie($nif)
    {
        $nieRegEx = '/^[KLMXYZ][0-9]{7}[A-Z]$/i';
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";

        if (preg_match($nieRegEx, $nif)) {

            $r = str_replace(['X', 'Y', 'Z'], [0, 1, 2], $nif);

            return ($letras[(substr($r, 0, 8) % 23)] == $nif[8]);
        }

        return false;

    }

    public function sanitize($documentId)
    {
        $sanitizeDocumentId = trim($documentId);
        $sanitizeDocumentId = strtoupper($sanitizeDocumentId);

        return preg_replace("/[^A-Za-z0-9]/", "", $sanitizeDocumentId);
    }
}