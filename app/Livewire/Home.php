<?php

namespace App\Livewire;

use App\Traits\HasPageBlocks;
use Livewire\Component;

/**
 * HasPageBlocks is the Trait to automatically load page blocks based on the calling class name.
 *
 * The trait uses the lowercase version of the class name to retrieve
 * corresponding page details from the database.
 *
 * Example:
 * For the `Home` Livewire component, the associated page should be named `Home`.
 */
class Home extends Component
{
    use HasPageBlocks;

    public function render()
    {
        // You have $this->page, $this->seo and $this->blocks public property to access the page and block related data
        return view('livewire.home');
    }
}
