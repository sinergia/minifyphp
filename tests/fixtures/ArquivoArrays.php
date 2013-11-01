<?php

namespace Isse\Utils\Constantes;

/**
 * Class Tipos
 * @package Isse\Utils\Constantes
 */
class Tipos
{
    /**
     * Todos os tipos de documentos utilizados
     * @var array
     */
    public static $documentos = array (
        1    => "Cadastro Imobiliario",
        2    => "Cadastro Mobiliario",
        3    => "CPF",
        4    => "CNPJ",
        'J'  => "CNPJ",
        'F'  => "CPF",
        'CGC'=> "CNPJ",
        'IM' => "Cadastro Mobiliario",
    );

    /**
     * Todos os tipos de documentos utilizados
     * @param $v
     * @return string
     */
    public static function documento($v)
    {
        return @static::$documentos[$v] ?: $v;
    }
}
