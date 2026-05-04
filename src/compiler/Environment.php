<?php

namespace Golampi\compiler;

class Environment {
    private $parent;
    private $symbols = [];
    private $scopeName;
    private $isGlobal;
    private $offsetTracker;

    public function __construct($parent = null, $scopeName = 'global', $offsetTracker = null) {
        $this->parent = $parent;
        $this->scopeName = $scopeName;
        $this->isGlobal = ($parent === null);
        $this->offsetTracker = $offsetTracker;
    }

    public function declare($name, $type, $isConst = false, $size = 8, $line = 0, $col = 0, $label = null) {
        if (isset($this->symbols[$name])) {
            return false;
        }
        
        if ($this->isGlobal) {
            if ($label === null) {
                $label = 'var_' . $name . '_' . str_replace('.', '_', uniqid());
            }
            $this->symbols[$name] = [
                'name' => $name,
                'type' => $type,
                'isConst' => $isConst,
                'isGlobal' => true,
                'label' => $label,
                'scope' => $this->scopeName,
                'line' => $line,
                'col' => $col
            ];
        } else {
            if ($this->offsetTracker === null) {
                $this->offsetTracker = new \stdClass();
                $this->offsetTracker->offset = 0;
            }
            // Align size to 8 bytes for simplicity on ARM64 stack
            $size = ceil($size / 8) * 8;
            $this->offsetTracker->offset += $size;
            $this->symbols[$name] = [
                'name' => $name,
                'type' => $type,
                'isConst' => $isConst,
                'isGlobal' => false,
                'offset' => -$this->offsetTracker->offset, // Local vars are negative from x29
                'scope' => $this->scopeName,
                'line' => $line,
                'col' => $col,
                'size' => $size
            ];
        }
        return true;
    }
    
    public function declareParam($name, $type, $offset, $line = 0, $col = 0) {
        if (isset($this->symbols[$name])) {
            return false;
        }
        $this->symbols[$name] = [
            'name' => $name,
            'type' => $type,
            'isConst' => false,
            'isGlobal' => false,
            'offset' => $offset, // Parameters are positive from x29
            'scope' => $this->scopeName,
            'line' => $line,
            'col' => $col,
            'size' => 8
        ];
        return true;
    }

    public function update($name, $data) {
        if (isset($this->symbols[$name])) {
            $this->symbols[$name] = $data;
            return true;
        }
        if ($this->parent !== null) {
            return $this->parent->update($name, $data);
        }
        return false;
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

    public function getScopeName() {
        return $this->scopeName;
    }
    
    public function getSymbols() {
        return $this->symbols;
    }
    
    public function getOffsetTracker() {
        return $this->offsetTracker;
    }
}
