<?php

namespace App\Http\Controllers;

use App\Entities\Animal;
use App\Enums\AnimalAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public const STORAGE_FILE_NAME = 'animals.json';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animals = $this->loadPersistedAnimalsInJSON();

        return view('pages.animals.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $animalActionCases = AnimalAction::cases();

        return view('pages.animals.create', compact('animalActionCases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $animals = $this->loadPersistedAnimalsInJSON();

        $animals[] = new Animal(
            count($animals) + 1,
            $request->input('name'),
            $request->input('specie'),
            $request->input('dateBirth'),
            $request->input('actionsNames')
        );

        $this->persistAnimalsInJSON($animals);

        return redirect()->route('animals.index');
    }

    private function loadPersistedAnimalsInJSON()
    {
        if (!Storage::exists(self::STORAGE_FILE_NAME)) {
            return [];
        }

        $contents = Storage::get(self::STORAGE_FILE_NAME);

        $animalsArray = json_decode($contents, true);

        $animals = [];

        $animalActionNameAvailables = array_column(AnimalAction::cases(), 'name');

        foreach ($animalsArray as $animalArray) {

            $filteredNameActions = array_intersect($animalActionNameAvailables, $animalArray['actionsNames']);

            $animals[] = new Animal(
                $animalArray['id'],
                $animalArray['name'],
                $animalArray['specie'],
                $animalArray['date_birth'],
                $filteredNameActions
            );
        }

        return $animals;
    }

    private function persistAnimalsInJSON($animals)
    {
        $animalsArray = [];

        foreach ($animals as $animal) {
            $animalsArray[] = [
                'id' => $animal->id,
                'name' => $animal->name,
                'specie' => $animal->specie,
                'date_birth' => $animal->dateBirth,
                'actionsNames' => $animal->actionsNames
            ];
        }

        $fileContent = json_encode($animalsArray);

        Storage::put(self::STORAGE_FILE_NAME, $fileContent);
    }
}
