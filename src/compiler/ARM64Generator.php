<?php

namespace Golampi\compiler;

class ARM64Generator
{
    private $dataSection = [];
    private $textSection = [];
    private $labelCounter = 0;

    public function __construct()
    {
        $this->addText(".align 2");
        $this->addText(".global _start");
    }

    public function newLabel($prefix = "L")
    {
        return $prefix . ($this->labelCounter++);
    }

    public function addData($label, $directive, $value)
    {
        $this->dataSection[$label] = "$label: $directive $value";
    }

    public function hasData($label)
    {
        return isset($this->dataSection[$label]);
    }

    public function addText($instruction)
    {
        $this->textSection[] = $instruction;
    }

    public function getCode()
    {
        $code = ".section .data\n";
        // Built-in data
        $code .= "newline: .ascii \"\\n\"\n";
        $code .= "space: .ascii \" \"\n";
        $code .= "true_str: .asciz \"true\"\n";
        $code .= "false_str: .asciz \"false\"\n";
        $code .= "nil_str: .asciz \"<nil>\"\n";
        $code .= "int_buffer: .skip 32\n";
        $code .= "float_buffer: .skip 64\n";
        $code .= "f_10: .float 10.0\n";
        $code .= "f_eps: .float 0.0001\n";
        $code .= "substr_buffer: .skip 1024\n";

        foreach ($this->dataSection as $data) {
            $code .= $data . "\n";
        }

        $code .= "\n.section .text\n";
        foreach ($this->textSection as $text) {
            if (strpos($text, ':') !== false && strpos($text, ' ') === false && strpos($text, '\t') === false) {
                $code .= $text . "\n";
            } else {
                $code .= "    " . $text . "\n";
            }
        }

        // Add built-in routines
        $code .= $this->getPrintRoutines();

        return $code;
    }

    private function getPrintRoutines()
    {
        return "
// ===== PRINT ROUTINES =====

print_space:
    stp x29, x30, [sp, -16]!
    mov x0, 1
    adrp x1, space
    add x1, x1, :lo12:space
    mov x2, 1
    mov x8, 64
    svc 0
    ldp x29, x30, [sp], 16
    ret

print_newline:
    stp x29, x30, [sp, -16]!
    mov x0, 1
    adrp x1, newline
    add x1, x1, :lo12:newline
    mov x2, 1
    mov x8, 64
    svc 0
    ldp x29, x30, [sp], 16
    ret

print_int:
    // x0 contains integer
    stp x29, x30, [sp, -64]!
    mov x29, sp
    
    cbnz x0, .L_print_int_not_zero
    // Zero
    mov x0, 1
    adrp x1, int_buffer
    add x1, x1, :lo12:int_buffer
    mov w2, '0'
    strb w2, [x1]
    mov x2, 1
    mov x8, 64
    svc 0
    b .L_print_int_end
    
.L_print_int_not_zero:
    mov x1, x0
    mov x2, 10
    adrp x3, int_buffer
    add x3, x3, :lo12:int_buffer
    add x3, x3, 30
    mov w4, 0
    strb w4, [x3] // null terminator
    
    // Check sign
    mov x9, 0
    cmp x1, 0
    b.ge .L_print_int_loop
    mov x9, 1
    neg x1, x1
    
.L_print_int_loop:
    cbz x1, .L_print_int_sign
    udiv x4, x1, x2 // x4 = x1 / 10
    msub x5, x4, x2, x1 // x5 = x1 - (x4 * 10) (modulo)
    add x5, x5, '0'
    sub x3, x3, 1
    strb w5, [x3]
    mov x1, x4
    b .L_print_int_loop
    
.L_print_int_sign:
    cbz x9, .L_print_int_write
    sub x3, x3, 1
    mov w5, '-'
    strb w5, [x3]
    
.L_print_int_write:
    adrp x1, int_buffer
    add x1, x1, :lo12:int_buffer
    add x1, x1, 30
    sub x2, x1, x3 // length
    mov x1, x3 // buffer ptr
    mov x0, 1 // stdout
    mov x8, 64
    svc 0
    
.L_print_int_end:
    ldp x29, x30, [sp], 64
    ret

print_string:
    // x0 contains string pointer
    stp x29, x30, [sp, -16]!
    cbz x0, .L_print_string_end
    mov x1, x0
    
    // calculate length
    mov x2, 0
.L_str_len_loop:
    ldrb w3, [x1, x2]
    cbz w3, .L_str_len_done
    add x2, x2, 1
    b .L_str_len_loop
.L_str_len_done:
    cbz x2, .L_print_string_end
    mov x0, 1
    mov x8, 64
    svc 0
.L_print_string_end:
    ldp x29, x30, [sp], 16
    ret

print_bool:
    stp x29, x30, [sp, -16]!
    cbz x0, .L_print_false
    adrp x0, true_str
    add x0, x0, :lo12:true_str
    b .L_print_bool_call
.L_print_false:
    adrp x0, false_str
    add x0, x0, :lo12:false_str
.L_print_bool_call:
    bl print_string
    ldp x29, x30, [sp], 16
    ret

print_nil:
    stp x29, x30, [sp, -16]!
    adrp x0, nil_str
    add x0, x0, :lo12:nil_str
    bl print_string
    ldp x29, x30, [sp], 16
    ret

print_float:
    // s0 contains float
    stp x29, x30, [sp, -64]!
    mov x29, sp
    stp x19, x20, [sp, 16]
    str d8, [sp, 32]
    
    fmov s8, s0
    
    // Print sign if negative
    fcmp s8, #0.0
    b.ge .L_print_float_positive
    mov w0, '-'
    bl print_rune
    fneg s8, s8
    
.L_print_float_positive:
    // Integer part
    fcvtzs x0, s8
    bl print_int
    
    // Fractional part
    fcvtzs x0, s8
    scvtf s1, x0
    fsub s8, s8, s1 // s8 = fractional part
    
    // If fractional part is very small, don't print anything else
    adrp x3, f_eps
    add x3, x3, :lo12:f_eps
    ldr s1, [x3]
    fcmp s8, s1
    b.lt .L_print_float_end
    
    // Decimal point
    mov w0, '.'
    bl print_rune
    
    mov x19, 7 // Max 7 decimal places
.L_print_float_loop:
    adrp x3, f_eps
    add x3, x3, :lo12:f_eps
    ldr s1, [x3]
    fcmp s8, s1
    b.lt .L_print_float_end
    cbz x19, .L_print_float_end
    
    // Multiply by 10
    adrp x3, f_10
    add x3, x3, :lo12:f_10
    ldr s1, [x3]
    fmul s8, s8, s1
    
    // Extract digit
    fcvtzs x0, s8
    add w0, w0, '0'
    bl print_rune
    
    // Subtract digit to get new fractional part
    fcvtzs x0, s8
    scvtf s1, x0
    fsub s8, s8, s1
    
    sub x19, x19, 1
    b .L_print_float_loop
    
.L_print_float_end:
    ldr d8, [sp, 32]
    ldp x19, x20, [sp, 16]
    ldp x29, x30, [sp], 64
    ret

print_rune:
    // x0 has rune (char)
    stp x29, x30, [sp, -32]!
    adrp x1, int_buffer
    add x1, x1, :lo12:int_buffer
    strb w0, [x1]
    mov x0, 1
    mov x2, 1
    mov x8, 64
    svc 0
    ldp x29, x30, [sp], 32
    ret

substr_copy:
    // x0: src, x1: start, x2: len
    stp x29, x30, [sp, -32]!
    add x0, x0, x1 // move to start
    adrp x1, substr_buffer
    add x1, x1, :lo12:substr_buffer
    mov x3, 0
.L_substr_loop:
    cbz x2, .L_substr_done
    ldrb w4, [x0, x3]
    cbz w4, .L_substr_done
    strb w4, [x1, x3]
    add x3, x3, 1
    sub x2, x2, 1
    b .L_substr_loop
.L_substr_done:
    mov w4, 0
    strb w4, [x1, x3] // null terminator
    mov x0, x1 // return buffer addr
    ldp x29, x30, [sp], 32
    ret
";
    }
}
