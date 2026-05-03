<?php

namespace Golampi\reports;

class SymbolReport {
    private $allSymbols = [];

    public function addSymbol($symbol) {
        $this->allSymbols[] = $symbol;
    }

    public function getSymbols() {
        return $this->allSymbols;
    }

    public function generateHtml() {
        $html = "<table class='report-table'>\n";
        $html .= "<thead><tr><th>Identificador</th><th>Tipo</th><th>Ámbito</th><th>Valor</th><th>Línea</th><th>Columna</th></tr></thead>\n";
        $html .= "<tbody>\n";
        foreach ($this->allSymbols as $sym) {
            $val = $sym['value'] !== null ? $sym['value'] : '—';
            $html .= "<tr>";
            $html .= "<td>" . htmlspecialchars($sym['name']) . "</td>";
            $html .= "<td>" . htmlspecialchars($sym['type']) . "</td>";
            $html .= "<td>" . htmlspecialchars($sym['scope']) . "</td>";
            $html .= "<td>" . htmlspecialchars($val) . "</td>";
            $html .= "<td>" . $sym['line'] . "</td>";
            $html .= "<td>" . $sym['col'] . "</td>";
            $html .= "</tr>\n";
        }
        $html .= "</tbody></table>";
        return $html;
    }
}
