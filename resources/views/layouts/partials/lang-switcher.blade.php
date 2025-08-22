<div class="flex items-center gap-1">
    <form action="{{ route('locale.switch', ['locale' => 'fr']) }}" method="POST">
        @csrf
        <button type="submit"
            class="px-2 py-1 text-xs rounded {{ app()->getLocale() === 'fr' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">FR</button>
    </form>
    <form action="{{ route('locale.switch', ['locale' => 'en']) }}" method="POST">
        @csrf
        <button type="submit"
            class="px-2 py-1 text-xs rounded {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">EN</button>
    </form>
</div>
