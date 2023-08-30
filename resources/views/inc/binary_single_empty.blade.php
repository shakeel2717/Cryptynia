@if ($level < 4)
    <li>
        <span class="tf-nc">
            <img class="user-img" src="{{ asset('assets/images/users/user-dummy-img.jpg') }}" alt="Image">
            <p class="user-title level-{{ $level }}-title">New SignUP</p>
        </span>
        <ul>
            @if ($level < 3)
                @include('inc.binary_subtree_empty', [
                    'subuser' => auth()->user()->right_user,
                    'level' => $level + 1,
                ])
            @endif
        </ul>
    </li>
@endif
