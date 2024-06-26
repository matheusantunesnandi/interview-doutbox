<?php

namespace App\Entities;

use App\Enums\AnimalAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Animal
{
    use HasFactory;

    public $id;
    public $name;
    public $specie;
    public $dateBirth;
    public $actionsNames;

    public function __construct($id, $name, $specie, $dateBirth, $actionsNames)
    {
        $this->id = $id;
        $this->name = $name;
        $this->specie = $specie;
        $this->dateBirth = $dateBirth;
        $this->actionsNames = $actionsNames;
    }

    public function getIdade()
    {
        return Carbon::parse($this->dateBirth)->age;
    }

    public function getStatus()
    {
        $status = 'idoso';

        if ($this->getIdade() >= 0 || $this->getIdade() <= 2) {
            $status = 'filhote';
        } elseif ($this->getIdade() > 2 || $this->getIdade() <= 8) {
            $status = 'jovem';
        }

        return $status;
    }

    public function performAction($actionName)
    {
        foreach (AnimalAction::cases() as $actionCase) {
            if ($actionCase->name == $actionName) {
                return $actionCase->action();
            }
        }
    }
}
