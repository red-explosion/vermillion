<?php

declare(strict_types=1);

namespace RedExplosion\Vermillion\PHPStan;

use Illuminate\Routing\Router;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use RedExplosion\Vermillion\PHPStan\MethodReflections\RouterVersioningMethodReflection;

class RouterMethodsReflectionExtension implements MethodsClassReflectionExtension
{
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        return is_a($classReflection->getName(), Router::class, true)
            && $methodName === 'versioning';
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        return new RouterVersioningMethodReflection(
            $classReflection,
            new ClassMemberReflection($classReflection, false)
        );
    }
}
