<?php

namespace Golampi\reports;

class ErrorReport {
    private $errors = [];

    public function addError($type, $desc, $line, $col) {
        $this->errors[] = [
            'type' => $type,
            'desc' => $desc,
            'line' => $line,
            'col' => $col
        ];
    }

    public function hasErrors() {
        return count($this->errors) > 0;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function generateHtml() {
        $html = "<table class='report-table'>\n";
        $html .= "<thead><tr><th>#</th><th>Tipo</th><th>Descripción</th><th>Línea</th><th>Columna</th></tr></thead>\n";
        $html .= "<tbody>\n";
        $idx = 1;
        foreach ($this->errors as $err) {
            $html .= "<tr>";
            $html .= "<td>" . $idx++ . "</td>";
            $html .= "<td>" . htmlspecialchars($err['type']) . "</td>";
            $html .= "<td>" . htmlspecialchars($err['desc']) . "</td>";
            $html .= "<td>" . $err['line'] . "</td>";
            $html .= "<td>" . $err['col'] . "</td>";
            $html .= "</tr>\n";
        }
        $html .= "</tbody></table>";
        return $html;
    }
}
