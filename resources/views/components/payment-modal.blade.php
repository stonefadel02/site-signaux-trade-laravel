{{-- resources/views/components/payment-modal.blade.php --}}

<div id="payment-modal" class="hidden fixed inset-0 z-50 backdrop-blur-md items-center justify-center p-4"
    aria-hidden="true">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 w-full max-w-lg rounded-lg bg-white text-gray-900 shadow-lg">
        <div class="flex items-center justify-between border-b px-5 py-4">
            <h3 id="payment-modal-title" class="text-lg font-semibold">Paiement</h3>
            <button type="button" id="payment-modal-close" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form id="payment-modal-form" class="px-5 py-4">
            @csrf
            <div class="space-y-4">
                <div class="relative overflow-hidden rounded-lg border border-slate-200 bg-slate-600 px-4 py-3">
                    <svg class="absolute inset-0 h-full w-full opacity-30 pointer-events-none" aria-hidden="true">
                        <defs>
                            <pattern id="pmCardGridPattern" width="24" height="24" patternUnits="userSpaceOnUse">
                                <path d="M 24 0 L 0 0 0 24" fill="none" stroke="currentColor" stroke-width="0.5">
                                </path>
                            </pattern>
                            <linearGradient id="pmCardFade" x1="1" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="white" stop-opacity="0.7" />
                                <stop offset="100%" stop-color="white" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#pmCardGridPattern)" class="text-slate-400">
                        </rect>
                        <rect width="100%" height="100%" fill="url(#pmCardFade)"></rect>
                    </svg>
                    <div class="relative z-10 text-white">
                        <div class="flex items-center justify-between py-1">
                            <span class="text-xs uppercase tracking-wide opacity-60">Plan</span>
                            <span id="payment-modal-plan" class="text-sm font-semibold "></span>
                        </div>
                        <div class="flex items-center justify-between py-1">
                            <span class="text-xs uppercase tracking-wide opacity-60">Montant à prélever</span>
                            <span id="payment-modal-amount" class="text-sm font-semibold "></span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1" for="pm-last">Nom</label>
                        <input id="pm-last" type="text"
                            class="w-full rounded-md border-gray-300 focus:border-cyan-500 focus:ring-cyan-500"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1" for="pm-first">Prénom</label>
                        <input id="pm-first" type="text"
                            class="w-full rounded-md border-gray-300 focus:border-cyan-500 focus:ring-cyan-500"
                            required />
                    </div>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1" for="pm-email">Email</label>
                    <input id="pm-email" type="email" name="email"
                        class="w-full rounded-md border-gray-300 focus:border-cyan-500 focus:ring-cyan-500" required />
                </div>

                <div id="payment-modal-switch" class="hidden">
                    <label class="block text-sm text-gray-700 mb-1">Quand appliquer le changement d'offre ?</label>
                    <div class="flex items-center gap-4">
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="pm-switch-mode" value="immediate" class="text-cyan-600" checked>
                            <span>Effet immédiat</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="pm-switch-mode" value="scheduled" class="text-cyan-600">
                            <span>A la fin de l'abonnement actuel</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3 border-t pt-4">
                <button type="button" id="payment-modal-cancel"
                    class="rounded-md border px-4 py-2 text-gray-700 hover:bg-gray-50">Annuler</button>
                <button type="submit"
                    class="rounded-md bg-slate-800 px-4 py-2 text-white font-semibold hover:bg-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-800">Passer
                    au paiement</button>
            </div>
        </form>
    </div>
</div>

@once
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            let currentButton = null;
            let currentForm = null;
            let currentAction = '';

            const root = document.getElementById('payment-modal');
            const title = document.getElementById('payment-modal-title');
            const plan = document.getElementById('payment-modal-plan');
            const amount = document.getElementById('payment-modal-amount');
            const first = document.getElementById('pm-first');
            const last = document.getElementById('pm-last');
            const email = document.getElementById('pm-email');
            const switchBlock = document.getElementById('payment-modal-switch');
            const form = document.getElementById('payment-modal-form');

            function show() {
                root.classList.remove('hidden');
                root.classList.add('flex');
            }

            function hide() {
                root.classList.add('hidden');
                root.classList.remove('flex');
            }

            function openFromButton(btn, opts = {}) {
                currentButton = btn;
                currentForm = btn.closest('form');
                currentAction = btn.dataset.action || '';

                const planTitle = btn.dataset.planTitle || '';
                const amountDisplay = btn.dataset.amountDisplay || '';

                // Fill texts
                title.textContent = currentAction === 'change-offer' ? 'Changement de formule' :
                    'Informations de facturation';
                plan.textContent = planTitle;
                amount.textContent = amountDisplay;

                // Prefill user fields
                let defFirst = btn.dataset.userFirst || '';
                let defLast = btn.dataset.userLast || '';
                const defEmail = btn.dataset.userEmail || '';
                if (!defFirst && !defLast && btn.dataset.userName) {
                    const parts = btn.dataset.userName.trim().split(/\s+/);
                    if (parts.length > 1) {
                        defFirst = parts[0];
                        defLast = parts.slice(1).join(' ');
                    } else {
                        defFirst = parts[0];
                    }
                }
                first.value = defFirst;
                last.value = defLast;
                email.value = defEmail;

                // Show/hide switch mode block
                if (currentAction === 'change-offer') {
                    switchBlock.classList.remove('hidden');
                    // Preselect radio if provided (from Swal)
                    const toCheck = (opts.switchMode === 'scheduled') ? 'scheduled' : 'immediate';
                    const radio = form.querySelector(`input[name="pm-switch-mode"][value="${toCheck}"]`);
                    if (radio) radio.checked = true;
                } else {
                    switchBlock.classList.add('hidden');
                }

                show();
            }

            async function confirmRenew() {
                const res = await Swal.fire({
                    title: 'Renouveler la formule ?',
                    text: "La nouvelle période sera ajoutée après la fin de l'abonnement actuel.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Oui renouveller',
                    cancelButtonText: 'Annuler'
                });
                return res.isConfirmed ? 'ok' : null;
            }

            async function confirmChangeOffer() {
                const res = await Swal.fire({
                    title: 'Changement de formule',
                    html: "Vous avez déjà un abonnement actif.<br> <b>Effet immédiat</b>: active maintenant la nouvelle formule et met fin à l'actuelle (jours restants perdus). <br><b>A la fin</b>: planifie la nouvelle formule après l'expiration de l'abonnement actuel.",
                    icon: 'info',
                    showCancelButton: true,
                    showDenyButton: true,
                    confirmButtonText: 'Effet immédiat',
                    denyButtonText: 'A la fin',
                    cancelButtonText: 'Annuler'
                });
                if (res.isConfirmed) return 'immediate';
                if (res.isDenied) return 'scheduled';
                return null;
            }

            function bind() {
                document.querySelectorAll('[data-action]')
                    .forEach(btn => {
                        btn.removeEventListener('click', btn.__pmHandler || (() => {}));
                        const handler = async (e) => {
                            e.preventDefault();
                            const action = btn.dataset.action;
                            let switchMode = '';
                            if (action === 'renew') {
                                const ok = await confirmRenew();
                                if (!ok) return;
                            } else if (action === 'change-offer') {
                                const mode = await confirmChangeOffer();
                                if (!mode) return; // cancelled
                                switchMode = mode;
                            }
                            openFromButton(btn, {
                                switchMode
                            });
                        };
                        btn.__pmHandler = handler;
                        btn.addEventListener('click', handler);
                    });
            }

            // Close handlers
            document.getElementById('payment-modal-close').addEventListener('click', hide);
            document.getElementById('payment-modal-cancel').addEventListener('click', hide);
            root.querySelector('.absolute.inset-0').addEventListener('click', hide);

            // Submit handler: fill originating form and submit
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                if (!currentForm) return hide();
                if (!first.value.trim() || !last.value.trim() || !email.value.trim()) {
                    // simple inline validation
                    [first, last, email].forEach(i => i.classList.add('ring-1', 'ring-red-500'));
                    setTimeout(() => [first, last, email].forEach(i => i.classList.remove('ring-1',
                        'ring-red-500')), 1200);
                    return;
                }
                currentForm.querySelector('[name="first_name"]').value = first.value.trim();
                currentForm.querySelector('[name="last_name"]').value = last.value.trim();
                currentForm.querySelector('[name="email_name"]').value = email.value.trim();
                if (currentForm.querySelector('[name="action_type"]')) {
                    currentForm.querySelector('[name="action_type"]').value = currentAction;
                }
                if (currentForm.querySelector('[name="switch_mode"]')) {
                    const mode = form.querySelector('input[name="pm-switch-mode"]:checked')?.value || '';
                    currentForm.querySelector('[name="switch_mode"]').value = currentAction === 'change-offer' ?
                        mode : '';
                }
                hide();
                currentForm.submit();
            });

            window.PaymentModal = {
                bind,
                openFromButton
            };
            document.addEventListener('DOMContentLoaded', bind);
        })
        ();
    </script>
@endonce
