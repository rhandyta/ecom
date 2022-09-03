<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $status, $brand_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',
        ];
    }

    public function resetForm()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
    }

    public function closeModal()
    {
        $this->resetForm();
    }

    public function openModal()
    {
        $this->resetForm();
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(25);
        return view('livewire.admin.brand.index', compact('brands'))
            ->extends('layouts.admin')
            ->section('content');
    }

    public function storeBrand()
    {
        $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => \Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0'
        ]);
        session()->flash('message', 'Brand added successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function editBrand($brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
        ]);
        session()->flash('message', 'Brand has been updated successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand has been deleted successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }
}
