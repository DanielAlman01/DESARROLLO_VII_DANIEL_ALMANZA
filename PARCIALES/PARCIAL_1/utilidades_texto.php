<?php
function contar_palabras($frase) {
    return str_word_count($frase);
}

function contar_vocales($frase) {
    return preg_match_all('/[aeiouAEIOU]/i', $frase);
}

function invertir_palabras($frase) {
    $palabras_array = explode(' ', $frase);
    return implode(' ', array_reverse($palabras_array));
}

function analizar_frase($frase) {
    return [
        'frase' => $frase,
        'palabras' => contar_palabras($frase),
        'vocales' => contar_vocales($frase),
        'invertida' => invertir_palabras($frase)
    ];
}
?>