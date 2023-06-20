<div class="side-panel position-fixed c-scroll ">
      <div class="side-panel-inner position-relative">
         <div class="loader side-loader">
            <div class="side-loading"></div>
            <div class="side-loading"></div>
            <div class="side-loading"></div>
         </div>
         <div class="side-link">
            <div class="p-3 pl-4 pr-4 main-link"><a href="{{ route('home') }}" class="d-block w-100"><i class="fa-solid fa-chart-line"></i> Dashboard</a></div>
         </div>
         @if(shop())
         <div class="side-link">
            <div class="p-3 pl-4 pr-4 main-link"><a href="#" class="d-block w-100"><i class="fa-solid fa-file-lines"></i> Pages</a></div>
            <div class="pl-5 side-link-sub c-scroll">
               <a href="{{ route('pages.index') }}" class="d-block w-100">All pages</a>
               <a href="{{ route('pages.create') }}" class="d-block w-100">New page</a>
            </div>
         </div>
         @else
         <div class="side-link">
            <div class="p-3 pl-4 pr-4 main-link"><a href="#" class="d-block w-100"><i class="fa-solid fa-shop"></i> Shops</a></div>
            <div class="pl-5 side-link-sub c-scroll">
               <a href="{{ route('shops.index') }}" class="d-block w-100">All shops</a>
               <a href="{{ route('shops.create') }}" class="d-block w-100">New shop</a>
            </div>
         </div>
         @endif
         <div class="side-link">
            <div class="p-3 pl-4 pr-4 main-link"><a href="{{ route('logout') }}" class="confirm d-block w-100"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></div>
         </div>
      </div>
   </div>