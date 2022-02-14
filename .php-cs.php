<?php

declare(strict_types=1);

use PhpCsFixerCustomFixers\Fixer\NoImportFromGlobalNamespaceFixer;
use PhpCsFixerCustomFixers\Fixer\NoSuperfluousConcatenationFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessCommentFixer;
use PhpCsFixerCustomFixers\Fixer\OperatorLinebreakFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocNoIncorrectVarAnnotationFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceAfterStatementFixer;
use PhpCsFixer\Fixer\CastNotation\ModernizeTypesCastingFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\NullableTypeDeclarationForDefaultNullValueFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitConstructFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertInternalTypeFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMethodCasingFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMockFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMockShortWillReturnFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestCaseStaticMethodCallsFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocOrderFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Whitespace\CompactNullableTypehintFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/psr12.php');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/symfony.php');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/common/array.php');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/common/control-structures.php');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/common/strict.php');

    $services = $containerConfigurator->services();

    $services->set(ModernizeTypesCastingFixer::class);

    $services->set(ClassAttributesSeparationFixer::class)
        ->call('configure', [['elements' => ['property', 'method']]]);

    $services->set(MethodArgumentSpaceFixer::class)
        ->call('configure', [['on_multiline' => 'ensure_fully_multiline']]);

    $services->set(NullableTypeDeclarationForDefaultNullValueFixer::class);

    $services->set(VoidReturnFixer::class);

    $services->set(ConcatSpaceFixer::class);

    $services->set(GeneralPhpdocAnnotationRemoveFixer::class)
        ->call('configure', [['annotations' => ['copyright', 'category']]]);

    $services->set(NoSuperfluousPhpdocTagsFixer::class);

    $services->set(PhpdocOrderFixer::class);

    $services->set(PhpUnitConstructFixer::class);

    $services->set(PhpUnitDedicateAssertFixer::class)
        ->call('configure', [['target' => 'newest']]);

    $services->set(PhpUnitDedicateAssertInternalTypeFixer::class);

    $services->set(PhpUnitMockFixer::class);

    $services->set(PhpUnitMockShortWillReturnFixer::class);

    $services->set(PhpUnitTestCaseStaticMethodCallsFixer::class);

    $services->set(NoUselessReturnFixer::class);

    $services->set(DeclareStrictTypesFixer::class);

    $services->set(CompactNullableTypehintFixer::class);

    $services->set(NoImportFromGlobalNamespaceFixer::class);

    $services->set(NoSuperfluousConcatenationFixer::class);

    $services->set(NoUselessCommentFixer::class);

    $services->set(OperatorLinebreakFixer::class);

    $services->set(PhpdocNoIncorrectVarAnnotationFixer::class);

    $services->set(SingleSpaceAfterStatementFixer::class);

    $parameters = $containerConfigurator->parameters();

    $parameters->set('cache_directory', 'build/ecs/');

    $parameters->set('cache_namespace', 'project');

    $parameters->set('skip', [PhpUnitMethodCasingFixer::class => null]);

    $parameters->set('paths', [__DIR__ . '/src', __DIR__ . '/tests']);
};
