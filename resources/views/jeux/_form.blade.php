@csrf
<label for="nomJeu">Nom du jeu</label>
<input id="nomJeu" name="nomJeu" value="{{ old('nomJeu', $jeu?->nomJeu) }}">
@error('nomJeu') <p>{{ $message }}</p> @enderror

<label for="prix">Prix</label>
<input id="prix" name="prix" type="number" step="0.01" min="0" value="{{ old('prix', $jeu?->prix) }}">
@error('prix') <p>{{ $message }}</p> @enderror

<label for="description">Description</label>
<textarea id="description" name="description">{{ old('description', $jeu?->description) }}</textarea>
@error('description') <p>{{ $message }}</p> @enderror

<label for="categorie">Catégorie</label>
<select id="categorie" name="categorie">
    @foreach (['Horreur', 'Action', 'Aventure', 'RPG'] as $categorie)
    <option value="{{ $categorie }}" @selected(old('categorie', $jeu?->categorie) === $categorie)>
        {{ $categorie }}
    </option>
    @endforeach
</select>
@error('categorie') <p>{{ $message }}</p> @enderror

<label for="reduction">
    <input type="hidden" name="reduction" value="0">
    <input id="reduction" type="checkbox" name="reduction" value="1" @checked(old('reduction', $jeu?->reduction))>
    En réduction
</label>
@error('reduction') <p>{{ $message }}</p> @enderror

<button type="submit">Enregistrer</button>