<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RotateArray extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rotate-array {array} {rotations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $array = explode(',', $this->argument('array'));
        $rotations = (int) $this->argument('rotations');

        $listOutputArrayString = [
            '[' . implode(', ', $array) . ']'
        ];

        for ($i = 0; $i < $rotations; $i++) {
            $firstElement = array_shift($array);
            array_push($array, $firstElement);

            $listOutputArrayString[] = '[' . implode(', ', $array) . ']';
        }

        $this->info(implode(' -> ', $listOutputArrayString));
    }
}
