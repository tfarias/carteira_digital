<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MovimentoNotificacoesCriteria.
 *
 * @package namespace App\Criteria;
 */
class MovimentoNotificacoesCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function apply($model, RepositoryInterface $repository)
    {
       return $model
            ->where('notificou','N')
            ->where('status','Autorizado')
            ->limit(5);

    }
}
