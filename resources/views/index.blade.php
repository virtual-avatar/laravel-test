<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Стартовая страница с формой">

    <title>Страница формы | Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>

<main role="main">


    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Введите данные в форму и нажмите кнопку "Найти". <a target="_blank" href="http://mellarius.ru/random-inn">(
            генератор корректного ОГРН )</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="container">
        <form action="/form" method="post">
            {{csrf_field()}}
            <fieldset>
                <legend class="text-center"></legend>
            </fieldset>
            <div class="form-row align-items-center justify-content-center">
                <div class="col-sm-4 my-1">
                    <label class="sr-only" for="inlineFormInputGroupUsername">Номер ОГРН</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">ОГРН</div>
                        </div>
                        @if(count($errors) > 0)
                            <input type="text" class="form-control is-invalid" name="ogrn" value="{{old('ogrn')}}"
                                   id="inlineFormInputGroupUsername" placeholder="Номер ОГРН"
                                   aria-describedby="usernameHelpBlock">

                        @else
                            <input type="text" class="form-control" name="ogrn" value="{{old('ogrn')}}"
                                   id="inlineFormInputGroupUsername" placeholder="Номер ОГРН"
                                   aria-describedby="usernameHelpBlock">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">Найти</button>
                </div>
            </div>
        </form>

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div> <!-- /container -->

</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>
</html>