<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="antialiased bg-light">
        <div class="container mt-4 py-3 mx-auto bg-white rounded shadow-sm">
            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-2 col-md-4">
                        <div class="card">
                            <img src="{{ env('STRAPI_URL') . $post['attributes']['image']['data']['attributes']['formats']['medium']['url'] }}" 
                                class="card-img-top" alt="{{ $post['attributes']['image']['data']['attributes']['alternativeText'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post['attributes']['title'] }}</h5>
                                <p class="card-text">{{ substr($post['attributes']['content'], 0, 50) }}...</p>
                                <a href="/post/{{ $post['id'] }}" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="card-footer">
                                @if(count($post['attributes']['tags']['data']))
                                    @foreach ($post['attributes']['tags']['data'] as $tag)
                                        <span class="badge bg-success">{{ $tag['attributes']['name'] }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                This is some text within a card body.
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </body>
</html>
