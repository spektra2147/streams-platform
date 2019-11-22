<?php

namespace Anomaly\Streams\Platform\Ui\Table\Component\Action;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ActionInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionInput
{

    /**
     * The action lookup.
     *
     * @var ActionLookup
     */
    protected $lookup;

    /**
     * The action guesser.
     *
     * @var ActionGuesser
     */
    protected $guesser;

    /**
     * The dropdown utility.
     *
     * @var ActionDropdown
     */
    protected $dropdown;

    /**
     * The action predictor.
     *
     * @var ActionPredictor
     */
    protected $predictor;

    /**
     * The evaluator utility.
     *
     * @var ActionEvaluator
     */
    protected $evaluator;

    /**
     * The action normalizer.
     *
     * @var ActionNormalizer
     */
    protected $normalizer;

    /**
     * The action parser.
     *
     * @var ActionParser
     */
    private $parser;

    /**
     * Create a new ActionInput instance.
     *
     * @param ActionParser     $parser
     * @param ActionLookup     $lookup
     * @param ActionGuesser    $guesser
     * @param ActionDropdown   $dropdown
     * @param ActionPredictor  $predictor
     * @param ActionEvaluator  $evaluator
     * @param ActionNormalizer $normalizer
     */
    public function __construct(
        ActionParser $parser,
        ActionLookup $lookup,
        ActionGuesser $guesser,
        ActionDropdown $dropdown,
        ActionPredictor $predictor,
        ActionEvaluator $evaluator,
        ActionNormalizer $normalizer
    ) {
        $this->parser     = $parser;
        $this->lookup     = $lookup;
        $this->guesser    = $guesser;
        $this->dropdown   = $dropdown;
        $this->predictor  = $predictor;
        $this->evaluator  = $evaluator;
        $this->normalizer = $normalizer;
    }

    /**
     * Read builder action input.
     *
     * @param  TableBuilder $builder
     * @return array
     */
    public function read(TableBuilder $builder)
    {
        $actions = $builder->getActions();

        /**
         * Resolve & Evaluate
         */
        $actions = resolver($actions, compact('builder'));

        $actions = $actions ?: $builder->getButtons();

        $actions = evaluate($actions, compact('builder'));

        $builder->setActions($actions);

        $this->evaluator->evaluate($builder);
        $this->predictor->predict($builder);
        $this->normalizer->normalize($builder);
        $this->dropdown->flatten($builder);
        $this->lookup->merge($builder);
        $this->guesser->guess($builder);
        $this->parser->parse($builder);
        $this->dropdown->build($builder);

        $actions = translate($actions);

        $builder->setActions(translate($builder->getActions()));
    }
}
