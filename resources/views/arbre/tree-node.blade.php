
<div class="tree-node flex flex-col items-center mb-6">
    @php
        // Couleurs par ID de grade
        $gradeColors = [
            1 => 'bg-gray-100 border-gray-300 text-gray-800', // Chargé d'affaire
            2 => 'bg-blue-100 border-blue-300 text-blue-800', // Manager
            3 => 'bg-green-100 border-green-300 text-green-800', // Senior Manager
            4 => 'bg-yellow-100 border-yellow-300 text-yellow-800', // Executive Manager
            5 => 'bg-red-100 border-red-300 text-red-800', // Elite Manager
        ];

        // Déterminer la classe CSS selon le grade ID
        $gradeId = $node->grade->id ?? null;
        $gradeClass = $gradeColors[$gradeId] ?? 'bg-gray-50 border-gray-200 text-gray-700';
    @endphp

        <!-- Carte du collaborateur -->
    <div class="{{ $gradeClass }} border rounded-lg shadow-md p-4 text-center w-64">
        <h3 class="text-lg font-semibold">{{ $node->nom }} {{ $node->prenom }}</h3>
        <p class="text-sm">Téléphone : {{ $node->telephone ?? 'N/A' }}</p>
        @if($node->manager)
            <p class="text-sm">Manager : {{ $node->manager->nom ?? 'N/A' }}</p>
        @endif
        <p class="text-sm font-semibold mt-2">Grade : {{ $node->grade->libelle ?? 'N/A' }}</p>
    </div>

    <!-- Connecteur vertical -->
    @if($node->subordinates && $node->subordinates->count())
        <div class="flex items-center justify-center mt-4">
            <div class="w-0.5 h-8 bg-gray-300"></div>
        </div>
        <div class="flex justify-center space-x-6">
            @include('arbre.tree-column', ['nodes' => $node->subordinates])
        </div>
    @endif
</div>
