<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Crear nuevo post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">

            <div clas="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input type="text" class="w-full" wire:model="title" />


                <x-jet-input-error for="title" />

                {{-- @error('title')
                    <span>
                        {{$message}}
                    </span>
                @enderror --}}

                
            </div>

            <div clas="mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea rows="6" class="form-control w-full" wire:model.defer="content"></textarea>

                <x-jet-input-error for="content" />
               {{--  @error('content')
                    <span>
                        {{$message}}
                    </span>
                @enderror --}}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save">
                Crear Post
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
