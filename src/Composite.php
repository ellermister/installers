<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-08-27 18:48
 */
namespace Notadd\Installer;

use Notadd\Installer\Contracts\Prerequisite;

/**
 * Class Composite.
 */
class Composite implements Prerequisite
{
    /**
     * @var array
     */
    protected $prerequisites = [];

    /**
     * Composite constructor.
     *
     * @param \Notadd\Installer\Contracts\Prerequisite $first
     */
    public function __construct(Prerequisite $first)
    {
        foreach (func_get_args() as $prerequisite) {
            $this->prerequisites[] = $prerequisite;
        }
    }

    /**
     * TODO: Method check Description
     *
     * @return mixed
     */
    public function check()
    {
        return array_reduce($this->prerequisites, function ($previous, Prerequisite $prerequisite) {
            return $prerequisite->check() && $previous;
        }, true);
    }

    /**
     * TODO: Method getErrors Description
     *
     * @return mixed
     */
    public function getErrors()
    {
        return collect($this->prerequisites)->map(function (Prerequisite $prerequisite) {
            return $prerequisite->getErrors();
        })->reduce('array_merge', []);
    }
}
