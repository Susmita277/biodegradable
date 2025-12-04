<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;
use App\Traits\HasPageBlocks;

/**
 * HasPageBlocks is the Trait to automatically load page blocks based on the calling class name.
 *
 * The trait uses the lowercase version of the class name to retrieve
 * corresponding page details from the database.
 *
 * Example:
 * For the `Contact` Livewire component, the associated page should be named `Contact`.
 */
class Contact extends Component
{
    use HasPageBlocks;
    
    public $name;
    public $email;
    public $message;
    public $successMessage;

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please provide name.',
            'email.required' => 'Please provide email.',
            'email.email' => 'Please provide email.',
            'message.required' => 'Please provide message.'
        ];
    }



    public function send()
    {
        $this->validate();

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->reset(array_keys($this->rules()));
        $this->successMessage = "Your message has been sent!";
    }




    public function render()
    {
        // You have $this->page, $this->seo and $this->blocks public property to access the page and block related data
        return view('livewire.contact');
    }
}
