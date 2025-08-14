<div>
    <label for="plan_id" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Plan') }} <span
            class="text-red-500">*</span></label>
    <select name="plan_id" id="plan_id"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('plan_id') border-red-500 @enderror"
        required>
        <option value="">{{ __('Sélectionnez un plan') }}</option>
        @foreach ($plans as $plan)
            <option value="{{ $plan->id }}"
                {{ old('plan_id', $accessCode?->plan_id) == $plan->id ? 'selected' : '' }}>
                {{ $plan->Titre }} - {{ $plan->Prix }} {{ $plan->Devise }} ({{ $plan->DureeEnJours }} jours)
            </option>
        @endforeach
    </select>
    @error('plan_id')
        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Code d\'accès') }} <span
            class="text-red-500">*</span></label>
    <div class="flex gap-2">
        <input type="text" name="Code" id="code"
            class="flex-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono @error('Code') border-red-500 @enderror"
            value="{{ old('Code', $accessCode?->Code ?? ($generatedCode ?? '')) }}" placeholder="Code de 10 caractères"
            maxlength="10" required>
        <button type="button" onclick="generateNewCode()"
            class="px-3 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                </path>
            </svg>
        </button>
    </div>
    @error('Code')
        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
    @enderror
    <p class="mt-1 text-xs text-gray-500">Code de 10 caractères (lettres et chiffres). Un code a été généré
        automatiquement mais vous pouvez le modifier.</p>
</div>

<div>
    <label for="duree_en_jours" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Durée en jours') }} <span
            class="text-red-500">*</span></label>
    <input type="number" name="DureeEnJours" id="duree_en_jours"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('DureeEnJours') border-red-500 @enderror"
        value="{{ old('DureeEnJours', $accessCode?->DureeEnJours) }}" placeholder="Nombre de jours" min="1"
        required>
    @error('DureeEnJours')
        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="compteur_max"
        class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nombre maximum d\'utilisations') }} <span
            class="text-red-500">*</span></label>
    <input type="number" name="CompteurMax" id="compteur_max"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('CompteurMax') border-red-500 @enderror"
        value="{{ old('CompteurMax', $accessCode?->CompteurMax) }}" placeholder="Nombre maximum d'utilisations"
        min="1" required>
    @error('CompteurMax')
        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="expire_le" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Date d\'expiration') }} <span
            class="text-red-500">*</span></label>
    <input type="date" name="ExpireLe" id="expire_le"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('ExpireLe') border-red-500 @enderror"
        value="{{ old('ExpireLe', $accessCode?->ExpireLe?->format('Y-m-d')) }}"
        min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
    @error('ExpireLe')
        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>

<div class="flex gap-2 mt-6">
    <button type="submit"
        class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">{{ __('Enregistrer') }}</button>
    <a href="{{ route('access-codes.index') }}"
        class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">{{ __('Annuler') }}</a>
</div>

<script>
    function generateNewCode() {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = '';
        for (let i = 0; i < 10; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        document.getElementById('code').value = result;
    }

    // Auto-remplir la durée en jours basée sur le plan sélectionné
    document.getElementById('plan_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            // Extraire la durée du texte de l'option (format: "Titre - Prix Devise (X jours)")
            const text = selectedOption.text;
            const match = text.match(/\((\d+) jours\)/);
            if (match) {
                document.getElementById('duree_en_jours').value = match[1];
            }
        }
    });
</script>
