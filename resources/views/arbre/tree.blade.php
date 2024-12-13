@extends('base')

@section('content')
    <div class="flex h-screen bg-gray-100">
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-semibold mb-4">Arbre Hiérarchique</h1>
            <p class="text-gray-600 mb-6">Naviguez dans l'arbre hiérarchique organisé en colonnes.</p>

            <!-- Conteneur de l'arbre -->
            <div class="bg-white p-6 mt-6 rounded-lg shadow-md overflow-auto" style="height: 75vh;">
                <div id="tree-container" class="flex w-full space-x-4">
                    @if($tree)
                        @include('arbre.tree-column', ['nodes' => [$tree]])
                    @else
                        <p class="text-gray-600 text-center">Aucun collaborateur trouvé.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
