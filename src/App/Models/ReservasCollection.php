<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\App\Models\Reserva;

class ReservasCollection extends Model
{
    public $table = 'reserva';

    public $idLocal = null;
    public $mesas = [];
    public $mesasOcupadas = [];
    public $mesasDesocupadas = [];

    public function __construct($idLocal=null, $mesas=[])
    {
        $this->idLocal = $idLocal;
        $this->mesas = $mesas;
    }

    public function getMesasOcupadas()
    {
        return $this->mesasOcupadas;
    }

    public function getMesasDesocupadas()
    {
        return $this->mesasDesocupadas;
    }

    public function getIdLocal()
    {
        return $this->idLocal;
    }

    public function getMesas()
    {
        return $this->mesas;
    }

    public function getAll()
    {

        foreach ($this->getMesas() as $mesa)
        {
            $newReserva = new Reserva();
            $result = $newReserva->load($this->getIdLocal(), $mesa->getId());

            if(!isset($result['error'])){
                $newReserva->getOcupada() ? $this->mesasOcupadas[] = $newReserva : 
                                            $this->mesasDesocupadas[] = $mesa;
            }
        }

        return [$this->mesasOcupadas, $this->mesasDesocupadas];
    }

    public function get($id)
    {
        $local = new Local;
        $local->setQueryBuilder($this->queryBuilder);
        $result = $local->loadByName($id);
        return [$result, $local];
    }


}
