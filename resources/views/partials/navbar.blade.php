<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">
            🛠️ Help Desk
        </a>

        <ul class="flex gap-6 text-gray-700">
            <li>
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('sobre') }}"
                   class="{{ request()->routeIs('sobre') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
                    Sobre
                </a>
            </li>

            <li>
                <a href="{{ route('tickets.index') }}"
                class="{{ request()->routeIs('tickets.*') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
                    Chamados
                </a>
            </li>

        </ul>
    </div>
</nav>