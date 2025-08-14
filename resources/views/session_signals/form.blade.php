<div>
    <label for="Titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
    <input type="text" name="Titre"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
        value="{{ old('Titre') }}" required>
</div>
<div>
    <label for="HeureDebut" class="block text-sm font-medium text-gray-700 mb-1">Heure Début</label>
    <input type="time" name="HeureDebut"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
        value="{{ old('HeureDebut') }}" required>
</div>
<div>
    <label for="HeureFin" class="block text-sm font-medium text-gray-700 mb-1">Heure Fin</label>
    <input type="time" name="HeureFin"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
        value="{{ old('HeureFin') }}" required>
</div>
<div class="flex gap-2 mt-6">
    <button type="submit"
        class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">Créer</button>
    <a href="{{ route('session-signals.index') }}"
        class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Annuler</a>
</div>
