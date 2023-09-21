@if (auth()->user()->orders->where('status', false)->count() > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body mb-4">
                <h2 class="card-title">Your Pending Orders</h2>
                @forelse (auth()->user()->orders->where('status',false) as $order)
                    <div class="card shadow-lg mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4 class="mb-2 text-uppercase"><small>You will Recieved: </small>
                                        ${{ number_format($order->amount, 2) }}/- </h4>

                                    <h6 class="text-uppercase mb-2">You Sent:
                                        {{ number_format($order->amount_in_pkr, 2) }} PKR</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-success">NO Transaction Found</h4>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endif
