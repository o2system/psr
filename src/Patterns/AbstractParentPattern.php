<?php
/**
 * This file is part of the O2System PHP Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author         Steeve Andrian Salim
 * @copyright      Copyright (c) Steeve Andrian Salim
 */
// ------------------------------------------------------------------------

namespace O2System\Psr\Patterns;

// ------------------------------------------------------------------------

/**
 * Class ParentPatternClass
 *
 * @package O2System\Psr\Patterns
 */
abstract class AbstractParentPattern
{
    private $childPath;

    private $childNamespace;

    private $childInstances = [ ];

    public function setChildPath ( $path )
    {
        if ( is_dir( $path ) ) {
            $this->childPath = rtrim( $path, DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR;
        } elseif ( is_dir( $childPath = dirname( $this->childPath ) . DIRECTORY_SEPARATOR . ucfirst( $path ) ) ) {
            $this->childPath = $childPath . DIRECTORY_SEPARATOR;
        }

        return $this;
    }

    public function setChildNamespace ( $namespace )
    {
        $this->childNamespace = rtrim( $namespace, '\\' ) . '\\';

        return $this;
    }

    public function &__get ( $child )
    {
        $getChild[ $child ] = null;

        if ( isset( $this->childInstances[ $child ] ) ) {
            return $this->childInstances[ $child ];
        } elseif ( false !== ( $childObject = $this->loadChild( $child ) ) ) {
            $this->childInstances[ $child ] = $childObject;

            return $this->childInstances[ $child ];
        }

        return $getChild[ $child ];
    }

    private function loadChild ( $child )
    {
        if ( empty( $this->childPath ) AND empty( $this->childNamespace ) ) {
            $reflection = new \ReflectionClass( get_called_class() );
            $this->childPath = str_replace( '.php', '', $reflection->getFileName() ) . DIRECTORY_SEPARATOR;
            $this->childNamespace = get_called_class() . '\\';
        }

        if ( file_exists( $filePath = $this->childPath . prepare_filename( $child ) . '.php' ) ) {
            require $filePath;
        }

        if ( class_exists( $childClassName = $this->childNamespace . prepare_class_name( $child ) ) ) {
            $childObject = new $childClassName();

            if ( $childObject instanceof AbstractChildPattern ) {
                $childObject->setParentObject( $this );
            }

            return $childObject;
        }

        return false;
    }
}