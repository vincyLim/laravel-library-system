{{--
{{dd($productDetails)}}
--}}

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spectral&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.css" rel="stylesheet"
        integrity="sha384-2vMryTPZxTZDZ3GnMBDVQV8OtmoutdrfJxnDTg0bVam9mZhi7Zr3J1+lkVFRr71f" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/star-rating-svg@3.5.0/src/css/star-rating-svg.min.css" rel="stylesheet">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        /* Custom previous button */
        .slick-prev:before {
            color: black;
            font-size: 30px;
        }

        /* Custom next button */
        .slick-next:before {
            color: black;
            font-size: 30px;
        }

        .slick-slide {
            height: auto !important;
        }

        .book-grid {
            min-height: auto !important;
            height: auto !important;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h6 {
            font-family: "Spectral", serif;
        }
    </style>

    @stack('style')

</head>

<body style="background-color: #FFF8DE">

    @if (session('success'))
        <div id="success-alert"
            class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x shadow-lg"
            style="z-index: 1050; width: auto; max-width: 500px; margin-top: 20px; transition: opacity 0.5s ease-out, transform 0.5s ease-out; opacity: 1; transform: translateY(0);">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem;"></i>
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{--{{dd($products)}}--}}

    @yield("layout")

    <!-- Add these before closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.5.2.min.js"
        integrity="sha256-ocUeptHNod0gW2X1Z+ol3ONVAGWzIJXUmIs+4nUeDLI=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.js"
        integrity="sha384-2Ul6oqy3mEjM7dBJzKOck1Qb/mzlO+k/0BQv3D3C7u+Ri9+7OBINGa24AeOv5rgu"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/star-rating-svg@3.5.0/dist/jquery.star-rating-svg.min.js"></script>
    <script>
        $(document).ready(function () {
            var $alert = $("#success-alert");

            if ($alert.length) {
                setTimeout(function () {
                    $alert.css({
                        'opacity': '0',
                        'transform': 'translateY(-20px)'
                    });

                    setTimeout(function () {
                        $alert.remove();
                    }, 500);
                }, 3000);
            }

            new DataTable('.table',{
                scrollY: '45vh',
            })

            $('.formSelect').select2({
                width: '100%',
            });

            $('.formMultiSelect').select2({
                width: '100%',
                multiple: true
            })

            $('.formSelfSelect').select2({
                width: '100%',
                tags: true, // Allows new values
                tokenSeparators: [','], // Optional: Separate new values by comma or space
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true // Identifies new tags
                    };
                }
            })

            $(".formSelfMultiSelect").select2({
                width: '100%',
                tags: true,
                multiple: true,
                tokenSeparators: [','],
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true
                    };
                }
            });
        });
    </script>

    <script src="{{ asset('js/slide.js') }}" defer></script>
    <script src="{{ asset('js/animation.js') }}" defer></script>
    {{--{{dd($cartItems)}}--}}

    @stack('script')
</body>

</html>
