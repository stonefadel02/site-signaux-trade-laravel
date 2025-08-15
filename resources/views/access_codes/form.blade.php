{{-- resources/views/access_codes/form.blade.php --}}
<div>
    <label for="plan_id" class="block text-sm font-medium text-gray-700">Plan</label>
    <select name="plan_id" id="plan_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
        @foreach($plans as $plan)
            <option value="{{ $plan->id }}" {{ isset($accessCode) && $accessCode->plan_id == $plan->id ? 'selected' : '' }}>
                {{ $plan->nom }} ({{ $plan->prix }}$)
            </option>
        @endforeach
    </select>
</div>
<div>
    <label for="DureeEnJours" class="block text-sm font-medium text-gray-700">Durée de validité (en jours)</label>
    <input type="number" name="DureeEnJours" id="DureeEnJours" value="{{ old('DureeEnJours', $accessCode->DureeEnJours ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500" required>
</div>

<div class="flex justify-end gap-4">
    <a href="{{ route('access-codes.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Annuler</a>
    <button type="submit" class="rounded-md border border-transparent bg-cyan-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-cyan-700">
        {{ $isUpdate ? 'Mettre à jour' : 'Générer' }}
    </button>
</div>