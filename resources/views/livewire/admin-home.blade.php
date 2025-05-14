<div class="flex flex-col">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <h2>{{ $updateMode ? 'Edit Collage' : 'Add Collage' }} </h2>

    {{-- <form action=""> --}}
    <form wire:submit.prevent="save">
        {{-- <flux:input type="text" wire:model="name" placeholder="Product Name" class="w-full border p-2 mb-4"/>
        <flux:textarea wire:model="description" placeholder="Description" cols="30" rows="5" class="w-full border p-2 mb-4"/>
        <flux:input type="number" wire:model="price" placeholder="Price" class="w-full border p-2 mb-4"/> --}}
        <flux:input type="text" wire:model="name" placeholder="Collage Name" class="mb-4"/>
        <flux:textarea wire:model="description" placeholder="Description" cols="30" rows="5" class="mb-4"/>
        <flux:input type="number" wire:model="price" placeholder="Price" class="mb-4"/>
        <br>
        <flux:button type="submit" variant="primary">Submit</flux:button>
    </form>
    <br>

    @if(session('message'))
        <div class="text-green-600 p-4">{{ session('message') }}</div>
    @endif

    <table class="w-full border border-grey-200">
        <thead>
            <tr>
                <th class="border">#</th>
                <th class="border">Name</th>
                <th class="border">Describtion</th>
                <th class="border">Price</th>
                <th class="border">Button</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($collages as $index => $collage)
            <tr>
                {{-- <td class="border">{{ $loop->iteration }}</td> --}}
                <td class="border text-center p-2">{{ ($collages->currentPage() - 1)*$collages->perPage()+ ($index+1) }}</td>
                <td class="border p-2">{{  $collage->name }}</td>
                <td class="border px-2">{{  $collage->description }}</td>
                <td class="border p-2"><span class="flex justify-center"></span>{{  $collage->price }}</td>
                <td class="border text-center p-2">
                    {{-- <flux:button variant="primary">Edit</flux:button>
                    <flux:button variant="danger">Delete</flux:button> --}}
                    <flux:button wire:click="edit({{ $collage[ 'id'] }})" variant="primary">Edit</flux:button>
                    <flux:button wire:click="delete({{ $collage[ 'id'] }})" variant="danger">Delete</flux:button>
                </td>
            </tr>
            @empty
            <tr>
                No data
            </tr>
            @endforelse
        </tbody>
    </table>
    <div>
        {{ $collages -> links() }}
    </div>
</div>
