@extends('layout.dashboard')
@section('styles')
    <style>
        .tf-tree {
            font-size: 16px;
            overflow: auto
        }

        .tf-tree ul {
            display: inline-flex
        }

        .tf-tree li {
            align-items: center;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            padding: 0 1em;
            position: relative
        }

        .tf-tree li ul {
            margin: 2em 0
        }

        .tf-tree li li:before {
            border-top: .0625em solid #000;
            content: "";
            display: block;
            height: .0625em;
            left: -.03125em;
            position: absolute;
            top: -1.03125em;
            width: 100%
        }

        .tf-tree li li:first-child:before {
            left: calc(50% - .03125em);
            max-width: calc(50% + .0625em)
        }

        .tf-tree li li:last-child:before {
            left: auto;
            max-width: calc(50% + .0625em);
            right: calc(50% - .03125em)
        }

        .tf-tree li li:only-child:before {
            display: none
        }

        .tf-tree li li:only-child>.tf-nc:before,
        .tf-tree li li:only-child>.tf-node-content:before {
            height: 1.0625em;
            top: -1.0625em
        }

        .tf-tree .tf-nc,
        .tf-tree .tf-node-content {
            /* border: .0625em solid #000; */
            /* display: inline-block; */
            /* padding: .5em 1em; */
            position: relative
        }

        .tf-tree .tf-nc:before,
        .tf-tree .tf-node-content:before {
            top: -1.03125em
        }

        .tf-tree .tf-nc:after,
        .tf-tree .tf-nc:before,
        .tf-tree .tf-node-content:after,
        .tf-tree .tf-node-content:before {
            border-left: .0625em solid #000;
            content: "";
            display: block;
            height: 1em;
            left: calc(50% - .03125em);
            position: absolute;
            width: .0625em
        }

        .tf-tree .tf-nc:after,
        .tf-tree .tf-node-content:after {
            top: calc(100% + .03125em)
        }

        .tf-tree .tf-nc:only-child:after,
        .tf-tree .tf-node-content:only-child:after,
        .tf-tree>ul>li>.tf-nc:before,
        .tf-tree>ul>li>.tf-node-content:before {
            display: none
        }

        .tf-tree.tf-gap-sm li {
            padding: 0 .6em
        }

        .tf-tree.tf-gap-sm li>.tf-nc:before,
        .tf-tree.tf-gap-sm li>.tf-node-content:before {
            height: .6em;
            top: -.6em
        }

        .tf-tree.tf-gap-sm li>.tf-nc:after,
        .tf-tree.tf-gap-sm li>.tf-node-content:after {
            height: .6em
        }

        .tf-tree.tf-gap-sm li ul {
            margin: 1.2em 0
        }

        .tf-tree.tf-gap-sm li li:before {
            top: -.63125em
        }

        .tf-tree.tf-gap-sm li li:only-child>.tf-nc:before,
        .tf-tree.tf-gap-sm li li:only-child>.tf-node-content:before {
            height: .6625em;
            top: -.6625em
        }

        .tf-tree.tf-gap-lg li {
            padding: 0 1.5em
        }

        .tf-tree.tf-gap-lg li>.tf-nc:before,
        .tf-tree.tf-gap-lg li>.tf-node-content:before {
            height: 1.5em;
            top: -1.5em
        }

        .tf-tree.tf-gap-lg li>.tf-nc:after,
        .tf-tree.tf-gap-lg li>.tf-node-content:after {
            height: 1.5em
        }

        .tf-tree.tf-gap-lg li ul {
            margin: 3em 0
        }

        .tf-tree.tf-gap-lg li li:before {
            top: -1.53125em
        }

        .tf-tree.tf-gap-lg li li:only-child>.tf-nc:before,
        .tf-tree.tf-gap-lg li li:only-child>.tf-node-content:before {
            height: 1.5625em;
            top: -1.5625em
        }

        .tf-tree li.tf-dotted-children .tf-nc:after,
        .tf-tree li.tf-dotted-children .tf-nc:before,
        .tf-tree li.tf-dotted-children .tf-node-content:after,
        .tf-tree li.tf-dotted-children .tf-node-content:before {
            border-left-style: dotted
        }

        .tf-tree li.tf-dotted-children li:before {
            border-top-style: dotted
        }

        .tf-tree li.tf-dotted-children>.tf-nc:before,
        .tf-tree li.tf-dotted-children>.tf-node-content:before {
            border-left-style: solid
        }

        .tf-tree li.tf-dashed-children .tf-nc:after,
        .tf-tree li.tf-dashed-children .tf-nc:before,
        .tf-tree li.tf-dashed-children .tf-node-content:after,
        .tf-tree li.tf-dashed-children .tf-node-content:before {
            border-left-style: dashed
        }

        .tf-tree li.tf-dashed-children li:before {
            border-top-style: dashed
        }

        .tf-tree li.tf-dashed-children>.tf-nc:before,
        .tf-tree li.tf-dashed-children>.tf-node-content:before {
            border-left-style: solid
        }
    </style>
    <style>
        .user-img {
            width: 70px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .tf-nc {
            text-align: center;
        }

        @media (max-width: 768px) {

            .tf-tree ul {
                box-sizing: border-box;
                margin: 0;
                padding: 0
            }

            .tf-tree li {
                padding: 0px 0.5px;
            }

            .tf-tree .tf-nc,
            .tf-tree .tf-node-content {
                padding: 0;
            }

            .user-img {
                width: 40px;
            }

            .user-title {
                font-size: 10px;
            }

            .tf-nc {
                text-align: center;
                min-width: 30px;
            }

            .level-3-title {
                display: none;
            }
        }
    </style>
@endsection
@section('title', 'Deposit')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @livewire('search')
                <div class="tf-tree d-flex justify-content-center">
                    <ul>
                        <li>
                            @php
                                $level = 1;
                            @endphp
                            <span class="tf-nc">
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#TreeDetail{{ $user->id }}">
                                    <img class="user-img"
                                        src="{{ asset($user->status == 'active' ? 'binary-img-success.png' : 'binary-img-primary.png') }}"
                                        alt="Image">
                                </a>
                                <p class="user-title text-uppercase level-{{ $level }}-title">{{ $user->username }}</p>
                                @include('inc.tree-detail', ['user' => $user->id])
                            </span>
                            <ul>
                                @if ($user->left_user)
                                    @include('inc.binary_subtree', [
                                        'subuser' => $user->left_user,
                                        'level' => 1,
                                    ])
                                @else
                                    @include('inc.binary_single_empty', [
                                        'subuser' => $user->right_user,
                                        'level' => 1,
                                    ])
                                @endif
                                @if ($user->right_user)
                                    @include('inc.binary_subtree', [
                                        'subuser' => $user->right_user,
                                        'level' => 1,
                                    ])
                                @else
                                    @include('inc.binary_single_empty', [
                                        'subuser' => $user->right_user,
                                        'level' => 1,
                                    ])
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
