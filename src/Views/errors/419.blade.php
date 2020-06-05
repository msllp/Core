@if(!env('MS_DEBUG'))
    @extends('MS::core.layouts.rootRaw')
@else
    @extends('MS::core.layouts.root')
@endif

@section('body')
    <section class="error_two_area">
        <div class="container flex">
            <div class="error_content_two text-center">
                <img src="{{secure_asset('images/500.svg')}}" class="ms-error-img" alt="">
                <h2>Oopps.This is awkward...</h2>
                <p>You are looking for something that doesn't actually exist.</p>

                <a href="{{url('/')}}" class="about_btn btn_hover"><i class="arrow_left"></i> Back to Home Page </a>
            </div>
        </div>
    </section>


@endsection
