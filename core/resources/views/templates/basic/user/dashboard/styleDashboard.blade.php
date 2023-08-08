@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('') }}">
    <style>
        :root {
            --primary-color: rgb(11, 78, 179)
        }

        .bg-grand-gold {
            background: linear-gradient(90deg, rgba(194, 102, 31, 1) 14%, rgba(255, 192, 0, 1) 100%);
        }

        .txt-grand-gold {
            background: -webkit-linear-gradient(rgba(194, 102, 31, 1) 14%, rgba(255, 192, 0, 1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        label {
            display: block;
            margin-bottom: 0.5rem
        }

        input {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            height: 50px
        }

        .width-50 {
            width: 50%
        }

        .ml-auto {
            margin-left: auto
        }

        .text-center {
            text-align: center
        }

        .progressbar {
            position: relative;
            display: flex;
            justify-content: space-between;
            counter-reset: step;
            margin: 2rem 2rem 4rem
        }

        .progressbar::before,
        .progress {
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 4px;
            width: 100%;
            background-color: #dcdcdc;
            z-index: 1
        }

        .progress {
            background-color: rgb(0 128 0);
            width: 0%;
            transition: 0.3s
        }

        .progress-step {
            width: 2.1875rem;
            height: 2.1875rem;
            background-color: #dcdcdc;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1
        }

        .progress-step::before {
            counter-increment: step;
            content: counter(step)
                /* font-family: FontAwesome; */
                /* content: "\f023"; */

        }

        .progress-step::after {
            content: attr(data-title);
            position: absolute;
            top: calc(100% + 0.5rem);
            font-size: 0.85rem;
            color: #666;
            width: 80px;
        }

        .progress-step-active {
            background-color: var(--primary-color);
            color: #f3f3f3
        }

        .form {
            width: clamp(320px, 30%, 430px);
            margin: 0 auto;
            border: none;
            border-radius: 10px !important;
            overflow: hidden;
            padding: 1.5rem;
            background-color: #fff;
            padding: 20px 30px
        }

        .step-forms {
            display: none;
            transform-origin: top;
            animation: animate 1s
        }

        .step-forms-active {
            display: block
        }

        .group-inputs {
            margin: 1rem 0
        }

        .animated-progress {
            width: 600px;
            height: 30px;
            border-radius: 5px;
            margin: 20px 10px;
            border: 1px solid rgb(8, 37, 201);
            overflow: hidden;
            position: relative;
        }

        .animated-progress span {
            height: 100%;
            display: block;
            width: 0;
            color: rgb(255, 251, 251);
            line-height: 30px;
            position: absolute;
            text-align: end;
            padding-right: 5px;
        }

        .progress-blue span {
            background-color: blue;
        }

        .progress-green span {
            background-color: green;
        }

        .progress-purple span {
            background-color: indigo;
        }

        .progress-red span {
            background-color: red;
        }

        @keyframes animate {
            from {
                transform: scale(1, 0);
                opacity: 0
            }

            to {
                transform: scale(1, 1);
                opacity: 1
            }
        }

        .btns-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem
        }

        .btn {
            padding: 0.75rem;
            display: block;
            text-decoration: none;
            background-color: var(--primary-color);
            color: #f3f3f3;
            text-align: center;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: 0.3s
        }

        .btn:hover {
            box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color)
        }

        .progress-step-check {
            position: relative;
            background-color: green !important;
            transition: all 0.8s
        }

        .progress-step-check::before {
            position: absolute;
            content: '\2713';
            width: 100%;
            height: 100%;
            top: 8px;
            left: 13px;
            font-size: 12px
        }

        .group-inputs {
            position: relative
        }

        .group-inputs label {
            font-size: 13px;
            position: absolute;
            height: 19px;
            padding: 4px 7px;
            top: -14px;
            left: 10px;
            color: #a2a2a2;
            background-color: white
        }

        .welcome {
            height: 450px;
            width: 350px;
            background-color: #fff;
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .welcome .content {
            display: flex;
            align-items: center;
            flex-direction: column
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #7ac142;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards
        }

        .checkmark {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: inset 0px 0px 0px #7ac142;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards
        }

        .cards-wrapper {
            display: flex;
        }

        .cardSlide {
            margin: 0 0.5em;
            width: calc(100%/3);
        }

        /* userInfo */

        .profile {
            width: 330px;
            height: 100px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 5px;
            background-color: #fafafa;
            box-shadow: 0 0 2rem #babbbc;
            animation: show-profile 0.5s forwards ease-in-out;
        }

        /* @keyframes show-profile {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            0% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                width: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } */

        .profile .photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid #fafafa;
            margin-left: -50px;
            box-shadow: 0 0 0.5rem #babbbc;
            animation: rotate-photo 0.5s forwards ease-in-out;
        }

        /* @keyframes rotate-photo {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                0% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    transform: rotate(0deg);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                100% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    transform: rotate(-360deg);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */

        .profile .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile .content {
            padding: 10px;
            overflow: hidden;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .profile .content .text {
            margin-top: 20px;
            margin-left: 50px;
        }

        .profile .content .text h3,
        .profile .content .text h6 {
            font-weight: normal;
            margin: 3px 0;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .profile .content .btn {
            background-color: #70a1ff;
            width: 50px;
            height: 50px;
            position: absolute;
            right: 25px;
            top: 25px;
            border-radius: 50%;
            z-index: 1;
            cursor: pointer;
            transition-duration: 0.3s;
            animation: pop-btn 0.3s both ease-in-out 0.5s;
        }

        .shing {
            &::before {
                animation: shine #{$anim-duration}s ease-in-out infinite;
            }
        }

        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        .imgUser {
            height: 10rem;
            width: 10rem;
            background-color: #fff;
        }

        .cardImages {
            height: 15rem;
            width: 16rem;
            background-color: #141214;
        }

        .cardImages.masterGold {
            background-image: url("{{ asset('assets/assets/badges/title-mg.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .cardImages.grandMaster {
            background-image: url("{{ asset('assets/assets/badges/title-gmg.jpeg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        /* display 3 */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left {
            transform: translateX(0);
        }

        .card-gold-view {
            height: 250px;
            width: 360px;
            background-color: #141214;
        }

        .cardImage {
            background-image: url("{{ asset('assets/card.png') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .card-gold-view .text-view {
            color: white;
            margin-top: 35%;
            justify-content: center;
            padding: 10px;
            font-size: 20px;
        }

        @keyframes shine {
            0% {
                left: -100%;
                transition-property: left;
            }

            #{($anim-speed / ($anim-duration + $anim-speed) * 100%)},
            100% {
                left: 100%;
                transition-property: left;
            }
        }


        @keyframes stroke {
            100% {
                stroke-dashoffset: 0
            }
        }

        @keyframes scale {

            0%,
            0% {
                transform: none
            }

            50% {
                transform: scale3d(1.1, 1.1, 1)
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #7ac142
            }
        }
    </style>
@endpush