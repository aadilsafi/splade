@extends('portal.layout.master')

@section('content')          
                <div id="questions-holder">

                    <div id="questions" data-interval="false" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner ">
                            <div class="carousel-item active">
                                <div class="bg-white rounded p-5 question " id="question1">
                                    <h5>
                                        I can communicate my feelings and ideas very clearly - in one go
                                    </h5>
                                    <div class="answers mt-4">
                                        <form>
                                            <label>
                                    <input type="radio" name="radio"/>
                                    <span>Always</span>
                                </label>
                                            <label>
                                    <input type="radio" name="radio" checked/>
                                    <span>Sometimes</span>
                                </label>
                                            <label>
                                    <input type="radio" name="radio"/>
                                    <span>Never</span>
                                </label>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="bg-white rounded p-5 question" id="question2">
                                    <h5>
                                        I can easily see things from another person's point of view
                                    </h5>
                                    <div class="answers mt-4">
                                        <form>
                                            <label>
                                    <input type="radio" name="radio"/>
                                    <span>Always</span>
                                </label>
                                            <label>
                                    <input type="radio" name="radio" checked/>
                                    <span>Sometimes</span>
                                </label>
                                            <label>
                                    <input type="radio" name="radio"/>
                                    <span>Never</span>
                                </label>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="buttons mt-4">
                        <button id="submit" class="btn btn-primary d-none" onclick="submitQuestions()">Submit</button>
                        <button id="right" class="btn btn-primary" onclick="next()">Next</button>

                    </div>
                </div>

                <div id="done" class="bg-white rounded p-5 d-none">
                    <div id="loader">
                        <img class="mx-auto d-block" src="images/loader.gif">
                    </div>
                    <div id="results" class="text-center">
                        <canvas id="my-canvas"></canvas>
                        <h4>
                            Congratulations!
                        </h4>
                        <p>You passed this week's quiz!</p>

                        <div class="mt-5">
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <img src="images/Frame 1.png" class="img-fluid">
                                </div>
                                <div class="col-md-3 mb-4">
                                    <img src="images/Frame 2.png" class="img-fluid">
                                </div>
                                <div class="col-md-3 mb-4">
                                    <img src="images/Frame 3.png" class="img-fluid">
                                </div>
                                <div class="col-md-3 mb-4">
                                    <img src="images/Frame 4.png" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection


    <script>
        $('.carousel').carousel({
            wrap: false
        }).on('slid.bs.carousel', function() {
            curSlide = $('.active');

            if (curSlide.is(':last-child')) {
                $('#right').hide();
                $('#submit').removeClass('d-none')
                return;
            }
        })

        function next() {
            $('.carousel').carousel('next');
        }

        function submitQuestions() {
            $('#questions-holder').hide();
            $('#done').removeClass('d-none');
            $('#results').hide();
            setTimeout(function() {

                showResults();
            }, 1000)
        }
        var confettiElement = document.getElementById('my-canvas');
        var confettiSettings = {
            target: confettiElement
        };
        var confetti = new ConfettiGenerator(confettiSettings);

        function showResults() {
            $('#loader').hide();
            $('#results').show();
            renderConfetti();
            setTimeout(function() {
                stopConfetti();
            }, 5000)
        }
    </script>
    <script>
        function renderConfetti() {
            var confettiElement = document.getElementById('my-canvas');
            var confettiSettings = {
                target: confettiElement
            };
            var confetti = new ConfettiGenerator(confettiSettings);
            confetti.render();
            setTimeout(function() {
                confetti.clear();
            }, 3000)

        }

        function stopConfetti() {
            confetti.clear();
        }
    </script>
