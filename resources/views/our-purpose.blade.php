@extends('layouts.misc')

@section('title')
    Our Purpose
@endsection

@section('styles')
    <style>
        body {
            font-family: "Poppins", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .banner {
            height: 278px;
            background-image: url('https://earthsafe.in/wp-content/uploads/2019/12/Bg_top.jpg');
            background-size: cover;
            background-position: center;
            margin-top: -4rem;
        }
    </style>
@endsection

@section('content')
    @include('partials.misc.header')

    <div class="flex items-center justify-center banner">
        <h1 class="text-4xl font-semibold text-center text-white uppercase">Our Purpose</h1>
    </div>

    <section>
        <div class="container py-10 mx-auto">
            <h1 class="text-4xl font-semibold text-blue-800 uppercase">Our Purpose</h1>
            <p class="my-10">Earth Safe Resources LLP was founded with a mission of ushering in a new era of sustainability
                in the
                e-commerce space and contribute to a cleaner and greener planet. India has banned plastic and the world is
                on a mission to remove single-use plastics from our day-to-day life. It is in this context that we have
                forged a relationship with our associate company Earth Save Private Limited, through which we will focus on
                the sales and marketing activities of reusable bags and masks to replace single-use plastic and reduce our
                carbon footprint.
                <br>
                <br>

                EarthSafe shall market and sell these cotton bags and provide the customer with an everlasting experience
                and fulfilment. Our logo clearly depicts that we care and carry mother earth and make it greener!
                <br>
                <br>

                What we do:
                <br>
                <br>

                Liaison with our associate company, create and market products that help accelerate our country’s transition
                towards a healthier, sustainable lifestyle. Our sales team ensures a smooth transition of products from
                order to delivery. We also proactively interact with our customers and constantly take feedback about our
                product with an aim to be the best for years to come.
                <br>
                <br>

                Check out our product page/shop for more details.
                <br>
                <br>

                EarthSafe offers you
                <br>
                <br>

                Eco-Friendly products
                Natural, reusable, sturdy products that are aesthetically appealing and economical.
                <br>
                <br>

                Wide range of Fabrics and Customization.
                We offer you an unmatched choice of fabrics to pick from and will customize the product as per your
                requirement.
                <br>
                <br>

                Best Quality
                Our stringent quality standards and multiple quality checks ensure that only the best products reach your
                hands, guaranteeing overall satisfaction.
            </p>
        </div>
    </section>

    @include('partials.misc.footer')
@endsection
