<div class="col-lg-3 sidebar sidebar-mobile" id="open-mobile-filters">
    <div class="sidebar-content">
        <div class="sidebar-header clearfix d-lg-none">
            <button type="button" class="close toggle-show p-3" data-show="open-mobile-filters" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="bg-white p-2 p-lg-3 mb-2 mb-lg-4 shadow-sm br-sm">
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Go!</button>
                </div>
            </div>
        </div>
        <div class="bg-white p-2 p-lg-3 mb-2 mb-lg-4 shadow-sm br-sm">
            <a class="pre-label px-0" data-toggle="collapse" href="#collapseExamplePrice" role="button" aria-expanded="false" aria-controls="collapseExamplePrice">
                <small>PRECIO</small>
            </a>

            <div class="collapse show" id="collapseExamplePrice">
                <div class="pt-3">
                    <div class="d-flex justify-content-between">
                        <span>Price</span>
                        <span>
                            $ <b class="price-value"></b>
                        </span>
                    </div>
                    <input type="range" class="custom-range price-range" id="customRange1" min="{{ $productos->min('precio_unitario') }}" max="{{ $productos->max('precio_unitario') }}" step="1">
                    <div class="d-flex justify-content-between">
                        <small>$ {{ $productos->min('precio_unitario') }}</small>
                        <small>$ {{ $productos->max('precio_unitario') }}</small>
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-white p-2 p-lg-3 mb-2 mb-lg-4 shadow-sm br-sm">

            <a class="pre-label px-0" data-toggle="collapse" href="#collapseExampleRadio" role="button" aria-expanded="false" aria-controls="collapseExampleRadio">
                <small>Categorías</small>
            </a>

            <div class="collapse show" id="collapseExampleRadio">
                <ul class="list-group list-group-clean pt-4">
                    @foreach ($categorias as $cat)
                    <li class="list-group-item">
                        <a class="btn btn-light text-left btn-block text-truncate pl-2 pr-1 {{ $activePage == $cat->slug ? ' active' : '' }}" href="?categoria={{ $cat->slug }}">
                            <img src="{{ asset('storage') . '/' . $cat->image }}" width="36" height="36" alt="">
                            {{ $cat->nombre }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>
