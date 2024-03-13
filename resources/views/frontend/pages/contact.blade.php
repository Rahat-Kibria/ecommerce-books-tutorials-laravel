@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    {{-- contact area Start --}}
    <main class="contact_area inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact_form">
                        <h3 class="ct_title">Send Us a Message</h3>
                        <form action="{{ route('botu.feedback.submit') }}" method="post" class="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Your Name *</span></label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                        @if ($errors->has('name'))
                                            @foreach ($errors->get('name') as $error)
                                                <small class="text-danger">{{ $error }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">Your Email *</span></label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                        @if ($errors->has('email'))
                                            @foreach ($errors->get('email') as $error)
                                                <small class="text-danger">{{ $error }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="message">Your Message *</label>
                                        <textarea id="message" name="message" class="form-control"></textarea>
                                        @if ($errors->has('message'))
                                            @foreach ($errors->get('message') as $error)
                                                <small class="text-danger">{{ $error }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-btn">
                                        <button type="submit" value="submit" class="btn btn-black w-100"
                                            name="submit">send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-output">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div><iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.4348859478428!2d90.39854131442006!3d23.87419288995402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c43bb53306c9%3A0x8f9e832d2805182b!2z4KaJ4Kak4KeN4Kak4Kaw4Ka-IOCmueCmvuCmieCmnCDgpqzgpr_gprLgp43gpqHgpr_gpoI!5e0!3m2!1sbn!2sbd!4v1673987003204!5m2!1sbn!2sbd"
                            width="100%" height="512" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                </div>
            </div>
        </div>
    </main>
    {{-- contact area End --}}
    <div class="contact-bottom-info inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                {{-- Contact Information Start --}}
                <div class="col-lg-3 col-sm-6 col-12 mb-30">
                    <div class="contact-info">
                        <span class="icon"><i class="fa fa-phone"></i></span>
                        <div class="content">
                            <h3 class="title">Contact By Phone</h3>
                            <p>+880 12345-67890<br>+880 12345-67890</p>
                        </div>
                    </div>
                </div>
                {{-- Contact Information End --}}

                {{-- Contact Information Start --}}
                <div class="col-lg-3 col-sm-6 col-12 mb-30">
                    <div class="contact-info">
                        <span class="icon"><i class="fa fa-envelope"></i></span>
                        <div class="content">
                            <h3 class="title">Contact By Email</h3>
                            <p>contact@botu.com <br> info@botu.com</p>
                        </div>
                    </div>
                </div>
                {{-- Contact Information End --}}

                {{-- Contact Information Start --}}
                <div class="col-lg-3 col-sm-6 col-12 mb-30">
                    <div class="contact-info">
                        <span class="icon"><i class="fa fa-map-marker"></i></span>
                        <div class="content">
                            <h3 class="title">Come To See Us</h3>
                            <p>Uttara, Dhaka-1230 <br>Bangladesh</p>
                        </div>
                    </div>
                </div>
                {{-- Contact Information End --}}

                {{-- Contact Information Start --}}
                <div class="col-lg-3 col-sm-6 col-12 mb-30">
                    <div class="contact-info">
                        <span class="icon"><i class="fa fa-users"></i></span>
                        <div class="content">
                            <h3 class="title">Botu Social</h3>
                            <ul class="social-list list-inline">
                                <li class="single-social facebook"><a href="https://www.facebook.com/wahy100"
                                        target="_blank"><i class="ion ion-social-facebook"></i></a></li>
                                <li class="single-social twitter"><a href="https://twitter.com/rahatkibria1"
                                        target="_blank"><i class="ion ion-social-twitter"></i></a></li>
                                <li class="single-social youtube"><a href="https://www.youtube.com/@wahy100"
                                        target="_blank"><i class="ion ion-social-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- Contact Information End --}}
            </div>
        </div>
    </div>
@endsection
