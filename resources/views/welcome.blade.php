<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config("app.name")}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/Vanamo_Logo.png/600px-Vanamo_Logo.png" />
        <link rel="shortcut icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/Vanamo_Logo.png/600px-Vanamo_Logo.png"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .hide{
                display: none;
            }
            .mt-5 {
                margin-top: 5px !important;
            }
            .mr-5 {
                margin-right: 5px !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="form-group text-center" style="margin-top: 40px;">
                <h1>{{config("app.name")}}</h1>
                <input type="text" class="form-control" id="search-box-input" placeholder="Search.."/>
            </div>

            <div class="form-group hide" style="margin-top: 100px;" id="results-main-div">
                <h5>Results</h5>
                <div class="row" id="results-div">
                </div>
            </div>

            <div class="col-md-3 hide" id="result-card">
                <div class="form-group mt-5 mr-5">
                    <a href="javascript:;" download="">
                        <img src="https://pixabay.com/get/g4fc175a82f1b2f97d26427889405254b272c2f7e4de315918ed1dfc157253fec4cd522f11bb305c887cbc6419fe0d6322773eefadaae33e85cef4f6e52892c67_640.jpg" 
                        style="border-radius: 5%" width="270" height="180">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </body>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var pixabay_api_key = "{{config('app.pixabay_api_key')??null}}";
        var url = 'https://pixabay.com/api/?key='+pixabay_api_key+'&q=';
        document.getElementById('search-box-input').addEventListener('keyup', function(){
            $('#results-div').html('');
            if(this.value != ''){
                let query = url+(this.value.replace(' ', '+'));
                axios.get(query).then(function (response){
                    if(response.request.status == 200){
                        $.each(response.data.hits, function(i,v){
                            createCard(v.webformatURL, v.webformatURL);
                        });
                    }
                })
                $('#results-main-div').removeClass('hide');
            }else{
                $('#results-div').html('');
                $('#results-main-div').addClass('hide');
            }
        });

        const createCard = (imageUrl, imageName) => {
            $card = $('#result-card').clone();
            $card.attr('id','');
            $card.find('img').attr('src', imageUrl);
            $card.find('a').attr('href', imageUrl);
            //$card.find('span').html(imageName);
            $card.removeClass('hide').appendTo($('#results-div'));
        };
    </script>
</html>
