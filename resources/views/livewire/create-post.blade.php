<div>
    <x-danger-button wire:click="$set('open', true)">
        Crear nuevo post
    </x--danger-button>

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">

            <div clas="mb-4">
                <x-label value="Título del post" />
                <x-input type="text" class="w-full" wire:model="title" />


                <x-input-error for="title" />

                {{-- @error('title')
                    <span>
                        {{$message}}
                    </span>
                @enderror --}}

                
            </div>

            <div clas="mb-4">
                <x-label value="Contenido del post" />
                <textarea rows="6" class="form-control w-full" wire:model.defer="content"></textarea>

                <x-input-error for="content" />
               {{--  @error('content')
                    <span>
                        {{$message}}
                    </span>
                @enderror --}}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x--secondary-button>

            <x-danger-button wire:click="save">
                Crear Post
            </x--danger-button>
        </x-slot>
    </x--dialog-modal>
</div>
