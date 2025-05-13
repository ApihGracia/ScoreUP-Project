<?php

namespace App\Livewire;

use App\Models\Collage;
use Livewire\Component;
use Livewire\WithPagination;

class AdminHome extends Component
{
    use WithPagination;

    public $name, $description, $price, $id;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
    ];


    public function render()
    {
        // $this->validate();
        // $data['product'] = product::latest()->get(); //untuk susunan
        // $data['product'] = product::limit(10)->get(); //limit to 10 data only
        // $data['product'] = product::get();
        $data['products'] = Collage::paginate(10);
        // dd($data['product']); //untuk check data
        return view('livewire.product-index', $data);
    }

    public function save()
    {
        $this->validate();
        $input['name'] = $this->name;
        $input['description'] = $this->description;
        $input['price'] = $this->price;

        if ($this->updateMode) {
            $product = Collage::find($this->id);
            $product->update($input);
            session()->flash('message', 'Product Update');
            $this->updateMode = false;
        } else {
            $product = Collage::create($input);
            session()->flash('message', 'Product Created'); 
        }

        $this->reset(['name', 'description', 'price']);

        // Product::create($input);
        // session()->flash('message', 'Product Added');

        // $this->reset(['name', 'description', 'price']);
    }

    public function delete($id)
    {
        Collage::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully');
    }

    public function edit($id)
    {
        $product = Collage::findOrFail($id);
        $this->id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->updateMode = true;
    }
}
