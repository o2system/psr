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
 * Class AbstractDataStoragePattern
 *
 * The best practice of this pattern class is to contain many types of data into the storage.
 *
 * This pattern class is designed to be able to traversable using foreach.
 *
 * Several cases example:
 * If all of the data is an object and doesn't required to be validated use AbstractObjectContainerPattern class.
 * If all of the data is an object and required to be validated use AbstractObjectRegistryPattern class.
 *
 * Note: This class is an abstract class so it can not be initiated.
 *
 * @package O2System\Psr\Patterns
 */
abstract class AbstractDataStoragePattern implements
    \ArrayAccess,
    \Countable,
    \Serializable,
    \JsonSerializable
{
    /**
     * AbstractDataStoragePattern::$storage
     *
     * The array of data storage.
     *
     * @var array
     */
    protected $storage = [];

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::merge
     *
     * Merge new array of data into the data storage.
     *
     * @param array $data New array of data.
     *
     * @return array The old array of data storage.
     */
    public function merge( array $data )
    {
        $oldData = $this->storage;
        $this->storage = array_merge( $this->storage, $data );

        return $oldData;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::exchange
     *
     * Exchange the array of data storage into the new array of data.
     *
     * @param array $data New array of data.
     *
     * @return array The old array of data storage.
     */
    public function exchange( array $data )
    {
        $oldData = $this->storage;
        $this->storage = $data;

        return $oldData;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::search
     *
     * Search data based on array offset key.
     *
     * @param string $offset The data offset key.
     * @param mixed  $return The fail over of data returns when the data is not found.
     *
     * @return mixed The returns is varies depends on the content of the data or the return variable.
     */
    public function search( $offset, $return = false )
    {
        if ( array_key_exists( $offset, $this->storage ) ) {
            return $this->storage[ $offset ];
        } elseif ( false !== ( $offsetKey = array_search( $offset, $this->storage ) ) ) {
            return $this->storage[ $offsetKey ];
        }

        return $return;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::exists
     *
     * Checks if the data exists on the storage.
     * An alias of AbstractObjectContainerPattern::__isset method.
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function exists( $offset )
    {
        return $this->__isset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::contains
     *
     * Application of __isset magic method to checks if the data exists on the storage.
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function __isset( $offset )
    {
        return (bool)isset( $this->storage[ $offset ] );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::offsetExists
     *
     * Application of ArrayAccess::offsetExists magic method to checks if the data exists on the storage.
     * An alias of AbstractObjectContainerPattern::__isset method.
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string $offset The object offset key.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function offsetExists( $offset )
    {
        return $this->__isset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::offsetGet
     *
     * Application of ArrayAccess::offsetGet to retrieve the stored data from the storage.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    public function offsetGet( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            return $this->storage[ $offset ];
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::getData
     *
     * Retrieve the contained object which specified offset key.
     * An alias of AbstractDataStoragePattern::__get method.
     *
     * @param string $offset The object offset key.
     *
     * @return mixed Varies depends the data contents, return NULL when there offset is not found.
     */
    public function getData( $offset )
    {
        return $this->offsetGet( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::store
     *
     * Store the data into the storage.
     * An alias of AbstractDataStoragePattern::__set method.
     *
     * @param string $offset The data offset key.
     * @param mixed  $value  The data to be stored.
     *
     * @return void
     */
    public function store( $offset, $value )
    {
        $this->offsetSet( $offset, $value );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::offsetSet
     *
     * Application of ArrayAccess::offsetSet method to store the data into the storage.
     * An alias of AbstractDataStoragePattern::__set method.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param string $offset The data offset key.
     * @param mixed  $value  The data to be stored.
     *
     * @return void
     */
    public function offsetSet( $offset, $value )
    {
        if ( ! $this->__isset( $offset ) ) {
            $this->storage[ $offset ] = $value;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::remove
     *
     * Removes a data from the storage.
     * An alias of AbstractDataStoragePattern::__unset method.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function remove( $offset )
    {
        $this->__unset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::__unset
     *
     * Application of magic method __unset to removes a data from the storage.
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function __unset( $offset )
    {
        if ( $this->__isset( $offset ) ) {
            unset( $this->storage[ $offset ] );
        }
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::offsetUnset
     *
     * Application of ArrayAccess::offsetUnset method to removes a data from the storage.
     * An alias of AbstractDataStoragePattern::__unset method.
     *
     * @see  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param string $offset The object offset key.
     *
     * @return void
     */
    public function offsetUnset( $offset )
    {
        $this->__unset( $offset );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::destroy
     *
     * Removes all object from the container and perform each object destruction.
     *
     * @return array Array of old storage items.
     */
    public function destroy()
    {
        $storage = $this->storage;

        $this->storage = [];

        return $storage;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::count
     *
     * Application of Countable::count method to count the numbers of contained objects.
     *
     * @see  http://php.net/manual/en/countable.count.php
     * @return int The numbers of data on the storage.
     */
    public function count()
    {
        return (int)count( $this->storage );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStorage::serialize
     *
     * Application of Serializable::serialize method to serialize the data storage.
     *
     * @see  http://php.net/manual/en/serializable.serialize.php
     *
     * @return string The string representation of the serialized data storage.
     */
    public function serialize()
    {
        return serialize( $this->storage );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStorage::unserialize
     *
     * Application of Serializable::unserialize method to unserialize and construct the data storage.
     *
     * @see  http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized The string representation of the serialized data storage.
     *
     * @return void
     */
    public function unserialize( $serialized )
    {
        $this->storage = unserialize( $serialized );
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStorage::jsonSerialize
     *
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *        which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->storage;
    }

    // ------------------------------------------------------------------------

    /**
     * AbstractDataStoragePattern::getArrayCopy
     *
     * Gets a copy of the data storage.
     *
     * @return array Returns a copy of the data storage.
     */
    public function getArrayCopy()
    {
        return $this->storage;
    }
}