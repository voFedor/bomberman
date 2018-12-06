
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/materialize.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/normalize.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/owl.carousel.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/owl.theme.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/owl.transitions.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/fakeLoader.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/animate.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/magnific-popup.css">
<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/style.css">

<link rel="shortcut icon" href="/template/mobile/{{env('MOBILE_THEME')}}/img/favicon.png">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<link rel="stylesheet" href="/template/mobile/{{env('MOBILE_THEME')}}/css/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.css">

<style>
    .modal-open .modal {
        overflow-x: hidden;
        overflow-y: auto;
    }
    @media only screen and (max-width: 992px)
        .modal {
            width: 80%;
        }
        .modal {
            display: none;
            position: fixed;
            left: 0;
            right: 0;
            background-color: #fafafa;
            padding: 0;
            max-height: 50%;
            width: 55%;
            margin: auto;
            overflow-y: auto;
            border-radius: 2px;
            will-change: top, opacity;
        }
        .z-depth-4, .modal {
            box-shadow: 0 16px 28px 0 rgba(0, 0, 0, 0.22), 0 25px 55px 0 rgba(0, 0, 0, 0.21);
        }
        .modal {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1050;
            display: none;
            overflow: hidden;
            outline: 0;
        }
        .fade {
            transition: opacity 0.15s linear;
        }


        .modal.show .modal-dialog-custom {
            -webkit-transform: translate(0, 0);
            transform: translate(0, 0);
        }
        .modal.fade .modal-dialog-custom {
            transition: -webkit-transform 0.3s ease-out;
            transition: transform 0.3s ease-out;
            transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
            -webkit-transform: translate(0, -25%);
            transform: translate(0, -25%);
        }
        @media (min-width: 576px)
            .modal-dialog-custom {
                max-width: 500px;
                margin: 1.75rem auto;
            }
            .modal-dialog-custom {
                position: relative;
                width: auto;
                margin: 0.5rem;
                pointer-events: none;
            }

            .modal-content-custom {
                position: relative;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                width: 100%;
                pointer-events: auto;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, 0.2);
                border-radius: 0.3rem;
                outline: 0;
            }
            *, *:before, *:after {
                box-sizing: inherit;
            }
            *, *::before, *::after {
                box-sizing: border-box;
            }
            user agent stylesheet
            div {
                display: block;
            }
            .modal-dialog-custom {
                position: relative;
                width: auto;
                margin: 0.5rem;
                pointer-events: none;
                margin-top: 90px;
                margin-left: 15px;
                margin-right: 15px;
            }



            .text-center {
                text-align: center !important;
            }
            .modal-header {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: start;
                align-items: flex-start;
                -ms-flex-pack: justify;
                justify-content: space-between;
                padding: 1rem;
                border-bottom: 1px solid #e9ecef;
                border-top-left-radius: 0.3rem;
                border-top-right-radius: 0.3rem;
            }
</style>