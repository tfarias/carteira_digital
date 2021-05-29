<?php

namespace App\Repositories;

use App\Models\Lojistas;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LojistaRepositoryEloquent extends BaseRepository implements LojistaRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lojistas::class;
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


}
