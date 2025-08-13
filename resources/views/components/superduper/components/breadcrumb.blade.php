@props(['title' => 'Blog', 'items' => []])

<!-- =========================== Breadcrumbs =================================== -->
<div class="breadcrumbs_wrap dark">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="text-center">
                    <h2 class="breadcrumbs_title">{{ $title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="color: #fff"><a href="{{ route('home') }}"><i class="ti-home" style="color: #fff"></i></a></li>
                        @foreach($items as $item)
                            @if(isset($item['url']))
                                <li class="breadcrumb-item" style="color: #fff"><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
                            @else
                                <li style="color: #fff" class="breadcrumb-item" aria-current="page">{{ $item['label'] }}</li>
                            @endif
                        @endforeach
                        @if(count($items) === 0)
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        @endif
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- =========================== Breadcrumbs =================================== -->

