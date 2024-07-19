<?php

namespace App\Livewire\Pizza;

use App\Models\Pizza;
use App\Models\PizzaSize;
use App\Models\Topping;
use Livewire\Component;

class Order extends Component
{
    public $pizzaId;

    public $pizzaSizeId;

    public $selectedToppingIds = [];

    public $totalPrice = 0;

    private $selectedPizza;

    private $selectedPizzaSize;

    public function render()
    {
        $pizzas = Pizza::get();
        $pizzaSizes = null;
        $toppings = collect();

        $this->selectedPizza = Pizza::find($this->pizzaId);
        $this->selectedPizzaSize = PizzaSize::find($this->pizzaSizeId);

        if ($this->selectedPizza) {
            $pizzaSizes = $this->selectedPizza->sizes()
                ->where('pizza_id', $this->pizzaId)
                ->get();

            if ($this->selectedPizzaSize) {
                $toppings = $this->selectedPizza->toppings;
                $toppings = $toppings->merge($this->selectedPizzaSize->toppings);
            }
        }

        return view('livewire.pizza.order', [
            'pizzas' => $pizzas,
            'pizzaSizes' => $pizzaSizes,
            'toppings' => $toppings,

        ]);
    }

    public function resetToppings()
    {
        $this->selectedToppingIds = [];
        $this->totalPrice = 0;
    }

    public function viewBill()
    {
        $this->totalPrice = 0;
        $pizzaSize = PizzaSize::find($this->pizzaSizeId);
        $this->totalPrice += $pizzaSize->price;

        $toppings = Topping::whereIn('id', $this->selectedToppingIds)->get();
        foreach ($toppings as $topping) {
            $this->totalPrice += $topping->price;
        }
    }
}
