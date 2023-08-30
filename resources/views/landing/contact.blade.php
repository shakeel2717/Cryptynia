@extends('layout.app')
@section('content')
    <section class="contact-one-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="contact-one-image">
                        <img src="/landing/about.jpg" alt="">
                    </div>
                </div>
                <div class="col-xl-6">
                    <form action="{{ route('contact.store') }}" class="contact-one-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="input-box">
                                    <input type="text" name="name" placeholder="Your name">
                                    <div data-lastpass-icon-root="true"
                                        style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="input-box">
                                    <input type="email" name="email" placeholder="Your E-mail">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="input-box">
                                    <input type="text" name="phone" placeholder="Phone" spellcheck="false"
                                        data-ms-editor="true">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="input-box">
                                    <textarea name="message" placeholder="Your Message" spellcheck="false" data-ms-editor="true"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact__btn">
                                    <button type="submit" class="theme-btn">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
