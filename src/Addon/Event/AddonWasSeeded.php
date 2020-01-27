<?php

namespace Anomaly\Streams\Platform\Addon\Event;

use Anomaly\Streams\Platform\Addon\Addon;

/**
 * Class AddonWasSeeded
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class AddonWasSeeded
{

    /**
     * The addon namespace.
     *
     * @var string
     */
    protected $addon;

    /**
     * Create a new AddonWasSeeded instance.
     *
     * @param string $addon
     */
    public function __construct(string $addon)
    {
        $this->addon = $addon;
    }

    /**
     * Get the addon namespace.
     *
     * @return string
     */
    public function getAddon()
    {
        return $this->addon;
    }
}
