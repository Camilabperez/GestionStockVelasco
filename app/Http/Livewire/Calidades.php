<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Calidade;

class Calidades extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $medida, $precio;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.calidades.view', [
            'calidades' => Calidade::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('medida', 'LIKE', $keyWord)
						->orWhere('precio', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->name = null;
		$this->medida = null;
		$this->precio = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'medida' => 'required',
		'precio' => 'required',
        ]);

        Calidade::create([ 
			'name' => $this-> name,
			'medida' => $this-> medida,
			'precio' => $this-> precio
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Calidade Successfully created.');
    }

    public function edit($id)
    {
        $record = Calidade::findOrFail($id);
        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->medida = $record-> medida;
		$this->precio = $record-> precio;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'medida' => 'required',
		'precio' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Calidade::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'medida' => $this-> medida,
			'precio' => $this-> precio
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Calidade Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Calidade::where('id', $id)->delete();
        }
    }
}