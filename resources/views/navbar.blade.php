<nav class="bg-white border-gray-200 shadow dark:bg-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Voltaica</span>
        </a>

        <!-- Logout Button -->
        <div class="flex items-center md:order-2">
            @auth
                <form method="POST" action="/logout" class="flex">
                    @csrf
                    <button type="submit" class="text-sm text-gray-700 dark:text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 rounded-lg px-4 py-2">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
