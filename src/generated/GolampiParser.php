<?php

/*
 * Generated from grammar/Golampi.g4 by ANTLR 4.13.1
 */

namespace Golampi {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class GolampiParser extends Parser
	{
		public const VAR = 1, CONST = 2, INT32 = 3, FLOAT32 = 4, BOOL = 5, RUNE = 6, 
               STRING = 7, IF = 8, ELSE = 9, SWITCH = 10, CASE = 11, DEFAULT = 12, 
               FOR = 13, BREAK = 14, CONTINUE = 15, RETURN = 16, FUNC = 17, 
               NIL = 18, FMT_PRINTLN = 19, LEN = 20, NOW = 21, SUBSTR = 22, 
               TYPEOF = 23, TRUE = 24, FALSE = 25, ASSIGN = 26, DECL_ASSIGN = 27, 
               PLUS_ASSIGN = 28, MINUS_ASSIGN = 29, MULT_ASSIGN = 30, DIV_ASSIGN = 31, 
               PLUS = 32, MINUS = 33, MULT = 34, DIV = 35, MOD = 36, INC = 37, 
               DEC = 38, EQ = 39, NEQ = 40, GT = 41, GTE = 42, LT = 43, 
               LTE = 44, AND = 45, OR = 46, NOT = 47, LPAREN = 48, RPAREN = 49, 
               LBRACE = 50, RBRACE = 51, LBRACK = 52, RBRACK = 53, COMMA = 54, 
               COLON = 55, SEMI = 56, REF = 57, ID = 58, FLOAT_LIT = 59, 
               INT_LIT = 60, STRING_LIT = 61, RUNE_LIT = 62, WS = 63, LINE_COMMENT = 64, 
               BLOCK_COMMENT = 65;

		public const RULE_program = 0, RULE_declarations = 1, RULE_declaration = 2, 
               RULE_varDecl = 3, RULE_constDecl = 4, RULE_type = 5, RULE_arraySizes = 6, 
               RULE_idList = 7, RULE_expList = 8, RULE_funcDecl = 9, RULE_paramList = 10, 
               RULE_param = 11, RULE_returnType = 12, RULE_block = 13, RULE_statement = 14, 
               RULE_assignment = 15, RULE_assignOp = 16, RULE_exprList = 17, 
               RULE_incDecStmt = 18, RULE_ifStmt = 19, RULE_switchStmt = 20, 
               RULE_switchCase = 21, RULE_switchDefault = 22, RULE_forStmt = 23, 
               RULE_breakStmt = 24, RULE_continueStmt = 25, RULE_returnStmt = 26, 
               RULE_funcCallStmt = 27, RULE_builtinCall = 28, RULE_expression = 29, 
               RULE_arrayLiteral = 30;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'program', 'declarations', 'declaration', 'varDecl', 'constDecl', 'type', 
			'arraySizes', 'idList', 'expList', 'funcDecl', 'paramList', 'param', 
			'returnType', 'block', 'statement', 'assignment', 'assignOp', 'exprList', 
			'incDecStmt', 'ifStmt', 'switchStmt', 'switchCase', 'switchDefault', 
			'forStmt', 'breakStmt', 'continueStmt', 'returnStmt', 'funcCallStmt', 
			'builtinCall', 'expression', 'arrayLiteral'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'var'", "'const'", "'int32'", "'float32'", "'bool'", "'rune'", 
		    "'string'", "'if'", "'else'", "'switch'", "'case'", "'default'", "'for'", 
		    "'break'", "'continue'", "'return'", "'func'", "'nil'", "'fmt.Println'", 
		    "'len'", "'now'", "'substr'", "'typeOf'", "'true'", "'false'", "'='", 
		    "':='", "'+='", "'-='", "'*='", "'/='", "'+'", "'-'", "'*'", "'/'", 
		    "'%'", "'++'", "'--'", "'=='", "'!='", "'>'", "'>='", "'<'", "'<='", 
		    "'&&'", "'||'", "'!'", "'('", "')'", "'{'", "'}'", "'['", "']'", "','", 
		    "':'", "';'", "'&'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, "VAR", "CONST", "INT32", "FLOAT32", "BOOL", "RUNE", "STRING", 
		    "IF", "ELSE", "SWITCH", "CASE", "DEFAULT", "FOR", "BREAK", "CONTINUE", 
		    "RETURN", "FUNC", "NIL", "FMT_PRINTLN", "LEN", "NOW", "SUBSTR", "TYPEOF", 
		    "TRUE", "FALSE", "ASSIGN", "DECL_ASSIGN", "PLUS_ASSIGN", "MINUS_ASSIGN", 
		    "MULT_ASSIGN", "DIV_ASSIGN", "PLUS", "MINUS", "MULT", "DIV", "MOD", 
		    "INC", "DEC", "EQ", "NEQ", "GT", "GTE", "LT", "LTE", "AND", "OR", 
		    "NOT", "LPAREN", "RPAREN", "LBRACE", "RBRACE", "LBRACK", "RBRACK", 
		    "COMMA", "COLON", "SEMI", "REF", "ID", "FLOAT_LIT", "INT_LIT", "STRING_LIT", 
		    "RUNE_LIT", "WS", "LINE_COMMENT", "BLOCK_COMMENT"
		];

		private const SERIALIZED_ATN =
			[4, 1, 65, 420, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 1, 0, 1, 0, 3, 0, 65, 8, 0, 1, 1, 4, 1, 
		    68, 8, 1, 11, 1, 12, 1, 69, 1, 2, 1, 2, 1, 2, 1, 2, 3, 2, 76, 8, 2, 
		    1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 3, 3, 83, 8, 3, 1, 3, 1, 3, 1, 3, 1, 
		    3, 1, 3, 1, 3, 3, 3, 91, 8, 3, 1, 3, 1, 3, 1, 3, 1, 3, 3, 3, 97, 8, 
		    3, 1, 4, 1, 4, 1, 4, 1, 4, 1, 4, 1, 4, 1, 5, 1, 5, 1, 5, 1, 5, 1, 
		    5, 1, 5, 1, 5, 3, 5, 112, 8, 5, 1, 6, 1, 6, 1, 6, 1, 6, 4, 6, 118, 
		    8, 6, 11, 6, 12, 6, 119, 1, 7, 1, 7, 1, 7, 5, 7, 125, 8, 7, 10, 7, 
		    12, 7, 128, 9, 7, 1, 8, 1, 8, 1, 8, 5, 8, 133, 8, 8, 10, 8, 12, 8, 
		    136, 9, 8, 1, 9, 1, 9, 1, 9, 1, 9, 3, 9, 142, 8, 9, 1, 9, 1, 9, 3, 
		    9, 146, 8, 9, 1, 9, 1, 9, 1, 10, 1, 10, 1, 10, 5, 10, 153, 8, 10, 
		    10, 10, 12, 10, 156, 9, 10, 1, 11, 1, 11, 1, 11, 1, 12, 1, 12, 1, 
		    12, 1, 12, 1, 12, 5, 12, 166, 8, 12, 10, 12, 12, 12, 169, 9, 12, 1, 
		    12, 1, 12, 3, 12, 173, 8, 12, 1, 13, 1, 13, 5, 13, 177, 8, 13, 10, 
		    13, 12, 13, 180, 9, 13, 1, 13, 1, 13, 1, 14, 1, 14, 1, 14, 1, 14, 
		    1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 3, 14, 196, 
		    8, 14, 1, 15, 1, 15, 1, 15, 1, 15, 1, 16, 1, 16, 1, 17, 1, 17, 1, 
		    17, 5, 17, 207, 8, 17, 10, 17, 12, 17, 210, 9, 17, 1, 18, 1, 18, 1, 
		    18, 1, 19, 1, 19, 1, 19, 1, 19, 1, 19, 1, 19, 3, 19, 221, 8, 19, 3, 
		    19, 223, 8, 19, 1, 20, 1, 20, 1, 20, 1, 20, 5, 20, 229, 8, 20, 10, 
		    20, 12, 20, 232, 9, 20, 1, 20, 3, 20, 235, 8, 20, 1, 20, 1, 20, 1, 
		    21, 1, 21, 1, 21, 1, 21, 5, 21, 243, 8, 21, 10, 21, 12, 21, 246, 9, 
		    21, 1, 22, 1, 22, 1, 22, 5, 22, 251, 8, 22, 10, 22, 12, 22, 254, 9, 
		    22, 1, 23, 1, 23, 3, 23, 258, 8, 23, 1, 23, 1, 23, 3, 23, 262, 8, 
		    23, 1, 23, 1, 23, 3, 23, 266, 8, 23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 
		    23, 1, 23, 1, 23, 3, 23, 275, 8, 23, 1, 24, 1, 24, 1, 25, 1, 25, 1, 
		    26, 1, 26, 3, 26, 283, 8, 26, 1, 27, 1, 27, 1, 27, 3, 27, 288, 8, 
		    27, 1, 27, 1, 27, 1, 27, 3, 27, 293, 8, 27, 1, 28, 1, 28, 1, 28, 3, 
		    28, 298, 8, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 
		    28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 
		    1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 1, 28, 3, 28, 323, 8, 28, 1, 29, 
		    1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 
		    29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 
		    1, 29, 1, 29, 1, 29, 3, 29, 348, 8, 29, 1, 29, 1, 29, 1, 29, 1, 29, 
		    1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 
		    29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 3, 29, 371, 8, 
		    29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 4, 29, 379, 8, 29, 11, 
		    29, 12, 29, 380, 5, 29, 383, 8, 29, 10, 29, 12, 29, 386, 9, 29, 1, 
		    30, 3, 30, 389, 8, 30, 1, 30, 1, 30, 1, 30, 1, 30, 5, 30, 395, 8, 
		    30, 10, 30, 12, 30, 398, 9, 30, 3, 30, 400, 8, 30, 1, 30, 1, 30, 1, 
		    30, 1, 30, 1, 30, 1, 30, 1, 30, 5, 30, 409, 8, 30, 10, 30, 12, 30, 
		    412, 9, 30, 3, 30, 414, 8, 30, 1, 30, 1, 30, 3, 30, 418, 8, 30, 1, 
		    30, 0, 1, 58, 31, 0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 
		    28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 
		    0, 6, 2, 0, 26, 26, 28, 31, 1, 0, 37, 38, 1, 0, 34, 36, 1, 0, 32, 
		    33, 1, 0, 41, 44, 1, 0, 39, 40, 472, 0, 64, 1, 0, 0, 0, 2, 67, 1, 
		    0, 0, 0, 4, 75, 1, 0, 0, 0, 6, 96, 1, 0, 0, 0, 8, 98, 1, 0, 0, 0, 
		    10, 111, 1, 0, 0, 0, 12, 117, 1, 0, 0, 0, 14, 121, 1, 0, 0, 0, 16, 
		    129, 1, 0, 0, 0, 18, 137, 1, 0, 0, 0, 20, 149, 1, 0, 0, 0, 22, 157, 
		    1, 0, 0, 0, 24, 172, 1, 0, 0, 0, 26, 174, 1, 0, 0, 0, 28, 195, 1, 
		    0, 0, 0, 30, 197, 1, 0, 0, 0, 32, 201, 1, 0, 0, 0, 34, 203, 1, 0, 
		    0, 0, 36, 211, 1, 0, 0, 0, 38, 214, 1, 0, 0, 0, 40, 224, 1, 0, 0, 
		    0, 42, 238, 1, 0, 0, 0, 44, 247, 1, 0, 0, 0, 46, 274, 1, 0, 0, 0, 
		    48, 276, 1, 0, 0, 0, 50, 278, 1, 0, 0, 0, 52, 280, 1, 0, 0, 0, 54, 
		    292, 1, 0, 0, 0, 56, 322, 1, 0, 0, 0, 58, 347, 1, 0, 0, 0, 60, 417, 
		    1, 0, 0, 0, 62, 65, 5, 0, 0, 1, 63, 65, 3, 2, 1, 0, 64, 62, 1, 0, 
		    0, 0, 64, 63, 1, 0, 0, 0, 65, 1, 1, 0, 0, 0, 66, 68, 3, 4, 2, 0, 67, 
		    66, 1, 0, 0, 0, 68, 69, 1, 0, 0, 0, 69, 67, 1, 0, 0, 0, 69, 70, 1, 
		    0, 0, 0, 70, 3, 1, 0, 0, 0, 71, 76, 3, 6, 3, 0, 72, 76, 3, 8, 4, 0, 
		    73, 76, 3, 18, 9, 0, 74, 76, 3, 28, 14, 0, 75, 71, 1, 0, 0, 0, 75, 
		    72, 1, 0, 0, 0, 75, 73, 1, 0, 0, 0, 75, 74, 1, 0, 0, 0, 76, 5, 1, 
		    0, 0, 0, 77, 78, 5, 1, 0, 0, 78, 79, 3, 14, 7, 0, 79, 82, 3, 10, 5, 
		    0, 80, 81, 5, 26, 0, 0, 81, 83, 3, 16, 8, 0, 82, 80, 1, 0, 0, 0, 82, 
		    83, 1, 0, 0, 0, 83, 97, 1, 0, 0, 0, 84, 85, 5, 1, 0, 0, 85, 86, 3, 
		    14, 7, 0, 86, 87, 3, 12, 6, 0, 87, 90, 3, 10, 5, 0, 88, 89, 5, 26, 
		    0, 0, 89, 91, 3, 60, 30, 0, 90, 88, 1, 0, 0, 0, 90, 91, 1, 0, 0, 0, 
		    91, 97, 1, 0, 0, 0, 92, 93, 3, 14, 7, 0, 93, 94, 5, 27, 0, 0, 94, 
		    95, 3, 16, 8, 0, 95, 97, 1, 0, 0, 0, 96, 77, 1, 0, 0, 0, 96, 84, 1, 
		    0, 0, 0, 96, 92, 1, 0, 0, 0, 97, 7, 1, 0, 0, 0, 98, 99, 5, 2, 0, 0, 
		    99, 100, 5, 58, 0, 0, 100, 101, 3, 10, 5, 0, 101, 102, 5, 26, 0, 0, 
		    102, 103, 3, 58, 29, 0, 103, 9, 1, 0, 0, 0, 104, 112, 5, 3, 0, 0, 
		    105, 112, 5, 4, 0, 0, 106, 112, 5, 5, 0, 0, 107, 112, 5, 6, 0, 0, 
		    108, 112, 5, 7, 0, 0, 109, 110, 5, 34, 0, 0, 110, 112, 3, 10, 5, 0, 
		    111, 104, 1, 0, 0, 0, 111, 105, 1, 0, 0, 0, 111, 106, 1, 0, 0, 0, 
		    111, 107, 1, 0, 0, 0, 111, 108, 1, 0, 0, 0, 111, 109, 1, 0, 0, 0, 
		    112, 11, 1, 0, 0, 0, 113, 114, 5, 52, 0, 0, 114, 115, 3, 58, 29, 0, 
		    115, 116, 5, 53, 0, 0, 116, 118, 1, 0, 0, 0, 117, 113, 1, 0, 0, 0, 
		    118, 119, 1, 0, 0, 0, 119, 117, 1, 0, 0, 0, 119, 120, 1, 0, 0, 0, 
		    120, 13, 1, 0, 0, 0, 121, 126, 5, 58, 0, 0, 122, 123, 5, 54, 0, 0, 
		    123, 125, 5, 58, 0, 0, 124, 122, 1, 0, 0, 0, 125, 128, 1, 0, 0, 0, 
		    126, 124, 1, 0, 0, 0, 126, 127, 1, 0, 0, 0, 127, 15, 1, 0, 0, 0, 128, 
		    126, 1, 0, 0, 0, 129, 134, 3, 58, 29, 0, 130, 131, 5, 54, 0, 0, 131, 
		    133, 3, 58, 29, 0, 132, 130, 1, 0, 0, 0, 133, 136, 1, 0, 0, 0, 134, 
		    132, 1, 0, 0, 0, 134, 135, 1, 0, 0, 0, 135, 17, 1, 0, 0, 0, 136, 134, 
		    1, 0, 0, 0, 137, 138, 5, 17, 0, 0, 138, 139, 5, 58, 0, 0, 139, 141, 
		    5, 48, 0, 0, 140, 142, 3, 20, 10, 0, 141, 140, 1, 0, 0, 0, 141, 142, 
		    1, 0, 0, 0, 142, 143, 1, 0, 0, 0, 143, 145, 5, 49, 0, 0, 144, 146, 
		    3, 24, 12, 0, 145, 144, 1, 0, 0, 0, 145, 146, 1, 0, 0, 0, 146, 147, 
		    1, 0, 0, 0, 147, 148, 3, 26, 13, 0, 148, 19, 1, 0, 0, 0, 149, 154, 
		    3, 22, 11, 0, 150, 151, 5, 54, 0, 0, 151, 153, 3, 22, 11, 0, 152, 
		    150, 1, 0, 0, 0, 153, 156, 1, 0, 0, 0, 154, 152, 1, 0, 0, 0, 154, 
		    155, 1, 0, 0, 0, 155, 21, 1, 0, 0, 0, 156, 154, 1, 0, 0, 0, 157, 158, 
		    5, 58, 0, 0, 158, 159, 3, 10, 5, 0, 159, 23, 1, 0, 0, 0, 160, 173, 
		    3, 10, 5, 0, 161, 162, 5, 48, 0, 0, 162, 167, 3, 10, 5, 0, 163, 164, 
		    5, 54, 0, 0, 164, 166, 3, 10, 5, 0, 165, 163, 1, 0, 0, 0, 166, 169, 
		    1, 0, 0, 0, 167, 165, 1, 0, 0, 0, 167, 168, 1, 0, 0, 0, 168, 170, 
		    1, 0, 0, 0, 169, 167, 1, 0, 0, 0, 170, 171, 5, 49, 0, 0, 171, 173, 
		    1, 0, 0, 0, 172, 160, 1, 0, 0, 0, 172, 161, 1, 0, 0, 0, 173, 25, 1, 
		    0, 0, 0, 174, 178, 5, 50, 0, 0, 175, 177, 3, 28, 14, 0, 176, 175, 
		    1, 0, 0, 0, 177, 180, 1, 0, 0, 0, 178, 176, 1, 0, 0, 0, 178, 179, 
		    1, 0, 0, 0, 179, 181, 1, 0, 0, 0, 180, 178, 1, 0, 0, 0, 181, 182, 
		    5, 51, 0, 0, 182, 27, 1, 0, 0, 0, 183, 196, 3, 6, 3, 0, 184, 196, 
		    3, 8, 4, 0, 185, 196, 3, 30, 15, 0, 186, 196, 3, 36, 18, 0, 187, 196, 
		    3, 38, 19, 0, 188, 196, 3, 40, 20, 0, 189, 196, 3, 46, 23, 0, 190, 
		    196, 3, 48, 24, 0, 191, 196, 3, 50, 25, 0, 192, 196, 3, 52, 26, 0, 
		    193, 196, 3, 54, 27, 0, 194, 196, 3, 26, 13, 0, 195, 183, 1, 0, 0, 
		    0, 195, 184, 1, 0, 0, 0, 195, 185, 1, 0, 0, 0, 195, 186, 1, 0, 0, 
		    0, 195, 187, 1, 0, 0, 0, 195, 188, 1, 0, 0, 0, 195, 189, 1, 0, 0, 
		    0, 195, 190, 1, 0, 0, 0, 195, 191, 1, 0, 0, 0, 195, 192, 1, 0, 0, 
		    0, 195, 193, 1, 0, 0, 0, 195, 194, 1, 0, 0, 0, 196, 29, 1, 0, 0, 0, 
		    197, 198, 3, 34, 17, 0, 198, 199, 3, 32, 16, 0, 199, 200, 3, 16, 8, 
		    0, 200, 31, 1, 0, 0, 0, 201, 202, 7, 0, 0, 0, 202, 33, 1, 0, 0, 0, 
		    203, 208, 3, 58, 29, 0, 204, 205, 5, 54, 0, 0, 205, 207, 3, 58, 29, 
		    0, 206, 204, 1, 0, 0, 0, 207, 210, 1, 0, 0, 0, 208, 206, 1, 0, 0, 
		    0, 208, 209, 1, 0, 0, 0, 209, 35, 1, 0, 0, 0, 210, 208, 1, 0, 0, 0, 
		    211, 212, 3, 58, 29, 0, 212, 213, 7, 1, 0, 0, 213, 37, 1, 0, 0, 0, 
		    214, 215, 5, 8, 0, 0, 215, 216, 3, 58, 29, 0, 216, 222, 3, 26, 13, 
		    0, 217, 220, 5, 9, 0, 0, 218, 221, 3, 38, 19, 0, 219, 221, 3, 26, 
		    13, 0, 220, 218, 1, 0, 0, 0, 220, 219, 1, 0, 0, 0, 221, 223, 1, 0, 
		    0, 0, 222, 217, 1, 0, 0, 0, 222, 223, 1, 0, 0, 0, 223, 39, 1, 0, 0, 
		    0, 224, 225, 5, 10, 0, 0, 225, 226, 3, 58, 29, 0, 226, 230, 5, 50, 
		    0, 0, 227, 229, 3, 42, 21, 0, 228, 227, 1, 0, 0, 0, 229, 232, 1, 0, 
		    0, 0, 230, 228, 1, 0, 0, 0, 230, 231, 1, 0, 0, 0, 231, 234, 1, 0, 
		    0, 0, 232, 230, 1, 0, 0, 0, 233, 235, 3, 44, 22, 0, 234, 233, 1, 0, 
		    0, 0, 234, 235, 1, 0, 0, 0, 235, 236, 1, 0, 0, 0, 236, 237, 5, 51, 
		    0, 0, 237, 41, 1, 0, 0, 0, 238, 239, 5, 11, 0, 0, 239, 240, 3, 16, 
		    8, 0, 240, 244, 5, 55, 0, 0, 241, 243, 3, 28, 14, 0, 242, 241, 1, 
		    0, 0, 0, 243, 246, 1, 0, 0, 0, 244, 242, 1, 0, 0, 0, 244, 245, 1, 
		    0, 0, 0, 245, 43, 1, 0, 0, 0, 246, 244, 1, 0, 0, 0, 247, 248, 5, 12, 
		    0, 0, 248, 252, 5, 55, 0, 0, 249, 251, 3, 28, 14, 0, 250, 249, 1, 
		    0, 0, 0, 251, 254, 1, 0, 0, 0, 252, 250, 1, 0, 0, 0, 252, 253, 1, 
		    0, 0, 0, 253, 45, 1, 0, 0, 0, 254, 252, 1, 0, 0, 0, 255, 257, 5, 13, 
		    0, 0, 256, 258, 3, 6, 3, 0, 257, 256, 1, 0, 0, 0, 257, 258, 1, 0, 
		    0, 0, 258, 259, 1, 0, 0, 0, 259, 261, 5, 56, 0, 0, 260, 262, 3, 58, 
		    29, 0, 261, 260, 1, 0, 0, 0, 261, 262, 1, 0, 0, 0, 262, 263, 1, 0, 
		    0, 0, 263, 265, 5, 56, 0, 0, 264, 266, 3, 36, 18, 0, 265, 264, 1, 
		    0, 0, 0, 265, 266, 1, 0, 0, 0, 266, 267, 1, 0, 0, 0, 267, 275, 3, 
		    26, 13, 0, 268, 269, 5, 13, 0, 0, 269, 270, 3, 58, 29, 0, 270, 271, 
		    3, 26, 13, 0, 271, 275, 1, 0, 0, 0, 272, 273, 5, 13, 0, 0, 273, 275, 
		    3, 26, 13, 0, 274, 255, 1, 0, 0, 0, 274, 268, 1, 0, 0, 0, 274, 272, 
		    1, 0, 0, 0, 275, 47, 1, 0, 0, 0, 276, 277, 5, 14, 0, 0, 277, 49, 1, 
		    0, 0, 0, 278, 279, 5, 15, 0, 0, 279, 51, 1, 0, 0, 0, 280, 282, 5, 
		    16, 0, 0, 281, 283, 3, 16, 8, 0, 282, 281, 1, 0, 0, 0, 282, 283, 1, 
		    0, 0, 0, 283, 53, 1, 0, 0, 0, 284, 285, 3, 58, 29, 0, 285, 287, 5, 
		    48, 0, 0, 286, 288, 3, 16, 8, 0, 287, 286, 1, 0, 0, 0, 287, 288, 1, 
		    0, 0, 0, 288, 289, 1, 0, 0, 0, 289, 290, 5, 49, 0, 0, 290, 293, 1, 
		    0, 0, 0, 291, 293, 3, 56, 28, 0, 292, 284, 1, 0, 0, 0, 292, 291, 1, 
		    0, 0, 0, 293, 55, 1, 0, 0, 0, 294, 295, 5, 19, 0, 0, 295, 297, 5, 
		    48, 0, 0, 296, 298, 3, 16, 8, 0, 297, 296, 1, 0, 0, 0, 297, 298, 1, 
		    0, 0, 0, 298, 299, 1, 0, 0, 0, 299, 323, 5, 49, 0, 0, 300, 301, 5, 
		    20, 0, 0, 301, 302, 5, 48, 0, 0, 302, 303, 3, 58, 29, 0, 303, 304, 
		    5, 49, 0, 0, 304, 323, 1, 0, 0, 0, 305, 306, 5, 21, 0, 0, 306, 307, 
		    5, 48, 0, 0, 307, 323, 5, 49, 0, 0, 308, 309, 5, 22, 0, 0, 309, 310, 
		    5, 48, 0, 0, 310, 311, 3, 58, 29, 0, 311, 312, 5, 54, 0, 0, 312, 313, 
		    3, 58, 29, 0, 313, 314, 5, 54, 0, 0, 314, 315, 3, 58, 29, 0, 315, 
		    316, 5, 49, 0, 0, 316, 323, 1, 0, 0, 0, 317, 318, 5, 23, 0, 0, 318, 
		    319, 5, 48, 0, 0, 319, 320, 3, 58, 29, 0, 320, 321, 5, 49, 0, 0, 321, 
		    323, 1, 0, 0, 0, 322, 294, 1, 0, 0, 0, 322, 300, 1, 0, 0, 0, 322, 
		    305, 1, 0, 0, 0, 322, 308, 1, 0, 0, 0, 322, 317, 1, 0, 0, 0, 323, 
		    57, 1, 0, 0, 0, 324, 325, 6, 29, -1, 0, 325, 326, 5, 48, 0, 0, 326, 
		    327, 3, 58, 29, 0, 327, 328, 5, 49, 0, 0, 328, 348, 1, 0, 0, 0, 329, 
		    348, 3, 56, 28, 0, 330, 331, 5, 47, 0, 0, 331, 348, 3, 58, 29, 19, 
		    332, 333, 5, 33, 0, 0, 333, 348, 3, 58, 29, 18, 334, 335, 5, 57, 0, 
		    0, 335, 348, 3, 58, 29, 11, 336, 337, 5, 34, 0, 0, 337, 348, 3, 58, 
		    29, 10, 338, 348, 5, 60, 0, 0, 339, 348, 5, 59, 0, 0, 340, 348, 5, 
		    61, 0, 0, 341, 348, 5, 62, 0, 0, 342, 348, 5, 24, 0, 0, 343, 348, 
		    5, 25, 0, 0, 344, 348, 5, 18, 0, 0, 345, 348, 5, 58, 0, 0, 346, 348, 
		    3, 60, 30, 0, 347, 324, 1, 0, 0, 0, 347, 329, 1, 0, 0, 0, 347, 330, 
		    1, 0, 0, 0, 347, 332, 1, 0, 0, 0, 347, 334, 1, 0, 0, 0, 347, 336, 
		    1, 0, 0, 0, 347, 338, 1, 0, 0, 0, 347, 339, 1, 0, 0, 0, 347, 340, 
		    1, 0, 0, 0, 347, 341, 1, 0, 0, 0, 347, 342, 1, 0, 0, 0, 347, 343, 
		    1, 0, 0, 0, 347, 344, 1, 0, 0, 0, 347, 345, 1, 0, 0, 0, 347, 346, 
		    1, 0, 0, 0, 348, 384, 1, 0, 0, 0, 349, 350, 10, 17, 0, 0, 350, 351, 
		    7, 2, 0, 0, 351, 383, 3, 58, 29, 18, 352, 353, 10, 16, 0, 0, 353, 
		    354, 7, 3, 0, 0, 354, 383, 3, 58, 29, 17, 355, 356, 10, 15, 0, 0, 
		    356, 357, 7, 4, 0, 0, 357, 383, 3, 58, 29, 16, 358, 359, 10, 14, 0, 
		    0, 359, 360, 7, 5, 0, 0, 360, 383, 3, 58, 29, 15, 361, 362, 10, 13, 
		    0, 0, 362, 363, 5, 45, 0, 0, 363, 383, 3, 58, 29, 14, 364, 365, 10, 
		    12, 0, 0, 365, 366, 5, 46, 0, 0, 366, 383, 3, 58, 29, 13, 367, 368, 
		    10, 21, 0, 0, 368, 370, 5, 48, 0, 0, 369, 371, 3, 16, 8, 0, 370, 369, 
		    1, 0, 0, 0, 370, 371, 1, 0, 0, 0, 371, 372, 1, 0, 0, 0, 372, 383, 
		    5, 49, 0, 0, 373, 378, 10, 20, 0, 0, 374, 375, 5, 52, 0, 0, 375, 376, 
		    3, 58, 29, 0, 376, 377, 5, 53, 0, 0, 377, 379, 1, 0, 0, 0, 378, 374, 
		    1, 0, 0, 0, 379, 380, 1, 0, 0, 0, 380, 378, 1, 0, 0, 0, 380, 381, 
		    1, 0, 0, 0, 381, 383, 1, 0, 0, 0, 382, 349, 1, 0, 0, 0, 382, 352, 
		    1, 0, 0, 0, 382, 355, 1, 0, 0, 0, 382, 358, 1, 0, 0, 0, 382, 361, 
		    1, 0, 0, 0, 382, 364, 1, 0, 0, 0, 382, 367, 1, 0, 0, 0, 382, 373, 
		    1, 0, 0, 0, 383, 386, 1, 0, 0, 0, 384, 382, 1, 0, 0, 0, 384, 385, 
		    1, 0, 0, 0, 385, 59, 1, 0, 0, 0, 386, 384, 1, 0, 0, 0, 387, 389, 3, 
		    10, 5, 0, 388, 387, 1, 0, 0, 0, 388, 389, 1, 0, 0, 0, 389, 390, 1, 
		    0, 0, 0, 390, 399, 5, 50, 0, 0, 391, 396, 3, 58, 29, 0, 392, 393, 
		    5, 54, 0, 0, 393, 395, 3, 58, 29, 0, 394, 392, 1, 0, 0, 0, 395, 398, 
		    1, 0, 0, 0, 396, 394, 1, 0, 0, 0, 396, 397, 1, 0, 0, 0, 397, 400, 
		    1, 0, 0, 0, 398, 396, 1, 0, 0, 0, 399, 391, 1, 0, 0, 0, 399, 400, 
		    1, 0, 0, 0, 400, 401, 1, 0, 0, 0, 401, 418, 5, 51, 0, 0, 402, 403, 
		    3, 12, 6, 0, 403, 404, 3, 10, 5, 0, 404, 413, 5, 50, 0, 0, 405, 410, 
		    3, 60, 30, 0, 406, 407, 5, 54, 0, 0, 407, 409, 3, 60, 30, 0, 408, 
		    406, 1, 0, 0, 0, 409, 412, 1, 0, 0, 0, 410, 408, 1, 0, 0, 0, 410, 
		    411, 1, 0, 0, 0, 411, 414, 1, 0, 0, 0, 412, 410, 1, 0, 0, 0, 413, 
		    405, 1, 0, 0, 0, 413, 414, 1, 0, 0, 0, 414, 415, 1, 0, 0, 0, 415, 
		    416, 5, 51, 0, 0, 416, 418, 1, 0, 0, 0, 417, 388, 1, 0, 0, 0, 417, 
		    402, 1, 0, 0, 0, 418, 61, 1, 0, 0, 0, 44, 64, 69, 75, 82, 90, 96, 
		    111, 119, 126, 134, 141, 145, 154, 167, 172, 178, 195, 208, 220, 222, 
		    230, 234, 244, 252, 257, 261, 265, 274, 282, 287, 292, 297, 322, 347, 
		    370, 380, 382, 384, 388, 396, 399, 410, 413, 417];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.1', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "Golampi.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function program(): Context\ProgramContext
		{
		    $localContext = new Context\ProgramContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_program);

		    try {
		        $this->setState(64);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::EOF:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(62);
		            	$this->match(self::EOF);
		            	break;

		            case self::VAR:
		            case self::CONST:
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL:
		            case self::RUNE:
		            case self::STRING:
		            case self::IF:
		            case self::SWITCH:
		            case self::FOR:
		            case self::BREAK:
		            case self::CONTINUE:
		            case self::RETURN:
		            case self::FUNC:
		            case self::NIL:
		            case self::FMT_PRINTLN:
		            case self::LEN:
		            case self::NOW:
		            case self::SUBSTR:
		            case self::TYPEOF:
		            case self::TRUE:
		            case self::FALSE:
		            case self::MINUS:
		            case self::MULT:
		            case self::NOT:
		            case self::LPAREN:
		            case self::LBRACE:
		            case self::LBRACK:
		            case self::REF:
		            case self::ID:
		            case self::FLOAT_LIT:
		            case self::INT_LIT:
		            case self::STRING_LIT:
		            case self::RUNE_LIT:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(63);
		            	$this->declarations();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declarations(): Context\DeclarationsContext
		{
		    $localContext = new Context\DeclarationsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_declarations);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(67); 
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        do {
		        	$this->setState(66);
		        	$this->declaration();
		        	$this->setState(69); 
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        } while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586615105022) !== 0));
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaration(): Context\DeclarationContext
		{
		    $localContext = new Context\DeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_declaration);

		    try {
		        $this->setState(75);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 2, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(71);
		        	    $this->varDecl();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(72);
		        	    $this->constDecl();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(73);
		        	    $this->funcDecl();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(74);
		        	    $this->statement();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varDecl(): Context\VarDeclContext
		{
		    $localContext = new Context\VarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_varDecl);

		    try {
		        $this->setState(96);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 5, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(77);
		        	    $this->match(self::VAR);
		        	    $this->setState(78);
		        	    $this->idList();
		        	    $this->setState(79);
		        	    $this->type();
		        	    $this->setState(82);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::ASSIGN) {
		        	    	$this->setState(80);
		        	    	$this->match(self::ASSIGN);
		        	    	$this->setState(81);
		        	    	$this->expList();
		        	    }
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(84);
		        	    $this->match(self::VAR);
		        	    $this->setState(85);
		        	    $this->idList();
		        	    $this->setState(86);
		        	    $this->arraySizes();
		        	    $this->setState(87);
		        	    $this->type();
		        	    $this->setState(90);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::ASSIGN) {
		        	    	$this->setState(88);
		        	    	$this->match(self::ASSIGN);
		        	    	$this->setState(89);
		        	    	$this->arrayLiteral();
		        	    }
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(92);
		        	    $this->idList();
		        	    $this->setState(93);
		        	    $this->match(self::DECL_ASSIGN);
		        	    $this->setState(94);
		        	    $this->expList();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function constDecl(): Context\ConstDeclContext
		{
		    $localContext = new Context\ConstDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_constDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(98);
		        $this->match(self::CONST);
		        $this->setState(99);
		        $this->match(self::ID);
		        $this->setState(100);
		        $this->type();
		        $this->setState(101);
		        $this->match(self::ASSIGN);
		        $this->setState(102);
		        $this->recursiveExpression(0);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type(): Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_type);

		    try {
		        $this->setState(111);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT32:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(104);
		            	$this->match(self::INT32);
		            	break;

		            case self::FLOAT32:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(105);
		            	$this->match(self::FLOAT32);
		            	break;

		            case self::BOOL:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(106);
		            	$this->match(self::BOOL);
		            	break;

		            case self::RUNE:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(107);
		            	$this->match(self::RUNE);
		            	break;

		            case self::STRING:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(108);
		            	$this->match(self::STRING);
		            	break;

		            case self::MULT:
		            	$this->enterOuterAlt($localContext, 6);
		            	$this->setState(109);
		            	$this->match(self::MULT);
		            	$this->setState(110);
		            	$this->type();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arraySizes(): Context\ArraySizesContext
		{
		    $localContext = new Context\ArraySizesContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_arraySizes);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(117); 
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        do {
		        	$this->setState(113);
		        	$this->match(self::LBRACK);
		        	$this->setState(114);
		        	$this->recursiveExpression(0);
		        	$this->setState(115);
		        	$this->match(self::RBRACK);
		        	$this->setState(119); 
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        } while ($_la === self::LBRACK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function idList(): Context\IdListContext
		{
		    $localContext = new Context\IdListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_idList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(121);
		        $this->match(self::ID);
		        $this->setState(126);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(122);
		        	$this->match(self::COMMA);
		        	$this->setState(123);
		        	$this->match(self::ID);
		        	$this->setState(128);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expList(): Context\ExpListContext
		{
		    $localContext = new Context\ExpListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_expList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(129);
		        $this->recursiveExpression(0);
		        $this->setState(134);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(130);
		        	$this->match(self::COMMA);
		        	$this->setState(131);
		        	$this->recursiveExpression(0);
		        	$this->setState(136);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function funcDecl(): Context\FuncDeclContext
		{
		    $localContext = new Context\FuncDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_funcDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(137);
		        $this->match(self::FUNC);
		        $this->setState(138);
		        $this->match(self::ID);
		        $this->setState(139);
		        $this->match(self::LPAREN);
		        $this->setState(141);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ID) {
		        	$this->setState(140);
		        	$this->paramList();
		        }
		        $this->setState(143);
		        $this->match(self::RPAREN);
		        $this->setState(145);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 281492156580088) !== 0)) {
		        	$this->setState(144);
		        	$this->returnType();
		        }
		        $this->setState(147);
		        $this->block();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function paramList(): Context\ParamListContext
		{
		    $localContext = new Context\ParamListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_paramList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(149);
		        $this->param();
		        $this->setState(154);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(150);
		        	$this->match(self::COMMA);
		        	$this->setState(151);
		        	$this->param();
		        	$this->setState(156);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function param(): Context\ParamContext
		{
		    $localContext = new Context\ParamContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_param);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(157);
		        $this->match(self::ID);
		        $this->setState(158);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnType(): Context\ReturnTypeContext
		{
		    $localContext = new Context\ReturnTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_returnType);

		    try {
		        $this->setState(172);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL:
		            case self::RUNE:
		            case self::STRING:
		            case self::MULT:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(160);
		            	$this->type();
		            	break;

		            case self::LPAREN:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(161);
		            	$this->match(self::LPAREN);
		            	$this->setState(162);
		            	$this->type();
		            	$this->setState(167);
		            	$this->errorHandler->sync($this);

		            	$_la = $this->input->LA(1);
		            	while ($_la === self::COMMA) {
		            		$this->setState(163);
		            		$this->match(self::COMMA);
		            		$this->setState(164);
		            		$this->type();
		            		$this->setState(169);
		            		$this->errorHandler->sync($this);
		            		$_la = $this->input->LA(1);
		            	}
		            	$this->setState(170);
		            	$this->match(self::RPAREN);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block(): Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(174);
		        $this->match(self::LBRACE);
		        $this->setState(178);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586614973950) !== 0)) {
		        	$this->setState(175);
		        	$this->statement();
		        	$this->setState(180);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(181);
		        $this->match(self::RBRACE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statement(): Context\StatementContext
		{
		    $localContext = new Context\StatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_statement);

		    try {
		        $this->setState(195);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 16, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(183);
		        	    $this->varDecl();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(184);
		        	    $this->constDecl();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(185);
		        	    $this->assignment();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(186);
		        	    $this->incDecStmt();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(187);
		        	    $this->ifStmt();
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(188);
		        	    $this->switchStmt();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(189);
		        	    $this->forStmt();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(190);
		        	    $this->breakStmt();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(191);
		        	    $this->continueStmt();
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(192);
		        	    $this->returnStmt();
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(193);
		        	    $this->funcCallStmt();
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(194);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignment(): Context\AssignmentContext
		{
		    $localContext = new Context\AssignmentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_assignment);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(197);
		        $this->exprList();
		        $this->setState(198);
		        $this->assignOp();
		        $this->setState(199);
		        $this->expList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignOp(): Context\AssignOpContext
		{
		    $localContext = new Context\AssignOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_assignOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(201);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4093640704) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function exprList(): Context\ExprListContext
		{
		    $localContext = new Context\ExprListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_exprList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(203);
		        $this->recursiveExpression(0);
		        $this->setState(208);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(204);
		        	$this->match(self::COMMA);
		        	$this->setState(205);
		        	$this->recursiveExpression(0);
		        	$this->setState(210);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function incDecStmt(): Context\IncDecStmtContext
		{
		    $localContext = new Context\IncDecStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_incDecStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(211);
		        $this->recursiveExpression(0);
		        $this->setState(212);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::INC || $_la === self::DEC)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStmt(): Context\IfStmtContext
		{
		    $localContext = new Context\IfStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_ifStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(214);
		        $this->match(self::IF);
		        $this->setState(215);
		        $this->recursiveExpression(0);
		        $this->setState(216);
		        $this->block();
		        $this->setState(222);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(217);
		        	$this->match(self::ELSE);
		        	$this->setState(220);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::IF:
		        	    	$this->setState(218);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::LBRACE:
		        	    	$this->setState(219);
		        	    	$this->block();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchStmt(): Context\SwitchStmtContext
		{
		    $localContext = new Context\SwitchStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_switchStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(224);
		        $this->match(self::SWITCH);
		        $this->setState(225);
		        $this->recursiveExpression(0);
		        $this->setState(226);
		        $this->match(self::LBRACE);
		        $this->setState(230);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE) {
		        	$this->setState(227);
		        	$this->switchCase();
		        	$this->setState(232);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(234);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DEFAULT) {
		        	$this->setState(233);
		        	$this->switchDefault();
		        }
		        $this->setState(236);
		        $this->match(self::RBRACE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchCase(): Context\SwitchCaseContext
		{
		    $localContext = new Context\SwitchCaseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_switchCase);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(238);
		        $this->match(self::CASE);
		        $this->setState(239);
		        $this->expList();
		        $this->setState(240);
		        $this->match(self::COLON);
		        $this->setState(244);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586614973950) !== 0)) {
		        	$this->setState(241);
		        	$this->statement();
		        	$this->setState(246);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchDefault(): Context\SwitchDefaultContext
		{
		    $localContext = new Context\SwitchDefaultContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_switchDefault);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(247);
		        $this->match(self::DEFAULT);
		        $this->setState(248);
		        $this->match(self::COLON);
		        $this->setState(252);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586614973950) !== 0)) {
		        	$this->setState(249);
		        	$this->statement();
		        	$this->setState(254);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forStmt(): Context\ForStmtContext
		{
		    $localContext = new Context\ForStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_forStmt);

		    try {
		        $this->setState(274);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 27, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(255);
		        	    $this->match(self::FOR);
		        	    $this->setState(257);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::VAR || $_la === self::ID) {
		        	    	$this->setState(256);
		        	    	$this->varDecl();
		        	    }
		        	    $this->setState(259);
		        	    $this->match(self::SEMI);
		        	    $this->setState(261);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586614849784) !== 0)) {
		        	    	$this->setState(260);
		        	    	$this->recursiveExpression(0);
		        	    }
		        	    $this->setState(263);
		        	    $this->match(self::SEMI);
		        	    $this->setState(265);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 26, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(264);
		        	    	    $this->incDecStmt();
		        	    	break;
		        	    }
		        	    $this->setState(267);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(268);
		        	    $this->match(self::FOR);
		        	    $this->setState(269);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(270);
		        	    $this->block();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(272);
		        	    $this->match(self::FOR);
		        	    $this->setState(273);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function breakStmt(): Context\BreakStmtContext
		{
		    $localContext = new Context\BreakStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(276);
		        $this->match(self::BREAK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function continueStmt(): Context\ContinueStmtContext
		{
		    $localContext = new Context\ContinueStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(278);
		        $this->match(self::CONTINUE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnStmt(): Context\ReturnStmtContext
		{
		    $localContext = new Context\ReturnStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(280);
		        $this->match(self::RETURN);
		        $this->setState(282);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 28, $this->ctx)) {
		            case 1:
		        	    $this->setState(281);
		        	    $this->expList();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function funcCallStmt(): Context\FuncCallStmtContext
		{
		    $localContext = new Context\FuncCallStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_funcCallStmt);

		    try {
		        $this->setState(292);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 30, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(284);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(285);
		        	    $this->match(self::LPAREN);
		        	    $this->setState(287);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586614849784) !== 0)) {
		        	    	$this->setState(286);
		        	    	$this->expList();
		        	    }
		        	    $this->setState(289);
		        	    $this->match(self::RPAREN);
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(291);
		        	    $this->builtinCall();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function builtinCall(): Context\BuiltinCallContext
		{
		    $localContext = new Context\BuiltinCallContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_builtinCall);

		    try {
		        $this->setState(322);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::FMT_PRINTLN:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(294);
		            	$this->match(self::FMT_PRINTLN);
		            	$this->setState(295);
		            	$this->match(self::LPAREN);
		            	$this->setState(297);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586614849784) !== 0)) {
		            		$this->setState(296);
		            		$this->expList();
		            	}
		            	$this->setState(299);
		            	$this->match(self::RPAREN);
		            	break;

		            case self::LEN:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(300);
		            	$this->match(self::LEN);
		            	$this->setState(301);
		            	$this->match(self::LPAREN);
		            	$this->setState(302);
		            	$this->recursiveExpression(0);
		            	$this->setState(303);
		            	$this->match(self::RPAREN);
		            	break;

		            case self::NOW:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(305);
		            	$this->match(self::NOW);
		            	$this->setState(306);
		            	$this->match(self::LPAREN);
		            	$this->setState(307);
		            	$this->match(self::RPAREN);
		            	break;

		            case self::SUBSTR:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(308);
		            	$this->match(self::SUBSTR);
		            	$this->setState(309);
		            	$this->match(self::LPAREN);
		            	$this->setState(310);
		            	$this->recursiveExpression(0);
		            	$this->setState(311);
		            	$this->match(self::COMMA);
		            	$this->setState(312);
		            	$this->recursiveExpression(0);
		            	$this->setState(313);
		            	$this->match(self::COMMA);
		            	$this->setState(314);
		            	$this->recursiveExpression(0);
		            	$this->setState(315);
		            	$this->match(self::RPAREN);
		            	break;

		            case self::TYPEOF:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(317);
		            	$this->match(self::TYPEOF);
		            	$this->setState(318);
		            	$this->match(self::LPAREN);
		            	$this->setState(319);
		            	$this->recursiveExpression(0);
		            	$this->setState(320);
		            	$this->match(self::RPAREN);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expression(): Context\ExpressionContext
		{
			return $this->recursiveExpression(0);
		}

		/**
		 * @throws RecognitionException
		 */
		private function recursiveExpression(int $precedence): Context\ExpressionContext
		{
			$parentContext = $this->ctx;
			$parentState = $this->getState();
			$localContext = new Context\ExpressionContext($this->ctx, $parentState);
			$previousContext = $localContext;
			$startState = 58;
			$this->enterRecursionRule($localContext, 58, self::RULE_expression, $precedence);

			try {
				$this->enterOuterAlt($localContext, 1);
				$this->setState(347);
				$this->errorHandler->sync($this);

				switch ($this->getInterpreter()->adaptivePredict($this->input, 33, $this->ctx)) {
					case 1:
					    $localContext = new Context\ParenExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;

					    $this->setState(325);
					    $this->match(self::LPAREN);
					    $this->setState(326);
					    $this->recursiveExpression(0);
					    $this->setState(327);
					    $this->match(self::RPAREN);
					break;

					case 2:
					    $localContext = new Context\BuiltinExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(329);
					    $this->builtinCall();
					break;

					case 3:
					    $localContext = new Context\UnaryExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(330);
					    $this->match(self::NOT);
					    $this->setState(331);
					    $this->recursiveExpression(19);
					break;

					case 4:
					    $localContext = new Context\UnaryExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(332);
					    $this->match(self::MINUS);
					    $this->setState(333);
					    $this->recursiveExpression(18);
					break;

					case 5:
					    $localContext = new Context\RefExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(334);
					    $this->match(self::REF);
					    $this->setState(335);
					    $this->recursiveExpression(11);
					break;

					case 6:
					    $localContext = new Context\DerefExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(336);
					    $this->match(self::MULT);
					    $this->setState(337);
					    $this->recursiveExpression(10);
					break;

					case 7:
					    $localContext = new Context\IntExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(338);
					    $this->match(self::INT_LIT);
					break;

					case 8:
					    $localContext = new Context\FloatExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(339);
					    $this->match(self::FLOAT_LIT);
					break;

					case 9:
					    $localContext = new Context\StringExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(340);
					    $this->match(self::STRING_LIT);
					break;

					case 10:
					    $localContext = new Context\RuneExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(341);
					    $this->match(self::RUNE_LIT);
					break;

					case 11:
					    $localContext = new Context\BoolExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(342);
					    $this->match(self::TRUE);
					break;

					case 12:
					    $localContext = new Context\BoolExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(343);
					    $this->match(self::FALSE);
					break;

					case 13:
					    $localContext = new Context\NilExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(344);
					    $this->match(self::NIL);
					break;

					case 14:
					    $localContext = new Context\IdExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(345);
					    $this->match(self::ID);
					break;

					case 15:
					    $localContext = new Context\ArrayLitExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(346);
					    $this->arrayLiteral();
					break;
				}
				$this->ctx->stop = $this->input->LT(-1);
				$this->setState(384);
				$this->errorHandler->sync($this);

				$alt = $this->getInterpreter()->adaptivePredict($this->input, 37, $this->ctx);

				while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					if ($alt === 1) {
						if ($this->getParseListeners() !== null) {
						    $this->triggerExitRuleEvent();
						}

						$previousContext = $localContext;
						$this->setState(382);
						$this->errorHandler->sync($this);

						switch ($this->getInterpreter()->adaptivePredict($this->input, 36, $this->ctx)) {
							case 1:
							    $localContext = new Context\MulDivExprContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(349);

							    if (!($this->precpred($this->ctx, 17))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 17)");
							    }
							    $this->setState(350);

							    $_la = $this->input->LA(1);

							    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 120259084288) !== 0))) {
							    $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(351);
							    $this->recursiveExpression(18);
							break;

							case 2:
							    $localContext = new Context\AddSubExprContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(352);

							    if (!($this->precpred($this->ctx, 16))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 16)");
							    }
							    $this->setState(353);

							    $_la = $this->input->LA(1);

							    if (!($_la === self::PLUS || $_la === self::MINUS)) {
							    $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(354);
							    $this->recursiveExpression(17);
							break;

							case 3:
							    $localContext = new Context\RelationalExprContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(355);

							    if (!($this->precpred($this->ctx, 15))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 15)");
							    }
							    $this->setState(356);

							    $_la = $this->input->LA(1);

							    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 32985348833280) !== 0))) {
							    $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(357);
							    $this->recursiveExpression(16);
							break;

							case 4:
							    $localContext = new Context\EqualityExprContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(358);

							    if (!($this->precpred($this->ctx, 14))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 14)");
							    }
							    $this->setState(359);

							    $_la = $this->input->LA(1);

							    if (!($_la === self::EQ || $_la === self::NEQ)) {
							    $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(360);
							    $this->recursiveExpression(15);
							break;

							case 5:
							    $localContext = new Context\AndExprContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(361);

							    if (!($this->precpred($this->ctx, 13))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 13)");
							    }
							    $this->setState(362);
							    $this->match(self::AND);
							    $this->setState(363);
							    $this->recursiveExpression(14);
							break;

							case 6:
							    $localContext = new Context\OrExprContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(364);

							    if (!($this->precpred($this->ctx, 12))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 12)");
							    }
							    $this->setState(365);
							    $this->match(self::OR);
							    $this->setState(366);
							    $this->recursiveExpression(13);
							break;

							case 7:
							    $localContext = new Context\CallExprContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(367);

							    if (!($this->precpred($this->ctx, 21))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 21)");
							    }
							    $this->setState(368);
							    $this->match(self::LPAREN);
							    $this->setState(370);
							    $this->errorHandler->sync($this);
							    $_la = $this->input->LA(1);

							    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586614849784) !== 0)) {
							    	$this->setState(369);
							    	$this->expList();
							    }
							    $this->setState(372);
							    $this->match(self::RPAREN);
							break;

							case 8:
							    $localContext = new Context\IndexExprContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(373);

							    if (!($this->precpred($this->ctx, 20))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 20)");
							    }
							    $this->setState(378); 
							    $this->errorHandler->sync($this);

							    $alt = 1;

							    do {
							    	switch ($alt) {
							    	case 1:
							    		$this->setState(374);
							    		$this->match(self::LBRACK);
							    		$this->setState(375);
							    		$this->recursiveExpression(0);
							    		$this->setState(376);
							    		$this->match(self::RBRACK);
							    		break;
							    	default:
							    		throw new NoViableAltException($this);
							    	}

							    	$this->setState(380); 
							    	$this->errorHandler->sync($this);

							    	$alt = $this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx);
							    } while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER);
							break;
						} 
					}

					$this->setState(386);
					$this->errorHandler->sync($this);

					$alt = $this->getInterpreter()->adaptivePredict($this->input, 37, $this->ctx);
				}
			} catch (RecognitionException $exception) {
				$localContext->exception = $exception;
				$this->errorHandler->reportError($this, $exception);
				$this->errorHandler->recover($this, $exception);
			} finally {
				$this->unrollRecursionContexts($parentContext);
			}

			return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayLiteral(): Context\ArrayLiteralContext
		{
		    $localContext = new Context\ArrayLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_arrayLiteral);

		    try {
		        $this->setState(417);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL:
		            case self::RUNE:
		            case self::STRING:
		            case self::MULT:
		            case self::LBRACE:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(388);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 17179869432) !== 0)) {
		            		$this->setState(387);
		            		$this->type();
		            	}
		            	$this->setState(390);
		            	$this->match(self::LBRACE);
		            	$this->setState(399);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 9085308586614849784) !== 0)) {
		            		$this->setState(391);
		            		$this->recursiveExpression(0);
		            		$this->setState(396);
		            		$this->errorHandler->sync($this);

		            		$_la = $this->input->LA(1);
		            		while ($_la === self::COMMA) {
		            			$this->setState(392);
		            			$this->match(self::COMMA);
		            			$this->setState(393);
		            			$this->recursiveExpression(0);
		            			$this->setState(398);
		            			$this->errorHandler->sync($this);
		            			$_la = $this->input->LA(1);
		            		}
		            	}
		            	$this->setState(401);
		            	$this->match(self::RBRACE);
		            	break;

		            case self::LBRACK:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(402);
		            	$this->arraySizes();
		            	$this->setState(403);
		            	$this->type();
		            	$this->setState(404);
		            	$this->match(self::LBRACE);
		            	$this->setState(413);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 5629516714082552) !== 0)) {
		            		$this->setState(405);
		            		$this->arrayLiteral();
		            		$this->setState(410);
		            		$this->errorHandler->sync($this);

		            		$_la = $this->input->LA(1);
		            		while ($_la === self::COMMA) {
		            			$this->setState(406);
		            			$this->match(self::COMMA);
		            			$this->setState(407);
		            			$this->arrayLiteral();
		            			$this->setState(412);
		            			$this->errorHandler->sync($this);
		            			$_la = $this->input->LA(1);
		            		}
		            	}
		            	$this->setState(415);
		            	$this->match(self::RBRACE);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		public function sempred(?RuleContext $localContext, int $ruleIndex, int $predicateIndex): bool
		{
			switch ($ruleIndex) {
					case 29:
						return $this->sempredExpression($localContext, $predicateIndex);

				default:
					return true;
				}
		}

		private function sempredExpression(?Context\ExpressionContext $localContext, int $predicateIndex): bool
		{
			switch ($predicateIndex) {
			    case 0:
			        return $this->precpred($this->ctx, 17);

			    case 1:
			        return $this->precpred($this->ctx, 16);

			    case 2:
			        return $this->precpred($this->ctx, 15);

			    case 3:
			        return $this->precpred($this->ctx, 14);

			    case 4:
			        return $this->precpred($this->ctx, 13);

			    case 5:
			        return $this->precpred($this->ctx, 12);

			    case 6:
			        return $this->precpred($this->ctx, 21);

			    case 7:
			        return $this->precpred($this->ctx, 20);
			}

			return true;
		}
	}
}

namespace Golampi\Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use Golampi\GolampiParser;
	use Golampi\GolampiVisitor;

	class ProgramContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_program;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EOF, 0);
	    }

	    public function declarations(): ?DeclarationsContext
	    {
	    	return $this->getTypedRuleContext(DeclarationsContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitProgram($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclarationsContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_declarations;
	    }

	    /**
	     * @return array<DeclarationContext>|DeclarationContext|null
	     */
	    public function declaration(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(DeclarationContext::class);
	    	}

	        return $this->getTypedRuleContext(DeclarationContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclarations($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_declaration;
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

	    public function funcDecl(): ?FuncDeclContext
	    {
	    	return $this->getTypedRuleContext(FuncDeclContext::class, 0);
	    }

	    public function statement(): ?StatementContext
	    {
	    	return $this->getTypedRuleContext(StatementContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclaration($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_varDecl;
	    }

	    public function VAR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::VAR, 0);
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

	    public function arraySizes(): ?ArraySizesContext
	    {
	    	return $this->getTypedRuleContext(ArraySizesContext::class, 0);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

	    public function DECL_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DECL_ASSIGN, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ConstDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_constDecl;
	    }

	    public function CONST(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONST, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitConstDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_type;
	    }

	    public function INT32(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT32, 0);
	    }

	    public function FLOAT32(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT32, 0);
	    }

	    public function BOOL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BOOL, 0);
	    }

	    public function RUNE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNE, 0);
	    }

	    public function STRING(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING, 0);
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArraySizesContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arraySizes;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function LBRACK(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::LBRACK);
	    	}

	        return $this->getToken(GolampiParser::LBRACK, $index);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function RBRACK(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::RBRACK);
	    	}

	        return $this->getToken(GolampiParser::RBRACK, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArraySizes($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IdListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_idList;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::ID);
	    	}

	        return $this->getToken(GolampiParser::ID, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIdList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expList;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FuncDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_funcDecl;
	    }

	    public function FUNC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FUNC, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function paramList(): ?ParamListContext
	    {
	    	return $this->getTypedRuleContext(ParamListContext::class, 0);
	    }

	    public function returnType(): ?ReturnTypeContext
	    {
	    	return $this->getTypedRuleContext(ReturnTypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFuncDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParamListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_paramList;
	    }

	    /**
	     * @return array<ParamContext>|ParamContext|null
	     */
	    public function param(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParamContext::class);
	    	}

	        return $this->getTypedRuleContext(ParamContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParamList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParamContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_param;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParam($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_returnType;
	    }

	    /**
	     * @return array<TypeContext>|TypeContext|null
	     */
	    public function type(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TypeContext::class);
	    	}

	        return $this->getTypedRuleContext(TypeContext::class, $index);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_block;
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_statement;
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

	    public function assignment(): ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function incDecStmt(): ?IncDecStmtContext
	    {
	    	return $this->getTypedRuleContext(IncDecStmtContext::class, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

	    public function switchStmt(): ?SwitchStmtContext
	    {
	    	return $this->getTypedRuleContext(SwitchStmtContext::class, 0);
	    }

	    public function forStmt(): ?ForStmtContext
	    {
	    	return $this->getTypedRuleContext(ForStmtContext::class, 0);
	    }

	    public function breakStmt(): ?BreakStmtContext
	    {
	    	return $this->getTypedRuleContext(BreakStmtContext::class, 0);
	    }

	    public function continueStmt(): ?ContinueStmtContext
	    {
	    	return $this->getTypedRuleContext(ContinueStmtContext::class, 0);
	    }

	    public function returnStmt(): ?ReturnStmtContext
	    {
	    	return $this->getTypedRuleContext(ReturnStmtContext::class, 0);
	    }

	    public function funcCallStmt(): ?FuncCallStmtContext
	    {
	    	return $this->getTypedRuleContext(FuncCallStmtContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignmentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_assignment;
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

	    public function assignOp(): ?AssignOpContext
	    {
	    	return $this->getTypedRuleContext(AssignOpContext::class, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_assignOp;
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function PLUS_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PLUS_ASSIGN, 0);
	    }

	    public function MINUS_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUS_ASSIGN, 0);
	    }

	    public function MULT_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT_ASSIGN, 0);
	    }

	    public function DIV_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DIV_ASSIGN, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAssignOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExprListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_exprList;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IncDecStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_incDecStmt;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function INC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INC, 0);
	    }

	    public function DEC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEC, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIncDecStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_ifStmt;
	    }

	    public function IF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IF, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    public function ELSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ELSE, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIfStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchStmt;
	    }

	    public function SWITCH(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SWITCH, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

	    /**
	     * @return array<SwitchCaseContext>|SwitchCaseContext|null
	     */
	    public function switchCase(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(SwitchCaseContext::class);
	    	}

	        return $this->getTypedRuleContext(SwitchCaseContext::class, $index);
	    }

	    public function switchDefault(): ?SwitchDefaultContext
	    {
	    	return $this->getTypedRuleContext(SwitchDefaultContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchCaseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchCase;
	    }

	    public function CASE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CASE, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COLON, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchCase($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchDefaultContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchDefault;
	    }

	    public function DEFAULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEFAULT, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COLON, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchDefault($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forStmt;
	    }

	    public function FOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FOR, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function SEMI(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::SEMI);
	    	}

	        return $this->getToken(GolampiParser::SEMI, $index);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function incDecStmt(): ?IncDecStmtContext
	    {
	    	return $this->getTypedRuleContext(IncDecStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BreakStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_breakStmt;
	    }

	    public function BREAK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BREAK, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBreakStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ContinueStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_continueStmt;
	    }

	    public function CONTINUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONTINUE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitContinueStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_returnStmt;
	    }

	    public function RETURN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RETURN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FuncCallStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_funcCallStmt;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

	    public function builtinCall(): ?BuiltinCallContext
	    {
	    	return $this->getTypedRuleContext(BuiltinCallContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFuncCallStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BuiltinCallContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_builtinCall;
	    }

	    public function FMT_PRINTLN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FMT_PRINTLN, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

	    public function LEN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LEN, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function NOW(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NOW, 0);
	    }

	    public function SUBSTR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SUBSTR, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

	    public function TYPEOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TYPEOF, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBuiltinCall($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expression;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class IntExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function INT_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT_LIT, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIntExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class AddSubExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function PLUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PLUS, 0);
	    }

	    public function MINUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUS, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAddSubExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class BuiltinExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function builtinCall(): ?BuiltinCallContext
	    {
	    	return $this->getTypedRuleContext(BuiltinCallContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBuiltinExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class OrExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function OR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::OR, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitOrExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class RuneExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function RUNE_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNE_LIT, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitRuneExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class NilExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function NIL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NIL, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitNilExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class RelationalExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function GT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::GT, 0);
	    }

	    public function GTE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::GTE, 0);
	    }

	    public function LT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LT, 0);
	    }

	    public function LTE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LTE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitRelationalExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ParenExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParenExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StringExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function STRING_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING_LIT, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStringExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IndexExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function LBRACK(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::LBRACK);
	    	}

	        return $this->getToken(GolampiParser::LBRACK, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function RBRACK(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::RBRACK);
	    	}

	        return $this->getToken(GolampiParser::RBRACK, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIndexExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class FloatExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FLOAT_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT_LIT, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFloatExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ArrayLitExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayLitExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class UnaryExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function NOT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NOT, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function MINUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUS, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitUnaryExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class RefExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function REF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::REF, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitRefExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class DerefExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDerefExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class BoolExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function TRUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TRUE, 0);
	    }

	    public function FALSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FALSE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBoolExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class CallExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function expList(): ?ExpListContext
	    {
	    	return $this->getTypedRuleContext(ExpListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitCallExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class MulDivExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT, 0);
	    }

	    public function DIV(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DIV, 0);
	    }

	    public function MOD(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MOD, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitMulDivExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class EqualityExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function EQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EQ, 0);
	    }

	    public function NEQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NEQ, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitEqualityExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IdExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIdExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class AndExprContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function AND(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::AND, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAndExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayLiteral;
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

	    public function arraySizes(): ?ArraySizesContext
	    {
	    	return $this->getTypedRuleContext(ArraySizesContext::class, 0);
	    }

	    /**
	     * @return array<ArrayLiteralContext>|ArrayLiteralContext|null
	     */
	    public function arrayLiteral(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ArrayLiteralContext::class);
	    	}

	        return $this->getTypedRuleContext(ArrayLiteralContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}