@if (session()->has('message'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded relative mb-4" role="alert">
        <h5 class="font-bold flex items-center mb-1">
            <i class="fa fa-info-circle mr-2"></i> Message !
        </h5>
        <div>
            {{ session('message') }}
        </div>
    </div>
@endif

@if (session()->has('successMessage'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative mb-4" role="alert">
        <h5 class="font-bold flex items-center mb-1">
            <i class="fa fa-check-circle mr-2"></i> Succès !
        </h5>
        <div>
            {{ session('successMessage') }}
        </div>
    </div>
@endif

@if (session()->has('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded relative mb-4" role="alert">
        <h5 class="font-bold flex items-center mb-1">
            <i class="fa fa-check-circle mr-2"></i> Succès !
        </h5>
        <div>
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session()->has('alertMessage'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded relative mb-4" role="alert">
        <h5 class="font-bold flex items-center mb-1">
            <i class="fa fa-warning mr-2"></i> Attention !
        </h5>
        <div>
            {{ session('alertMessage') }}
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded relative mb-4" role="alert">
        <h5 class="font-bold flex items-center mb-1">
            <i class="fa fa-circle-xmark text-red-500 mr-2"></i> Erreur !
        </h5>
        <div>
            {{ session('error') }}
        </div>
    </div>
@endif

@if (session()->has('errorMessage'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded relative mb-4" role="alert">
        <h5 class="font-bold flex items-center mb-1">
            <i class="fa fa-circle-xmark text-red-500 mr-2"></i> Erreur !
        </h5>
        <div>
            {{ session('errorMessage') }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded relative mb-4" role="alert">
        <div class="flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500 mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" fill="none" />
                    <path d="M10 10l4 4m0 -4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold">Oops !</h4>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if (session()->has('import_errors'))
    @foreach (session('import_errors') as $error)
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded relative mb-4" role="alert">
            <div class="flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <path d="M10 10l4 4m0 -4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold">Erreur à la ligne {{ $error['ligne'] }} !</h4>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($error['erreurs'] as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
    @php
        session()->forget('import_errors');
    @endphp
@endif
