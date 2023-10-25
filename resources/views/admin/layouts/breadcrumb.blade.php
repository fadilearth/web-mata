<div class="pagetitle">
    <h1>{{ $data['title_content'] }}</h1>
    <nav>
      <ol class="breadcrumb">
        @foreach ($data['breadcrumb'] as $item)
            @if ($item['link'] != null)
                <li class="breadcrumb-item"><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $item['title'] }}</li>
            @endif
        @endforeach
      </ol>
    </nav>
</div><!-- End Page Title -->