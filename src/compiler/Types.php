<?php

namespace Golampi\compiler;

class Types {
    const INT32 = 'int32';
    const FLOAT32 = 'float32';
    const BOOL = 'bool';
    const RUNE = 'rune';
    const STRING = 'string';
    const NIL = 'nil';
    
    // Check if type is numeric
    public static function isNumeric($type) {
        return $type === self::INT32 || $type === self::FLOAT32 || $type === self::RUNE;
    }
    
    // Get default value for a type
    public static function getDefaultValue($type) {
        if (strpos($type, '[') === 0) return self::NIL; // Array default
        if (strpos($type, '*') === 0) return self::NIL; // Pointer default
        
        switch ($type) {
            case self::INT32:
            case self::RUNE:
                return 0;
            case self::FLOAT32:
                return 0.0;
            case self::BOOL:
                return false;
            case self::STRING:
                return '""';
            default:
                return self::NIL;
        }
    }
}
