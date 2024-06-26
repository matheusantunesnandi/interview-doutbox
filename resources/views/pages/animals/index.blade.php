<p>
    Observações: Os animais estão sendo salvos no caminho <strong>'storage/app/animals.json'</strong>
</p>

@foreach ($animals as $animal)
    <p>
        @foreach ($animal->actionsNames as $actionName)
            {{ $animal->specie }}, {{ $animal->name }} {{ $animal->performAction($actionName) }}
            <br>
        @endforeach
        Sua idade é: {{ $animal->getIdade() }} e seu estado é: {{ $animal->getStatus() }}

        @if (!$loop->last)
            <br>
        @endif
    </p>
@endforeach
