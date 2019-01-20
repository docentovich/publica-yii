<?php

namespace probank\dto;

use app\dto\ConfigQuery;
use app\dto\SpecialistsTransportModel;

/**
 * Class SpecialistsTransportModel
 * @property \app\models\Portfolio|\app\models\Portfolio[] $result
 * @property ProbankSpecialistsServiceConfig $config
 * @package app\dto
 */
class ProbankSpecialistsTransportModel extends SpecialistsTransportModel
{
    /** @var null|\app\models\Portfolio */
    public $prevPost;
    /** @var null|\app\models\Portfolio */
    public $nextPost;

    /**
     * ProbankSpecialistsTransportModel constructor.
     * @param ConfigQuery $configQuery
     * @param $result
     * @param \app\models\Portfolio $prevPost
     * @param \app\models\Portfolio $nextPost
     */
    public function __construct(ConfigQuery $configQuery, $result, $prevPost = null, $nextPost = null)
    {
        $this->prevPost = $prevPost;
        $this->nextPost = $nextPost;

        parent::__construct($configQuery, $result);
    }
}