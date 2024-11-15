<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProgramStudi;

class ProgramStudiForm extends Component
{
    public $name;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        ProgramStudi::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Program Studi berhasil ditambahkan.');
        $this->reset('name');
    }

    public function render()
    {
        return view('livewire.program-studi-form');
    }
}

