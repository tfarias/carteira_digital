<?php

namespace App\Repositories;

use App\Models\Carteira;
use App\Presenters\CarteiraPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;



/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CarteiraRepositoryEloquent extends BaseRepository implements CarteiraRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Carteira::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return CarteiraPresenter::class;
    }

}
