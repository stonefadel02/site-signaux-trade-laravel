<div>
    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nom') }}</label>
    <input type="text" name="Nom"
        class="w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('Nom') ? 'border-red-500 border' : 'border border-gray-300' }}"
        value="{{ old('Nom', $timeframe?->Nom) }}" id="nom" placeholder="Nom">

    @error('Nom')
        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>
<div>
    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Description') }}</label>
    <input type="text" name="Description"
        class="w-full rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('Description') ? 'border-red-500 border' : 'border border-gray-300' }}"
        value="{{ old('Description', $timeframe?->Description) }}" id="description" placeholder="Description">
    @error('Description')
        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>

<div class="flex gap-2 mt-6">
    <button type="submit"
        class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">{{ __('Submit') }}</button>
    <a href="{{ route('parametrage-signaux', ['tab' => 'timeframes']) }}"
        class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">{{ __('Cancel') }}</a>
</div>
