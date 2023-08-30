<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            swal("oops!", "{!! $error !!}", "error");
        </script>
    @endforeach
@endif
@if (session('success') || session('status'))
    <script>
        swal("Success!", "{!! session('success') !!}", "success");
    </script>
@endif
@if (session('error'))
    <script>
        swal("oops!", "{!! session('error') !!}", "error");
    </script>
@endif
<script>
    window.addEventListener('deleted', event => {
        swal("Success!", event.detail.status, "success");
    })
</script>
<script>
    window.addEventListener('alert', event => {
        swal("Error!", event.detail.status, "error");
    })
</script>
<script>
    window.addEventListener('warning', event => {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // trigger a livewire event
                    Livewire.emit('confirmedDelete', event.detail.id);
                }
            });
    })
</script>
<script>
    function copyInputValue(inputId) {
        const inputElement = document.getElementById(inputId);
        if (inputElement) {
            inputElement.select();
            document.execCommand('copy');
        } else {
            alert('Input element not found!');
        }
    }
</script>
<script>
    window.addEventListener('txId', event => {
        swal("Transaction ID:", {
                content: "input",
            })
            .then((value) => {
                if (!value) {
                    swal('Please Enter Something');

                } else {
                    Livewire.emit('confirmedapprove', {
                        txId: value,
                        id: event.detail.id
                    });
                }
            });
    })
</script>
