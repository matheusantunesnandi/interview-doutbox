<form action="{{ route('animals.index') }}" method="POST">
    @csrf

    <div>
        <label for="specie">Espécie</label>
        <input type="text" name="specie" id="specie">
    </div>

    <div>
        <label for="name">Nome</label>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <label for="dateBirth">Data de nascimento</label>
        <input type="date" name="dateBirth" id="dateBirth">
    </div>

    <div>
        <label for="actionsNames">Selecione as ações permitidas</label>

        <select name="actionsNames[]" id="actionsNames" multiple>
            @foreach ($animalActionCases as $animalAction)
                <option value="{{ $animalAction->name }}">{{ $animalAction->value() }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Cadastrar</button>
</form>
