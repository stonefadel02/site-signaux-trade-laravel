<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Ouvrir le modal
        document.querySelectorAll('[data-tw-toggle="modal"]').forEach(trigger => {
            trigger.addEventListener("click", () => {
                const targetSelector = trigger.getAttribute("data-tw-target");
                const modal = document.querySelector(targetSelector);
                if (modal) {
                    modal.classList.remove("hidden");
                    modal.classList.add("flex");
                }
            });
        });

        // Fermer le modal
        document.querySelectorAll('[data-tw-dismiss="modal"]').forEach(closeBtn => {
            closeBtn.addEventListener("click", () => {
                const modal = closeBtn.closest(".fixed");
                if (modal) {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }
            });
        });

        // Fermer en cliquant sur l'overlay
        document.querySelectorAll('.fixed.inset-0').forEach(modal => {
            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }
            });
        });
    });
</script>
