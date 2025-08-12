<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex w-full justify-center rounded-md bg-[#03194A] px-3 py-4 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900']) }}>
    {{ $slot }}
</button>
