<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $post['attributes']['title'] }} - Blog</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="antialiased bg-light">
        <div class="container mt-4 py-3 px-5 mx-auto bg-white rounded shadow-sm">
            <h1>{{ $post['attributes']['title'] }}</h1>
            <small class="text-muted d-block">{{ $post['attributes']['date_posted'] }}</small>
            <img src="{{ env('STRAPI_URL') . $post['attributes']['image']['data']['attributes']['formats']['medium']['url'] }}" 
                                class="img-fluid mx-auto d-block my-3" alt="{{ $post['attributes']['image']['data']['attributes']['alternativeText'] }}">
            @if(count($post['attributes']['tags']['data']))
              <div class="mb-3">
                @foreach ($post['attributes']['tags']['data'] as $tag)
                  <span class="badge bg-success">{{ $tag['attributes']['name'] }}</span>
                @endforeach
              </div>
            @endif
            <p class="content">
              {{ $post['attributes']['content'] }}
            </p>

            <hr/>
            @if (count($post['attributes']['comments']['data']))
              <div class="comments">
                <h2>Comments</h2>
                @foreach ($post['attributes']['comments']['data'] as $comment)
                  <div class="card mb-3">
                    <div class="card-body">
                      {{ $comment['attributes']['content'] }}
                    </div>
                    <div class="card-footer">
                      By {{ $comment['attributes']['email'] }}
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
            <hr />
            <form action="/post/{{ $post['id'] }}" method="POST">
              @csrf
              <h2>Add Your Comment</h2>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Your Comment</label>
                <textarea rows="5" class="form-control" id="content" name="content" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>
