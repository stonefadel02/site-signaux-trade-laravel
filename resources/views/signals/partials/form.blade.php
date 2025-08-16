@php
    $selectedTimeframes = collect(
        old('timeframes', isset($signal) ? $signal->timeframes->pluck('Nom')->toArray() : []),
    );
    $selectedPlans = collect(old('plans', isset($signal) ? $signal->plans->pluck('id')->toArray() : []));
@endphp

<div class="space-y-10">
    <!-- Section Informations -->
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2"><span>🧾</span> Informations</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-5">
                <input type="hidden" name="user_id" value="{{ old('user_id', $signal->user_id ?? auth()->id()) }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Session de trading *</label>
                    <select name="session_id"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                        required>
                        <option value="">Sélectionnez une session</option>
                        @foreach ($sessions as $session)
                            <option value="{{ $session->id }}"
                                {{ old('session_id', $signal->session_id ?? '') == $session->id ? 'selected' : '' }}>
                                {{ $session->Titre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Actif *</label>
                    <select name="Actif"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                        required>
                        <option value="">Sélectionnez un actif</option>
                        @foreach ($actifs as $actif)
                            <option value="{{ $actif->id }}"
                                {{ old('Actif', $signal->Actif ?? '') == $actif->id ? 'selected' : '' }}>
                                {{ $actif->Nom ?? 'Actif #' . $actif->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Direction *</label>
                    <select name="Direction"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                        required>
                        <option value="BUY"
                            {{ old('Direction', $signal->Direction ?? 'BUY') == 'BUY' ? 'selected' : '' }}>↗️ BUY
                            (Achat)</option>
                        <option value="SELL"
                            {{ old('Direction', $signal->Direction ?? '') == 'SELL' ? 'selected' : '' }}>↘️ SELL (Vente)
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Prix d'entrée *</label>
                    <input type="number" step="0.0001" name="PrixEntree"
                        value="{{ old('PrixEntree', $signal->PrixEntree ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                        required>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">🕒 Date d'émission *</label>
                        <input type="datetime-local" name="DateHeureEmission"
                            value="{{ old('DateHeureEmission', isset($signal) ? date('Y-m-d\TH:i', strtotime($signal->DateHeureEmission)) : '') }}"
                            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                            required>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">🕒 Date d'expiration *</label>
                        <input type="datetime-local" name="DateHeureExpire"
                            value="{{ old('DateHeureExpire', isset($signal) ? date('Y-m-d\TH:i', strtotime($signal->DateHeureExpire)) : '') }}"
                            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                            required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">⏱️ Durée du trade *</label>
                    <input type="time" name="DureeTrade"
                        value="{{ old('DureeTrade', isset($signal) && $signal->DureeTrade ? date('H:i', strtotime($signal->DureeTrade)) : '') }}"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                        required>
                </div>
            </div>
            <div class="space-y-5">
                <div class="flex gap-4">
                    <div class="flex-1 bg-green-50 border border-green-200 rounded-lg p-3">
                        <div class="flex items-center gap-2 mb-1 text-green-700 font-semibold"><span>🟢</span> Take
                            Profit</div>
                        <input type="number" step="0.0001" name="TakeProfit"
                            value="{{ old('TakeProfit', $signal->TakeProfit ?? '') }}"
                            class="w-full border border-green-200 rounded-lg focus:ring-green-400 focus:border-green-400 py-2 bg-green-50"
                            placeholder="1.0925">
                    </div>
                    <div class="flex-1 bg-red-50 border border-red-200 rounded-lg p-3">
                        <div class="flex items-center gap-2 mb-1 text-red-700 font-semibold"><span>🛡️</span> Stop Loss
                        </div>
                        <input type="number" step="0.0001" name="StopLoss"
                            value="{{ old('StopLoss', $signal->StopLoss ?? '') }}"
                            class="w-full border border-red-200 rounded-lg focus:ring-red-400 focus:border-red-400 py-2 bg-red-50"
                            placeholder="1.0850">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Timeframes (multi)</label>
                    <select name="timeframes[]" multiple size="5"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2">
                        @foreach ($timeframes as $tf)
                            <option value="{{ $tf->Nom }}"
                                {{ $selectedTimeframes->contains($tf->Nom) ? 'selected' : '' }}>{{ $tf->Nom }}
                                {{ $tf->Description ? '— ' . $tf->Description : '' }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-400 mt-1">Maintenez CTRL (Windows) pour multi-sélection.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Plans associés (multi)</label>
                    <select name="plans[]" multiple size="4"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2">
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}"
                                {{ $selectedPlans->contains($plan->id) ? 'selected' : '' }}>{{ $plan->Titre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Niveau de confiance: <span
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">💬 Commentaire</label>
                    <textarea name="Commentaire" rows="3"
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                        placeholder="Analyse technique, contexte fondamental, etc.">{{ old('Commentaire', $signal->Commentaire ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Résultat -->
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2"><span>📈</span> Résultat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Résultat</label>
                <select name="Resultat"
                    class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2">
                    <option value="">-- Sélectionnez --</option>
                    <option value="PENDING"
                        {{ old('Resultat', $signal->Resultat ?? 'PENDING') == 'PENDING' ? 'selected' : '' }}>🔄 En
                        attente</option>
                    <option value="WIN" {{ old('Resultat', $signal->Resultat ?? '') == 'WIN' ? 'selected' : '' }}>✅
                        Gagnant</option>
                    <option value="LOSE" {{ old('Resultat', $signal->Resultat ?? '') == 'LOSE' ? 'selected' : '' }}>❌
                        Perdant</option>
                    <option value="BREAK-EVEN"
                        {{ old('Resultat', $signal->Resultat ?? '') == 'BREAK-EVEN' ? 'selected' : '' }}>⚖️ Break-even
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pips</label>
                <input type="number" name="Pips" value="{{ old('Pips', $signal->Pips ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                    placeholder="25">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prix de sortie réelle</label>
                <input type="number" step="0.0001" name="PrixSortieReelle"
                    value="{{ old('PrixSortieReelle', $signal->PrixSortieReelle ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-2"
                    placeholder="1.0890">
            </div>
        </div>
    </div>
</div>
