<header class="main-header w-100 position-fixed">
    <div class="header-container w-100 p-2">
        <div class="d-flex align-items-center pl-0 pl-sm-3 pr-2 pr-sm-3">
            <div class="mr-auto flex-1">
                <div class="d-flex align-items-center">
                    <div class="d-lg-none mr-2 h4 mb-0 toggle-hold">
                        <span class="side-toggler"><i class="fa-solid fa-bars"></i></span>
                    </div>
                    <div class="d-block header-text"><a href="{{ route('home') }}"
                            class="m-0 h5 text-dark text-overflow font-weight-bold">{{ env('APP_NAME') }}</a>
                    </div>
                </div>
            </div>
            <div class="ml-auto d-flex ">
                <div class="dropdown ml-2 mr-2 d-none d-sm-block">
                    <button class="btn btn-cancel dropdown-toggle text-overflow" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ shop()->title ?? 'Select shop' }}
                    </button>
                    <div class="dropdown-menu p-0 border-0 text-overflow" aria-labelledby="dropdownMenuButton">
                        @foreach(shops() as $shop)
                        <a class="dropdown-item text-overflow {{ (shop()->id ?? null) == $shop->id ? 'disabled' : 'enabled' }}" href="{{ route('shops.login', ['shop' => $shop->id]) }}">{{ $shop->title }}</a>
                        @endforeach
                        @if(shops()->count())
                        <a class="dropdown-item text-overflow" href="{{ route('shops.index') }}">More shops</a>
                        @else
                        <a class="dropdown-item text-overflow" href="{{ route('shops.create') }}">Add a shop</a>
                        @endif
                    </div>
                </div>
                <a href="{{ route('shops.create') }}" class="mr-2 btn btn-dark d-none d-sm-block text-overflow flex-1"><i class="fa-solid fa-plus"></i> New shop</a>
                
                <div class="m-0 h5 dash-avatar text-white position-relative">
                    <div class="avatar-text position-absolute cursor-pointer profile-toggle">
                        {{ auth()->user()->name[0] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="profle-panel position-fixed" style="display: none;">
        <div class="w-100 position-relative">
            <div class="close-profile position-absolute d-flex align-content-center cursor-pointer"><i
                    class="fa-solid fa-xmark m-auto"></i></div>
            <div class="profile-container text-center p-3 pt-5">
                <div class="m-auto h1 dash-avatar avatar-big text-white position-relative">
                    <div class="avatar-text position-absolute cursor-pointer">{{ auth()->user()->name[0] }}</div>
                </div>
                <div class="name h5 mt-3 mb-0">{{ auth()->user()->name }}</div>
                <div class="email">{{ auth()->user()->email }}</div>
                <div class="mt-4">
                    <a href="{{ route('logout') }}" class="btn btn-danger confirm btn-round">Log out</a>
                </div>
            </div>
        </div>
    </div>
</header>