grammar Golampi;

// Lexer Rules

// Keywords
VAR: 'var';
CONST: 'const';
INT32: 'int32';
FLOAT32: 'float32';
BOOL: 'bool';
RUNE: 'rune';
STRING: 'string';
IF: 'if';
ELSE: 'else';
SWITCH: 'switch';
CASE: 'case';
DEFAULT: 'default';
FOR: 'for';
BREAK: 'break';
CONTINUE: 'continue';
RETURN: 'return';
FUNC: 'func';
NIL: 'nil';

// Embedded functions
FMT_PRINTLN: 'fmt.Println';
LEN: 'len';
NOW: 'now';
SUBSTR: 'substr';
TYPEOF: 'typeOf';

// Boolean Literals
TRUE: 'true';
FALSE: 'false';

// Operators and punctuation
ASSIGN: '=';
DECL_ASSIGN: ':=';
PLUS_ASSIGN: '+=';
MINUS_ASSIGN: '-=';
MULT_ASSIGN: '*=';
DIV_ASSIGN: '/=';
PLUS: '+';
MINUS: '-';
MULT: '*';
DIV: '/';
MOD: '%';
INC: '++';
DEC: '--';

EQ: '==';
NEQ: '!=';
GT: '>';
GTE: '>=';
LT: '<';
LTE: '<=';

AND: '&&';
OR: '||';
NOT: '!';

LPAREN: '(';
RPAREN: ')';
LBRACE: '{';
RBRACE: '}';
LBRACK: '[';
RBRACK: ']';
COMMA: ',';
COLON: ':';
SEMI: ';';
REF: '&';

// Literals
ID: [a-zA-Z_] [a-zA-Z_0-9]*;
FLOAT_LIT: [0-9]+ '.' [0-9]+;
INT_LIT: [0-9]+;
STRING_LIT: '"' (~["\\] | '\\' .)* '"';
RUNE_LIT: '\'' (~['\\] | '\\' .) '\'';

// Ignored
WS: [ \t\r\n]+ -> skip;
LINE_COMMENT: '//' ~[\r\n]* -> skip;
BLOCK_COMMENT: '/*' .*? '*/' -> skip;

// Parser Rules

program: EOF | declarations;

declarations: declaration+;

declaration
    : varDecl
    | constDecl
    | funcDecl
    | statement
    ;

varDecl
    : VAR idList type ('=' expList)?
    | VAR idList arraySizes type ('=' arrayLiteral)?
    | idList DECL_ASSIGN expList
    ;

constDecl
    : CONST ID type '=' expression
    ;

type
    : INT32 | FLOAT32 | BOOL | RUNE | STRING
    | MULT type
    ;

arraySizes
    : ('[' expression ']')+
    ;

idList
    : ID (COMMA ID)*
    ;

expList
    : expression (COMMA expression)*
    ;

funcDecl
    : FUNC ID LPAREN paramList? RPAREN returnType? block
    ;

paramList
    : param (COMMA param)*
    ;

param
    : ID type
    ;

returnType
    : type
    | LPAREN type (COMMA type)* RPAREN
    ;

block
    : LBRACE statement* RBRACE
    ;

statement
    : varDecl
    | constDecl
    | assignment
    | incDecStmt
    | ifStmt
    | switchStmt
    | forStmt
    | breakStmt
    | continueStmt
    | returnStmt
    | funcCallStmt
    | block
    ;

assignment
    : exprList assignOp expList
    ;

assignOp
    : ASSIGN | PLUS_ASSIGN | MINUS_ASSIGN | MULT_ASSIGN | DIV_ASSIGN
    ;

exprList
    : expression (COMMA expression)*
    ;

incDecStmt
    : expression (INC | DEC)
    ;

ifStmt
    : IF expression block (ELSE (ifStmt | block))?
    ;

switchStmt
    : SWITCH expression LBRACE switchCase* switchDefault? RBRACE
    ;

switchCase
    : CASE expList COLON statement*
    ;

switchDefault
    : DEFAULT COLON statement*
    ;

forStmt
    : FOR varDecl? SEMI expression? SEMI incDecStmt? block // Classic for
    | FOR expression block // While-like for
    | FOR block // Infinite for
    ;

breakStmt: BREAK;
continueStmt: CONTINUE;
returnStmt: RETURN expList?;

funcCallStmt
    : expression LPAREN expList? RPAREN
    | builtinCall
    ;

builtinCall
    : FMT_PRINTLN LPAREN expList? RPAREN
    | LEN LPAREN expression RPAREN
    | NOW LPAREN RPAREN
    | SUBSTR LPAREN expression COMMA expression COMMA expression RPAREN
    | TYPEOF LPAREN expression RPAREN
    ;

expression
    : LPAREN expression RPAREN #parenExpr
    | builtinCall #builtinExpr
    | expression LPAREN expList? RPAREN #callExpr
    | expression ('[' expression ']')+ #indexExpr
    | NOT expression #unaryExpr
    | MINUS expression #unaryExpr
    | expression (MULT | DIV | MOD) expression #mulDivExpr
    | expression (PLUS | MINUS) expression #addSubExpr
    | expression (GT | GTE | LT | LTE) expression #relationalExpr
    | expression (EQ | NEQ) expression #equalityExpr
    | expression AND expression #andExpr
    | expression OR expression #orExpr
    | REF expression #refExpr
    | MULT expression #derefExpr
    | INT_LIT #intExpr
    | FLOAT_LIT #floatExpr
    | STRING_LIT #stringExpr
    | RUNE_LIT #runeExpr
    | TRUE #boolExpr
    | FALSE #boolExpr
    | NIL #nilExpr
    | ID #idExpr
    | arrayLiteral #arrayLitExpr
    ;

arrayLiteral
    : type? LBRACE (expression (COMMA expression)*)? RBRACE
    | arraySizes type LBRACE (arrayLiteral (COMMA arrayLiteral)*)? RBRACE
    ;
