<div>
    <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="">Pizza</label>
                    <select name="pizza_id" id="pizza_id" class="form-control" wire:model.live="pizzaId">
                        <option value=""></option>
                        @forelse ($pizzas as $pizza)
                            <option value="{{ $pizza->id }}">{{ $pizza->name }}</option>
                        @empty
                            <option value="">No Pizza available</option>
                        @endforelse
                    </select>
                </div>
                @if ($pizzaId)
                    <div class="col-md-6">
                        <label for="">Size</label>
                        <select name="pizza_size_id" id="pizza_size_id" class="form-control" wire:model.live="pizzaSizeId" wire:change="resetToppings">
                            <option value=""></option>
                            @forelse ($pizzaSizes as $pizzaSize)
                                <option value="{{ $pizzaSize->id }}">{{ $pizzaSize->label }}</option>
                            @empty
                                <option value="">No Pizza sizes available</option>
                            @endforelse
                        </select>
                    </div>
                @endif

                @if ($pizzaSizeId && $toppings->count() > 0)
                    <div class="col-md-6">
                        @foreach ($toppings as $index => $topping)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $topping->id }}" id="topping_{{ $index }}" wire:model.live="selectedToppingIds">
                                <label class="form-check-label" for="topping_{{ $index }}">
                                    {{ $topping->label }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
    <div class="text-center mt-5">
        <button class="btn btn-primary" wire:click="viewBill">View Bill</button>
    </div>

    @if ($totalPrice > 0)
        <div class="text-center mt-4">
            <h1>Total Price: RM {{ $totalPrice }}</h1>
        </div>
    @endif
</div>
