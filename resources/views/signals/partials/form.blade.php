<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-5">
        <div>
            <label for="Direction" class="block text-sm font-medium text-gray-700 mb-1">Direction *</label>
            <select name="Direction"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                required>
                <option value="BUY" {{ old('Direction', $signal->Direction ?? '') == 'BUY' ? 'selected' : '' }}>↗️ BUY
                    (Achat)</option>
                <option value="SELL" {{ old('Direction', $signal->Direction ?? '') == 'SELL' ? 'selected' : '' }}>↘️
                    SELL (Vente)</option>
            </select>
        </div>
        <div>
            <label for="session_id" class="block text-sm font-medium text-gray-700 mb-1">Session de trading *</label>
            <select name="session_id"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                required>
                <option value="">Sélectionnez une session</option>
                @foreach ($sessions as $session)
                    <option value="{{ $session->id }}"
                        {{ old('session_id', $signal->session_id ?? '') == $session->id ? 'selected' : '' }}>
                        {{ $session->Titre }} ({{ $session->HeureDebut }} - {{ $session->HeureFin }})
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Utilisateur *</label>
            <select name="user_id"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                required>
                <option value="">Sélectionnez un utilisateur</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('user_id', $signal->user_id ?? auth()->id()) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="Actifs" class="block text-sm font-medium text-gray-700 mb-1">Actif *</label>
            <input type="text" name="Actifs"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                value="{{ old('Actifs', $signal->Actifs ?? '') }}" placeholder="Sélectionnez un actif" required>
        </div>
        <div>
            <label for="PrixEntree" class="block text-sm font-medium text-gray-700 mb-1">Prix d'entrée *</label>
            <input type="number" step="0.0001" name="PrixEntree"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                value="{{ old('PrixEntree', $signal->PrixEntree ?? '') }}" required>
        </div>
        <div>
            <label for="Timeframe" class="block text-sm font-medium text-gray-700 mb-1">Timeframe</label>
            <input type="text" name="Timeframe"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                value="{{ old('Timeframe', $signal->Timeframe ?? '') }}" placeholder="H1, M15...">
        </div>
        <div>
            <label for="Status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
            <select name="Status"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2">
                <option value="EN ATTENTE"
                    {{ old('Status', $signal->Status ?? '') == 'EN ATTENTE' ? 'selected' : '' }}>
                    En attente</option>
                <option value="EN COURS" {{ old('Status', $signal->Status ?? '') == 'EN COURS' ? 'selected' : '' }}>En
                    cours</option>
                <option value="TERMINE" {{ old('Status', $signal->Status ?? '') == 'TERMINE' ? 'selected' : '' }}>
                    Terminé</option>
                <option value="ANNULE" {{ old('Status', $signal->Status ?? '') == 'ANNULE' ? 'selected' : '' }}>Annulé
                </option>
            </select>
        </div>
        <div>
            <label for="Resultat" class="block text-sm font-medium text-gray-700 mb-1">Résultat</label>
            <select name="Resultat"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2">
                <option value="PENDING"
                    {{ old('Resultat', $signal->Resultat ?? 'PENDING') == 'PENDING' ? 'selected' : '' }}>
                    🔄 En attente</option>
                <option value="WIN" {{ old('Resultat', $signal->Resultat ?? '') == 'WIN' ? 'selected' : '' }}>
                    ✅ Gagnant</option>
                <option value="LOSE" {{ old('Resultat', $signal->Resultat ?? '') == 'LOSE' ? 'selected' : '' }}>
                    ❌ Perdant</option>
                <option value="BREAK-EVEN"
                    {{ old('Resultat', $signal->Resultat ?? '') == 'BREAK-EVEN' ? 'selected' : '' }}>
                    ⚖️ Break-even</option>
            </select>
        </div>
    </div>
    <div class="space-y-5">
        <div class="flex gap-4">
            <div class="flex-1 bg-green-50 border border-green-200 rounded-lg p-3">
                <div class="flex items-center gap-2 mb-1 text-green-700 font-semibold"><span>🟢</span> Take Profit</div>
                <input type="number" step="0.0001" name="TakeProfit"
                    class="w-full border border-green-200 rounded-lg focus:ring-green-400 focus:border-green-400 py-2 bg-green-50"
                    value="{{ old('TakeProfit', $signal->TakeProfit ?? '') }}" placeholder="1.0925">
            </div>
            <div class="flex-1 bg-red-50 border border-red-200 rounded-lg p-3">
                <div class="flex items-center gap-2 mb-1 text-red-700 font-semibold"><span>🛡️</span> Stop Loss</div>
                <input type="number" step="0.0001" name="StopLoss"
                    class="w-full border border-red-200 rounded-lg focus:ring-red-400 focus:border-red-400 py-2 bg-red-50"
                    value="{{ old('StopLoss', $signal->StopLoss ?? '') }}" placeholder="1.0850">
            </div>
        </div>
        <div class="flex gap-4">
            <div class="flex-1 bg-blue-50 border border-blue-200 rounded-lg p-3">
                <div class="flex items-center gap-2 mb-1 text-blue-700 font-semibold"><span>💰</span> Prix de sortie
                    réelle</div>
                <input type="number" step="0.0001" name="PrixSortieReelle"
                    class="w-full border border-blue-200 rounded-lg focus:ring-blue-400 focus:border-blue-400 py-2 bg-blue-50"
                    value="{{ old('PrixSortieReelle', $signal->PrixSortieReelle ?? '') }}" placeholder="1.0890">
            </div>
            <div class="flex-1 bg-purple-50 border border-purple-200 rounded-lg p-3">
                <div class="flex items-center gap-2 mb-1 text-purple-700 font-semibold"><span>📊</span> Pips</div>
                <input type="number" name="Pips"
                    class="w-full border border-purple-200 rounded-lg focus:ring-purple-400 focus:border-purple-400 py-2 bg-purple-50"
                    value="{{ old('Pips', $signal->Pips ?? '') }}" placeholder="25">
            </div>
        </div>
        <div class="flex gap-4">
            <div class="flex-1">
                <label for="DateHeureEmission" class="block text-sm font-medium text-gray-700 mb-1">🕒 Date d'émission
                    *</label>
                <input type="datetime-local" name="DateHeureEmission"
                    class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                    value="{{ old('DateHeureEmission', isset($signal) ? date('Y-m-d\TH:i', strtotime($signal->DateHeureEmission)) : '') }}"
                    required placeholder="jj/mm/aaaa --:--">
            </div>
            <div class="flex-1">
                <label for="DateHeureExpire" class="block text-sm font-medium text-gray-700 mb-1">🕒 Date d'expiration
                    *</label>
                <input type="datetime-local" name="DateHeureExpire"
                    class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                    value="{{ old('DateHeureExpire', isset($signal) ? date('Y-m-d\TH:i', strtotime($signal->DateHeureExpire)) : '') }}"
                    required placeholder="jj/mm/aaaa --:--">
            </div>
            <div class="flex-1">
                <label for="DureeTrade" class="block text-sm font-medium text-gray-700 mb-1">⏱️ Durée du trade
                    *</label>
                <input type="time" name="DureeTrade"
                    class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                    value="{{ old('DureeTrade', isset($signal) && $signal->DureeTrade ? date('H:i', strtotime($signal->DureeTrade)) : '') }}"
                    required placeholder="--:--">
            </div>
        </div>
        <div>
            <label for="Confiance" class="block text-sm font-medium text-gray-700 mb-1">Niveau de confiance: <span
                    id="confiance-value">{{ old('Confiance', $signal->Confiance ?? 75) }}%</span></label>
            <input type="range" name="Confiance" min="1" max="100"
                value="{{ old('Confiance', $signal->Confiance ?? 75) }}" class="w-full accent-blue-500"
                oninput="document.getElementById('confiance-value').innerText = this.value + '%'">
            <div class="flex justify-between text-xs text-gray-400 mt-1">
                <span>Faible (1%)</span>
                <span>Modéré (50%)</span>
                <span>Élevé (100%)</span>
            </div>
        </div>
        <div>
            <label for="Commentaire" class="block text-sm font-medium text-gray-700 mb-1">💬 Commentaire</label>
            <textarea name="Commentaire"
                class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                rows="2" placeholder="Analyse technique, contexte fondamental, etc.">{{ old('Commentaire', $signal->Commentaire ?? '') }}</textarea>
        </div>
    </div>
</div>
