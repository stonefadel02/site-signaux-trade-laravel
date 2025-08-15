<div id="planModal" class="fixed inset-0 flex items-center justify-center z-50 hidden px-4">
    <div id="planModalOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
    <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
        <form id="souscriptionForm" method="POST" action="{{ route('souscription.store') }}">
            @csrf
            <input type="hidden" name="plan_id" id="modalPlanId">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Récapitulatif du plan</h2>
                <button type="button" id="closePlanModal" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
            </div>

            <div class="modal-body">
                <p><strong>Titre :</strong> <span id="modalPlanTitre"></span></p>
                <p><strong>Prix :</strong> <span id="modalPlanPrix"></span></p>
                <p><strong>Durée :</strong> <span id="modalPlanDuree"></span> jours</p>
                <ul id="modalPlanAvantages" class="list-disc list-inside mt-2 mb-4"></ul>
            </div>

            <div class="flex justify-end gap-2">
                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Passer au paiement
                </button>
                <button type="button" id="closePlanModalBtn" class="px-3 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Fermer
                </button>
            </div>
        </form>
    </div>
</div>
