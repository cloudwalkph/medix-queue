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
    </style>
@endsection

@section('scripts')
    <script>
        $(function () {
            resizeUI();

            $(window).on('resize', function() {
                resizeUI();
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
        })
    </script>
@endsection

@section('content')
    <div id="queue">
        <div class="row">
            <div class="col-md-12">

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 queue-item">
                            <div class="content">
                                <p class="queue-number">00100</p>
                                <p class="room">Consultation Room 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 queue-item">
                            <div class="content">
                                <p class="queue-number">00102</p>
                                <p class="room">X-Ray</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 queue-item">
                            <div class="content">
                                <p class="queue-number">00103</p>
                                <p class="room">Consultation Room 3</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 queue-item">
                            <div class="content">
                                <p class="queue-number">00104</p>
                                <p class="room">Laboratory</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8" id="ads">
                    YOU CAN PUT SOME ADS HERE
                </div>

            </div>
        </div>
    </div>
@endsection
