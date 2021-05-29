<?php

namespace App\Repositories;

use App\Models\Comuns;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ComunRepositoryEloquent extends BaseRepository implements ComunRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comuns::class;
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
