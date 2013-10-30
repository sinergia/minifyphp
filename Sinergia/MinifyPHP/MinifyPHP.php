<?php

namespace Sinergia\MinifyPHP;

class MinifyPHP
{
    public $separator = " ";
    public $removeList = array();

    public function minify($code)
    {
        $tokens = token_get_all($code);
        $minified = "";
        foreach ($tokens as $token) {
            $minified .= $this->minifyToken($token);
        }

        return $minified;
    }

    public function minifyToken($token)
    {
        if ( ! is_array($token) ) return $token;
        list($type, $str) = $token;

        switch ($type) {
            // sempre ignora espaços em branco ou quebras de linha
            case T_WHITESPACE: return "";

            // remover os seguintes tokens apenas se estiverem na lista de ignorados:
            case T_DOC_COMMENT:
            case T_COMMENT:
            case T_INLINE_HTML:
                return in_array($type, $this->removeList) ? "" : $str;

            // adicionar separador após os seguintes tokens:
            case T_ECHO:
            case T_CLASS:
            case T_FUNCTION:
                return $str.$this->separator;

            // por padrão, retorna o token sem modificá-lo
            default: return $str;
        }
    }
}
