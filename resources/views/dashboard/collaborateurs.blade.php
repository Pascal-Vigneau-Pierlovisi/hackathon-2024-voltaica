@extends('base')

@section('content')
    <div class="flex h-screen bg-gray-100">
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-semibold">Collaborateurs</h1>
            <p class="mt-4 text-gray-600">Liste des collaborateurs avec options de filtrage.</p>

            <!-- Formulaire de filtrage -->
            <div class="bg-white p-6 mt-6 rounded-lg shadow-md">
                <form method="GET" action="{{ route('collaborateurs') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Filtrer par nom -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="name" id="name" value="{{ request('name') }}"
                               class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="Rechercher un nom">
                    </div>

                    <!-- Filtrer par manager -->
                    <div>
                        <label for="manager" class="block text-sm font-medium text-gray-700">Manager</label>
                        <select name="manager" id="manager"
                                class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Tous les managers</option>
                            @foreach($managers as $manager)
                                <option value="{{ $manager->id }}" {{ request('manager') == $manager->id ? 'selected' : '' }}>
                                    {{ $manager->nom }} {{ $manager->prenom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bouton Filtrer -->
                    <div class="col-span-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Filtrer
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tableau des collaborateurs -->
            <div class="bg-white p-6 mt-8 rounded-lg shadow-md overflow-x-auto">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste des collaborateurs</h2>
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">Nom</th>
                        <th class="px-4 py-2 text-left text-gray-700">Prénom</th>
                        <th class="px-4 py-2 text-left text-gray-700">Téléphone</th>
                        <th class="px-4 py-2 text-left text-gray-700">Manager</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($caffs as $caff)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $caff->nom }}</td>
                            <td class="px-4 py-2">{{ $caff->prenom }}</td>
                            <td class="px-4 py-2">{{ $caff->telephone }}</td>
                            <td class="px-4 py-2">{{ $caff->manager->nom ?? 'N/A' }} {{ $caff->manager->prenom ?? '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Aucun collaborateur trouvé.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
