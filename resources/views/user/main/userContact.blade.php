@extends('user.layouts.master')
@section('content')
      <!-- Contact Start -->
      <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div>
                        @if (session('SentSuccess'))
                        <div class="custom-alert">
                            <div class="custom-alert-content">
                                <p>{{session('SentSuccess')}}</p>
                                <div class="close-alert">&times;</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <form action="{{route('contact#insert')}}" method="POST" name="sentMessage" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="control-group ">
                            <input type="hidden" value="{{Auth::user()->name}}" name="name" class="form-control" id="name" placeholder="Your Name"
                                required="required" data-validation-required-message="Please enter your name" />
                        </div>

                        <div class="control-group mt-3">
                            <input type="hidden" value="{{Auth::user()->email}}" name="email" class="form-control" id="email" placeholder="Your Email"
                                required="required" data-validation-required-message="Please enter your email" />
                        </div>

                        <div class="control-group mt-3">
                            <textarea name="message" class="form-control @error('message')
                                is-invalid
                            @enderror" rows="8" id="message" placeholder="Message"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>

                            @error('message')
                            <div class="invalid-feedback">
                                <span>{{$message}}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.1912101734074!2d96.19286217461601!3d16.86643321760485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c192fff9a7150b%3A0x6b8f8ba59c572158!2sPyi%20Tharyar%20St%201%2C%20Yangon!5e0!3m2!1sen!2smm!4v1727533333786!5m2!1sen!2smm"
                     width="100%" height="350px" style="border:0;" frameborder="0" tabindex="0" aria-hidden="false" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                {{-- <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
@section('scriptSource')
<script>
    // Use event delegation on a parent that is always in the DOM, like the body
    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('close-alert')) {
            document.querySelector('.custom-alert').style.display = 'none';
        }
    });
</script>
@endsection
