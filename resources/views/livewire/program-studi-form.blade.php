<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <input type="text" wire:model="name" placeholder="Nama Program Studi" class="form-control">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
    </form>
</div>
