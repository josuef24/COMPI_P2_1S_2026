<?php

/*
 * Generated from grammar/Golampi.g4 by ANTLR 4.13.1
 */

namespace Golampi;

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see GolampiParser}.
 */
interface GolampiVisitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see GolampiParser::program()}.
	 *
	 * @param Context\ProgramContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitProgram(Context\ProgramContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::declarations()}.
	 *
	 * @param Context\DeclarationsContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclarations(Context\DeclarationsContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::declaration()}.
	 *
	 * @param Context\DeclarationContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclaration(Context\DeclarationContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::varDecl()}.
	 *
	 * @param Context\VarDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarDecl(Context\VarDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::constDecl()}.
	 *
	 * @param Context\ConstDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitConstDecl(Context\ConstDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::type()}.
	 *
	 * @param Context\TypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitType(Context\TypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::arraySizes()}.
	 *
	 * @param Context\ArraySizesContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArraySizes(Context\ArraySizesContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::idList()}.
	 *
	 * @param Context\IdListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIdList(Context\IdListContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::expList()}.
	 *
	 * @param Context\ExpListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpList(Context\ExpListContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::funcDecl()}.
	 *
	 * @param Context\FuncDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFuncDecl(Context\FuncDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::paramList()}.
	 *
	 * @param Context\ParamListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParamList(Context\ParamListContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::param()}.
	 *
	 * @param Context\ParamContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParam(Context\ParamContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::returnType()}.
	 *
	 * @param Context\ReturnTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnType(Context\ReturnTypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::block()}.
	 *
	 * @param Context\BlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBlock(Context\BlockContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::statement()}.
	 *
	 * @param Context\StatementContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatement(Context\StatementContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::assignment()}.
	 *
	 * @param Context\AssignmentContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignment(Context\AssignmentContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::assignOp()}.
	 *
	 * @param Context\AssignOpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignOp(Context\AssignOpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::exprList()}.
	 *
	 * @param Context\ExprListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprList(Context\ExprListContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::incDecStmt()}.
	 *
	 * @param Context\IncDecStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIncDecStmt(Context\IncDecStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::ifStmt()}.
	 *
	 * @param Context\IfStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIfStmt(Context\IfStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::switchStmt()}.
	 *
	 * @param Context\SwitchStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSwitchStmt(Context\SwitchStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::switchCase()}.
	 *
	 * @param Context\SwitchCaseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSwitchCase(Context\SwitchCaseContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::switchDefault()}.
	 *
	 * @param Context\SwitchDefaultContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSwitchDefault(Context\SwitchDefaultContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::forStmt()}.
	 *
	 * @param Context\ForStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForStmt(Context\ForStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::breakStmt()}.
	 *
	 * @param Context\BreakStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBreakStmt(Context\BreakStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::continueStmt()}.
	 *
	 * @param Context\ContinueStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitContinueStmt(Context\ContinueStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::returnStmt()}.
	 *
	 * @param Context\ReturnStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnStmt(Context\ReturnStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::funcCallStmt()}.
	 *
	 * @param Context\FuncCallStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFuncCallStmt(Context\FuncCallStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::builtinCall()}.
	 *
	 * @param Context\BuiltinCallContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBuiltinCall(Context\BuiltinCallContext $context);

	/**
	 * Visit a parse tree produced by the `intExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\IntExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIntExpr(Context\IntExprContext $context);

	/**
	 * Visit a parse tree produced by the `addSubExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\AddSubExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAddSubExpr(Context\AddSubExprContext $context);

	/**
	 * Visit a parse tree produced by the `builtinExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\BuiltinExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBuiltinExpr(Context\BuiltinExprContext $context);

	/**
	 * Visit a parse tree produced by the `orExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\OrExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOrExpr(Context\OrExprContext $context);

	/**
	 * Visit a parse tree produced by the `runeExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\RuneExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitRuneExpr(Context\RuneExprContext $context);

	/**
	 * Visit a parse tree produced by the `nilExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\NilExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNilExpr(Context\NilExprContext $context);

	/**
	 * Visit a parse tree produced by the `relationalExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\RelationalExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitRelationalExpr(Context\RelationalExprContext $context);

	/**
	 * Visit a parse tree produced by the `parenExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ParenExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParenExpr(Context\ParenExprContext $context);

	/**
	 * Visit a parse tree produced by the `stringExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\StringExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStringExpr(Context\StringExprContext $context);

	/**
	 * Visit a parse tree produced by the `indexExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\IndexExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIndexExpr(Context\IndexExprContext $context);

	/**
	 * Visit a parse tree produced by the `floatExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\FloatExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFloatExpr(Context\FloatExprContext $context);

	/**
	 * Visit a parse tree produced by the `arrayLitExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ArrayLitExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayLitExpr(Context\ArrayLitExprContext $context);

	/**
	 * Visit a parse tree produced by the `unaryExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\UnaryExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitUnaryExpr(Context\UnaryExprContext $context);

	/**
	 * Visit a parse tree produced by the `refExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\RefExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitRefExpr(Context\RefExprContext $context);

	/**
	 * Visit a parse tree produced by the `derefExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\DerefExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDerefExpr(Context\DerefExprContext $context);

	/**
	 * Visit a parse tree produced by the `boolExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\BoolExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBoolExpr(Context\BoolExprContext $context);

	/**
	 * Visit a parse tree produced by the `callExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\CallExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitCallExpr(Context\CallExprContext $context);

	/**
	 * Visit a parse tree produced by the `mulDivExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\MulDivExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitMulDivExpr(Context\MulDivExprContext $context);

	/**
	 * Visit a parse tree produced by the `equalityExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\EqualityExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitEqualityExpr(Context\EqualityExprContext $context);

	/**
	 * Visit a parse tree produced by the `idExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\IdExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIdExpr(Context\IdExprContext $context);

	/**
	 * Visit a parse tree produced by the `andExpr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\AndExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAndExpr(Context\AndExprContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::arrayLiteral()}.
	 *
	 * @param Context\ArrayLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayLiteral(Context\ArrayLiteralContext $context);
}