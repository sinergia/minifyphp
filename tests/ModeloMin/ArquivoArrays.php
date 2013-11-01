<?php
 namespace Isse\Utils\Constantes;class Tipos{public static $documentos=array(1=>"Cadastro Imobiliario",2=>"Cadastro Mobiliario",3=>"CPF",4=>"CNPJ",'J'=>"CNPJ",'F'=>"CPF",'CGC'=>"CNPJ",'IM'=>"Cadastro Mobiliario",);public static function documento($v){return @static ::$documentos[$v]?:$v;}}
