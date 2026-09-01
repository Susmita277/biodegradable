<?php


namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Computed;
use Livewire\Component;

class UserProfile extends Component
{
    public $user;
    public $orders;
    public $activeTab = 'orders';
    public $name;
    
    // Password fields
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->loadOrders();

        // ✅ Set active tab based on current route
        $routeName = request()->route()->getName();
        if ($routeName === 'user.profile') {
            $this->activeTab = 'profile';
        } elseif ($routeName === 'user.orders') {
            $this->activeTab = 'orders';
        }
    }

    public function loadOrders()
    {
        $this->orders = Order::with(['items', 'district'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    #[Computed]
    public function initials()
    {
        $name = $this->user->name;
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        return substr($initials, 0, 2);
    }

    // ✅ Remove switchTab method - using direct links instead

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->user->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Profile updated successfully!');
        $this->user = auth()->user();
        $this->name = $this->user->name;
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Current password is incorrect.');
            return;
        }

        $this->user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        
        session()->flash('password_message', 'Password changed successfully!');
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
