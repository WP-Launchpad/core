<?php
// phpcs:ignoreFile

namespace LaunchpadCore\Container\Autowiring;

use League\Container\Argument\DefaultValueArgument;
use League\Container\Argument\LiteralArgument;
use League\Container\Argument\ResolvableArgument;
use League\Container\Exception\NotFoundException;
use League\Container\ReflectionContainer;
use ReflectionFunctionAbstract;
use ReflectionNamedType;
use ReflectionParameter;

class Container extends ReflectionContainer {

	/**
	 * {@inheritdoc}
	 */
	public function reflectArguments( ReflectionFunctionAbstract $method, array $args = [] ): array {
        $params    = $method->getParameters();
        $arguments = [];

        foreach ($params as $param) {
            $name = $param->getName();

            // if we've been given a value for the argument, treat as literal
            if (array_key_exists($name, $args)) {
                $arguments[] = new LiteralArgument($args[$name]);
                continue;
            }

            $type = $param->getType();

            if ($type instanceof ReflectionNamedType) {
                // in PHP 8, nullable arguments have "?" prefix
                $typeHint = ltrim($type->getName(), '?');

                if ( ! in_array( $typeHint, [ 'string', 'float', 'int', 'bool', 'array', 'object' ], true ) ) {
                    if ($param->isDefaultValueAvailable()) {
                        $arguments[] = new DefaultValueArgument($typeHint, $param->getDefaultValue());
                        continue;
                    }

                    $arguments[] = new ResolvableArgument($typeHint);
                    continue;
                }

                if ( $param->isDefaultValueAvailable() ) {
                    $arguments[] =  new DefaultValueArgument( $param->getDefaultValue() );
                    continue;
                }
            }

            if ($param->isDefaultValueAvailable()) {
                $arguments[] = new LiteralArgument($param->getDefaultValue());
                continue;
            }

            $name = rtrim( $name, '$' );

            $arguments[] =  new ResolvableArgument( $name );
        }

        return $this->resolveArguments($arguments);
	}
}
