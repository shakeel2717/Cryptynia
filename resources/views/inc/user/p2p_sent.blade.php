@if (auth()->user()->confirmOrders()->count() > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body mb-4">
                <h2 class="card-title">Your Pending Orders</h2>
                @forelse (auth()->user()->confirmOrders as $order)
                    <div class="card shadow-lg mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <p>A Buyer Sent you Payment, Please click Confirm if you Recieved Payment in your
                                        Bank Account, once you click confirm, this order will be closed.</p>
                                    <h4 class="mb-2 text-uppercase">You Recieved Rs:
                                        {{ number_format($order->exchange->amount * $order->exchange->price, 2) }}/-
                                    </h4>

                                    <h4 class="mb-2 text-uppercase">here is Proof</h4>
                                    <div class="my-2">
                                        <a href="{{ asset('orders') }}/{{ $order->screenshot }}"><img src="{{ asset('orders') }}/{{ $order->screenshot }}" alt="" width="200" height="200"></a>
                                        
                                    </div>

                                    <hr>

                                    <form action="{{ route('user.order-confirm.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-primary">Confirm Payment</button>
                                    </form>
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
