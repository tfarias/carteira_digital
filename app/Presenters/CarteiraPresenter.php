<?php

namespace App\Presenters;

use App\Transformers\CarteiraTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VendaPresenter.
 *
 * @package namespace App\Presenters;
 */
class CarteiraPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CarteiraTransformer();
    }
}
