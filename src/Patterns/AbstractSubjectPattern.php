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


use SplObserver;

abstract class AbstractSubjectPattern implements \SplSubject
{
    private $observers = [ ];

    private $state;

    /**
     * Attach an SplObserver
     *
     * @link  http://php.net/manual/en/splsubject.attach.php
     *
     * @param SplObserver $observer <p>
     *                              The <b>SplObserver</b> to attach.
     *                              </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function attach ( SplObserver $observer )
    {
        $i = array_search( $observer, $this->observers );
        if ( $i === false ) {
            $this->observers[] = $observer;
        }
    }

    /**
     * Detach an observer
     *
     * @link  http://php.net/manual/en/splsubject.detach.php
     *
     * @param SplObserver $observer <p>
     *                              The <b>SplObserver</b> to detach.
     *                              </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function detach ( SplObserver $observer )
    {
        if ( ! empty( $this->observers ) ) {
            $i = array_search( $observer, $this->observers );
            if ( $i !== false ) {
                unset( $this->observers[ $i ] );
            }
        }
    }

    /**
     * Notify an observer
     *
     * @link  http://php.net/manual/en/splsubject.notify.php
     * @return void
     * @since 5.1.0
     */
    public function notify ()
    {
        if ( ! empty( $this->observers ) ) {
            foreach ( $this->observers as $observer ) {
                $observer->update( $this );
            }
        }
    }

    public function getState ()
    {
        return $this->state;
    }

    public function setState ( $state )
    {
        $oldState = $this->state;
        $this->state = $state;

        return $oldState;
    }

    public function getObservers ()
    {
        return $this->observers;
    }

}