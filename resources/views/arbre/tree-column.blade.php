<div class="flex flex-col items-center w-full">
    @foreach($nodes as $node)
        @include('arbre.tree-node', ['node' => $node])
    @endforeach
</div>
