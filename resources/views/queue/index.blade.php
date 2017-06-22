@extends('layouts.queue')

@section('styles')
    <style>
        #queue {
            overflow: hidden;
            background-color: #0373a5;
        }

        #ads {
            background-color: #0373a5;
            text-align: center;
            font-size: 50px;
            color: #f4f4f4;
            height: 100%;
            border-left: dashed 1px #002434;
        }

        .queue-item {
            background-color: #03A9F4;
            text-align: center;
            border-bottom: dashed 1px #0173a5;
            line-height: 70px;
            padding: 30px 0;
            position: relative;
        }

        .queue-item .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .queue-item .queue-number {
            font-size: 100px;
            font-weight: bold;
            color: #02324a;
        }

        .queue-item .room {
            font-size: 25px;
            font-weight: bold;
            color: #f4f4f4;
        }

        @-webkit-keyframes argh-my-eyes {
            0%   { background-color: #03A9F4; }
            49% { background-color: #03A9F4; }
            50% { background-color: #0173a5; }
            99% { background-color: #0173a5; }
            100% { background-color: #03A9F4; }
        }
        @-moz-keyframes argh-my-eyes {
            0%   { background-color: #03A9F4; }
            49% { background-color: #03A9F4; }
            50% { background-color: #0173a5; }
            99% { background-color: #0173a5; }
            100% { background-color: #03A9F4; }
        }
        @keyframes argh-my-eyes {
            0%   { background-color: #03A9F4; }
            49% { background-color: #03A9F4; }
            50% { background-color: #0173a5; }
            99% { background-color: #0173a5; }
            100% { background-color: #03A9F4; }
        }

        .blink {
            -webkit-animation: argh-my-eyes 1s infinite;
            -moz-animation:    argh-my-eyes 1s infinite;
            animation:         argh-my-eyes 1s infinite;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(function () {
            resizeUI();
            let audio = new Audio('/sounds/notification.mp3');
            playNotificationSound();

            $(window).on('resize', function() {
                resizeUI();
            });

            Echo.channel(`queue`)
                .listen('QueueUpdated', (e) => {
                    console.log(e);
                    let queueNumber = e.queue.queue_number;
                    let facility = e.queue.facility;
                    $('#' + facility + " .queue-number").html(queueNumber);

                    playNotificationSound();
                    $('#' + facility).addClass('blink');

                    setTimeout(() => {
                        $('#' + facility).removeClass('blink');
                    }, 5000);
                });

            function resizeUI() {
                let windowHeight = $(window).height();

                $('#ads').css('height', windowHeight + "px");

                // calculate the number of queue item
                let queueItem = $('.queue-item');

                let queueCount = queueItem.length;
                let queueItemSize = windowHeight / queueCount;

                queueItem.css('height', queueItemSize + "px");
            }

            function playNotificationSound() {
                audio.play();
            }
        })
    </script>
@endsection

@section('content')
    <div id="queue">
        <div class="row">
            <div class="col-md-12">

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 queue-item" id="consultation">
                            <div class="content">
                                <p class="queue-number">0000</p>
                                <p class="room">Consultation Room</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 queue-item" id="xray">
                            <div class="content">
                                <p class="queue-number">0000</p>
                                <p class="room">X-Ray</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 queue-item" id="laboratory">
                            <div class="content">
                                <p class="queue-number">0000</p>
                                <p class="room">Laboratory</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8" id="ads">
                    YOU CAN PUT SOME ADS HERE
                    <div class="logo">
                        {{--<img src="/img/aventus.png" alt="aventus logo">--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
