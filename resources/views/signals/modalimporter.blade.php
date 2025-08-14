<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Importer des données</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Informations :</strong><br>
                    - Le fichier doit être au format Excel : XLS, XLSX<br>
                    - Le fichier doit contenir les colonnes suivantes : Session, Date et heure d'émission, Date et heure d'expiration, Durée du trade, Timeframe, Prix d'entrée, Actif<br>
                    <hr>
                    <p>Si besoin, vous pouvez télécharger le fichier modèle vierge et remplir ensuite avec les données.</p>
                    <a href="{{ url('/download-template') }}" class="btn btn-sm btn-secondary mb-3 rounded-05">Télécharger le fichier modèle</a>
                </div>

                <form id="import-form" action="{{ route('import-signals') }}" method="POST" enctype="multipart/form-data" class="me-2">
                    @csrf
                    <label for="fileInput" class="form-label">Choisir un fichier</label>
                    <input type="file" id="fileInput" name="file" accept=".xlsx, .xls" required
                        class="border border-gray-300 rounded px-2 py-1 w-full">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary rounded-05" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-sm btn-primary rounded-05">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

