<?php
/**
 * v6.0.0-svn
 *
 * @author      Steeve Andrian Salim
 * @created     15/11/2016 11:41
 * @copyright   Copyright (c) 2016 Steeve Andrian Salim
 */

namespace O2System\Psr\Patterns;


abstract class AbstractModelDataPattern
{
    /**
     * Model Data
     *
     * @var array
     */
    protected $data = [ ];

    public function mergeData ( array $data )
    {
        $oldData = $this->data;
        $this->data = array_merge( $this->data, $data );

        return $oldData;
    }

    public function exchangeData ( array $data )
    {
        $oldData = $this->data;
        $this->data = $data;

        return $oldData;
    }

    public function find ( $offset )
    {
        $result = [ ];

        if ( array_key_exists( $offset, $this->data ) ) {
            $result[] = $this->data[ $offset ];
        } elseif ( false !== ( $offsetKey = array_search( $offset, $this->data ) ) ) {
            $result[] = $this->data[ $offsetKey ];
        }

        return $result;
    }
}