@extends('layout.app')
@section('content')
    <section class="vs-blog-wrapper blog-details space-top space-extra-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-lg-8">
                    <div class="vs-blog blog-single">
                        <div class="blog-img">
                            <img src="{{ asset('assets/img/gallery/'.$post->id.'.jpg') }}" alt="Blog Image">
                        </div>
                        <div class="blog-content">
                            <a class="blog-date" href="blog.html">01 Jan, 2023</a>
                            <h2 class="blog-title">{{ $post->title }}</h2>
                            <p>{{ $post->body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
