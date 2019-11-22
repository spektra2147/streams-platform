<?php

namespace Anomaly\Streams\Platform\Ui\Grid\Component\Button;

use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

/**
 * Class ButtonResolver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ButtonResolver
{

    /**
     * The resolver utility.
     *
     * @var Resolver
     */
    protected $resolver;

    /**
     * Create a new ButtonResolver instance.
     *
     * @param Resolver $resolver
     */
    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Resolve grid views.
     *
     * @param GridBuilder $builder
     */
    public function resolve(GridBuilder $builder)
    {
        resolver($builder->getButtons(), compact('builder'));
    }
}
