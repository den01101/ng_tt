<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/bootstrap',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->exclude(['cache'])
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new Config();

return $config
    ->setFinder($finder)
    ->setRules([
        '@PHP81Migration' => true,
        '@PSR12' => true,
        'blank_line_before_statement' => ['statements' => ['break', 'case', 'continue', 'declare', 'default', 'do', 'exit', 'for', 'foreach', 'goto', 'if', 'include', 'include_once', 'phpdoc', 'require', 'require_once', 'return', 'switch', 'throw', 'try', 'while', 'yield', 'yield_from']],
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'declare_equal_normalize' => true,
        'function_declaration' => true,
        'indentation_type' => true,
        'line_ending' => true,
        'lowercase_keywords' => true,
        'no_trailing_whitespace' => true,
        'no_unused_imports' => true,
        'single_blank_line_at_eof' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
        'declare_strict_types' => true,
        'return_type_declaration' => [
            'space_before' => 'none',
        ],
        'concat_space' => ['spacing' => 'one'],
        'heredoc_indentation' => false,
        'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => true],
        'operator_linebreak' => false,
        'php_unit_method_casing' => ['case' => 'snake_case'],
        'php_unit_set_up_tear_down_visibility' => true,
        'single_line_throw' => false,
        'single_trait_insert_per_statement' => false,
        'statement_indentation' => ['stick_comment_to_next_continuous_control_statement' => false],
        'yoda_style' => true,
        'octal_notation' => false,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
        ]
    ])
    ->setRiskyAllowed(true)
    ->setUsingCache(true);
