<?php

namespace App\Livewire;

use Livewire\Component;
use App\Traits\HasPageBlocks;

/**
 * HasPageBlocks is the Trait to automatically load page blocks based on the calling class name.
 *
 * The trait uses the lowercase version of the class name to retrieve
 * corresponding page details from the database.
 *
 * Example:
 * For the `Auth` Livewire component, the associated page should be named `Auth`.
 */
class Auth extends Component
{
    use HasPageBlocks;

    public function render()
    {
        // You have $this->page, $this->seo and $this->blocks public property to access the page and block related data
        return view('livewire.auth');
    }
}
 