<?php

namespace Golampi\compiler;

class Environment {
    private $parent;
    private $symbols = [];
    private $scopeName;

    public function __construct($parent = null, $scopeName = 'global') {
        $this->parent = $parent;
        $this->scopeName = $scopeName;
    }

    public function declare($name, $type, $isConst = false, $value = null, $line = 0, $col = 0) {
        if (isset($this->symbols[$name])) {
            return false; // Already declared in this scope
        }
        
        $this->symbols[$name] = [
            'name' => $name,
            'type' => $type,
            'isConst' => $isConst,
            'value' => $value,
            'scope' => $this->scopeName,
            'line' => $line,
            'col' => $col,
            'label' => 'var_' . str_replace('.', '_', uniqid()) // Unico
        ];
        
        return true;
    }

    public function get($name) {
        if (isset($this->symbols[$name])) {
            return $this->symbols[$name];
        }
        if ($this->parent !== null) {
            return $this->parent->get($name);
        }
        return null;
    }

    public function update($name, $value) {
        if (isset($this->symbols[$name])) {
            if ($this->symbols[$name]['isConst']) return false;
            $this->symbols[$name]['value'] = $value;
            return true;
        }
        if ($this->parent !== null) {
            return $this->parent->update($name, $value);
        }
        return false;
    }
    
    public function getScopeName() {
        return $this->scopeName;
    }
    
    public function getSymbols() {
        return $this->symbols;
    }
}
