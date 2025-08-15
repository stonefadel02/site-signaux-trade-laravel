<!-- Modal -->
<div x-show="openImportModal"
     x-transition
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-500 backdrop-blur-sm">
     
    <!-- Contenu du modal -->
    <div @click.away="openImportModal = false" 
         class="bg-white rounded-lg w-full max-w-2xl p-6 mx-2">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Importer des données</h2>
            <button @click="openImportModal = false" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
        </div>

        <!-- Info -->
        <div class="bg-blue-50 border border-blue-200 rounded p-3 mb-4 text-lg text-blue-800">
            <strong>Informations :</strong><br>
            - Le fichier doit être au format Excel : XLS, XLSX<br>
            - Colonnes attendues : Session, Date et heure d'émission, Date et heure d'expiration, Durée du trade, Timeframe, Prix d'entrée, Actif<br>
            <hr class="my-2">
            <p>Si besoin, vous pouvez télécharger le fichier modèle vierge et remplir ensuite avec les données.</p>
            <a href="{{ url('/download-template') }}"
                class="inline-block mt-2 px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded shadow transition">
                Télécharger le fichier modèle
            </a>


        </div>

        <!-- Formulaire -->
        <form action="{{ route('import-signals') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="fileInput" class="block mb-2 text-lg font-medium text-gray-700">Choisir un fichier</label>
            <input type="file" id="fileInput" name="file" accept=".xlsx, .xls" required
                   class="border border-gray-300 rounded px-2 py-1 w-full mb-4">

            <!-- Footer -->
            <div class="flex justify-end gap-2">
                <button type="button" @click="openImportModal = false"
                        class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Fermer</button>
                <button type="submit"
                        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Importer</button>
            </div>
        </form>

    </div>
</div>