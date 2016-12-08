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


use O2System\Spl\Interfaces\SplArrayInterface;
use Traversable;

abstract class AbstractRegistryPattern implements \IteratorAggregate, SplArrayInterface
{
    /**
     * Registries Storage
     *
     * @var array
     */
    private $registry = [ ];

    public function &get ( $offset )
    {
        return $this->__get( $offset );
    }

    public function &__get ( $offset )
    {
        $getCollections[ $offset ] = null;

        if ( isset( $this->registry[ $offset ] ) ) {
            $getCollections[ $offset ] =& $this->registry[ $offset ];
        }

        return $getCollections[ $offset ];
    }

    public function __set ( $offset, $registry )
    {
        $this->register( $offset, $registry );
    }

    public function register ( $offset, $registry )
    {
        if ( $this->isValid( $registry ) ) {
            $this->registry[ $offset ] = $registry;
        }
    }

    /**
     * RegistryPatternClass::isValid
     *
     * @param mixed $registry
     *
     * @return bool
     */
    abstract protected function isValid ( $registry );

    /**
     * RegistryPatternClass::has
     *
     * Checks if a value exists in the storage.
     *
     * @param mixed $offset The searched value.
     * @param bool  $strict If the third parameter strict is set to TRUE then the in_array() function will also check
     *                      the types of the needle in the haystack.
     *
     * @return bool
     */
    public function has ( $offset, $strict = false )
    {
        $offset = $strict === false ? strtolower( $offset ) : $offset;

        return (bool) isset( $this->registry[ $offset ] );
    }

    public function unregister ( $offset )
    {
        $this->__unset( $offset );
    }

    public function __unset ( $offset )
    {
        if ( isset( $this->registry[ $offset ] ) ) {
            unset( $this->registry[ $offset ] );
        }
    }

    public function __isset ( $offset )
    {
        return (bool) isset( $this->registry[ $offset ] );
    }

    public function destroy ()
    {
        $this->registry = [ ];

        return $this->isEmpty();
    }

    /**
     * RegistryPatternClass::isEmpty
     *
     * Checks if registry storage is empty.
     *
     * @return bool Returns TRUE if empty.
     */
    public function isEmpty ()
    {
        return (bool) count( $this->registry ) == 0 ? true : false;
    }

    /**
     * RegistryPatternClass::getIterator
     *
     * Retrieve an external iterator
     *
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     *        <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator ()
    {
        return new \ArrayIterator( $this->registry );
    }

    /**
     * RegistryPatternClass::getArrayCopy
     *
     * Creates a copy of the storage.
     *
     * @return array A copy of the storage.
     */
    public function getArrayCopy ()
    {
        return $this->registry;
    }
}