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


use Traversable;

abstract class AbstractCollectorPattern implements \IteratorAggregate
{
    private $items = [ ];

    public function &getItem ( $offset )
    {
        $item[ $offset ] = null;

        if ( $this->hasItem( $offset ) ) {
            return $this->items[ $offset ];
        }

        return $item[ $offset ];
    }

    public function hasItem ( $offset )
    {
        return (bool) isset( $this->items[ $offset ] );
    }

    public function setItem ( $offset, $item )
    {
        $this->items[ $offset ] = $item;
    }

    public function addItem ( $offset, $item )
    {
        if ( $this->hasItem( $offset ) === false ) {
            $this->items[ $offset ] = $item;
        }
    }

    public function removeItem ( $offset )
    {
        if ( $this->hasItem( $offset ) ) {
            unset( $this->items[ $offset ] );
        }
    }

    public function exchangeItems ( array $items )
    {
        $oldItems = $this->items;
        $this->items = $items;

        return $oldItems;
    }

    public function mergeItems ( array $items )
    {
        $oldItems = $this->items;
        $this->items = array_merge( $this->items, $items );

        return $oldItems;
    }

    public function getArrayCopy ()
    {
        return $this->items;
    }

    /**
     * Retrieve an external iterator
     *
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     *        <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator ()
    {
        return new \ArrayIterator( $this->items );
    }
}