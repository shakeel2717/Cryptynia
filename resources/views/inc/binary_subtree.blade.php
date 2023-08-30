@if ($level < 4)
    <li>
        <span class="tf-nc ">
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#TreeDetail{{ $subuser->id }}">
                <img class="user-img"
                    src="{{ asset($subuser->status == 'active' ? 'binary-img-success.png' : 'binary-img-primary.png') }}"
                    alt="Image">
            </a>
            <a class="user-link text-dark" href="{{ route('user.tree.show', ['tree' => $subuser->id]) }}">
                <p class="user-title level-{{ $level }}-title text-uppercase">
                    {{ str($subuser->username)->limit(8) }}
            </a>
            </p>
        </span>
        @include('inc.tree-detail', ['user' => $subuser->id])
        <ul>
            @if ($subuser->left_user)
                @include('inc.binary_subtree', ['subuser' => $subuser->left_user, 'level' => $level + 1])
            @else
                @include('inc.binary_single_empty', [
                    'subuser' => $subuser->right_user,
                    'level' => $level + 1,
                ])
            @endif
            @if ($subuser->right_user)
                @include('inc.binary_subtree', ['subuser' => $subuser->right_user, 'level' => $level + 1])
            @else
                @include('inc.binary_single_empty', [
                    'subuser' => $subuser->right_user,
                    'level' => $level + 1,
                ])
            @endif
        </ul>
    </li>
@endif
