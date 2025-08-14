<!-- Modal -->
<div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
        <form id="souscriptionForm" method="POST" action="{{ route('souscription.store') }}">
            @csrf
            <input type="hidden" name="plan_id" id="modalPlanId">
            <div class="modal-header">
                <h5 class="modal-title" id="planModalLabel">Récapitulatif du plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p><strong>Titre : </strong> <span id="modalPlanTitre"></span></p>
                <p><strong>Prix : </strong> <span id="modalPlanPrix"></span></p>
                <p><strong>Durée : </strong> <span id="modalPlanDuree"></span> jours</p>
                <ul id="modalPlanAvantages"></ul>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary" id="enregistrerPlan">Passer au paiement</button>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
       </form>
    </div>
  </div>
</div>
<script>
    const planButtons = document.querySelectorAll('.choose-btn');

    planButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.plan-card');
            const titre = card.querySelector('h3').innerText;
            const prix = card.querySelector('.price').innerText;
            const duree = card.querySelector('.price-period').innerText;
            const avantages = Array.from(card.querySelectorAll('.features li')).map(li => li.innerText);
            const planId = card.dataset.planId; // ajouter data-plan-id dans la card

            // Remplir le modal
            document.getElementById('modalPlanId').value = planId;
            document.getElementById('modalPlanTitre').innerText = titre;
            document.getElementById('modalPlanPrix').innerText = prix;
            document.getElementById('modalPlanDuree').innerText = duree;
            
            const ul = document.getElementById('modalPlanAvantages');
            ul.innerHTML = '';
            avantages.forEach(av => {
                const li = document.createElement('li');
                li.innerText = av;
                ul.appendChild(li);
            });

            // Ouvrir le modal
            const modal = new bootstrap.Modal(document.getElementById('planModal'));
            modal.show();
        });
    });
</script>

