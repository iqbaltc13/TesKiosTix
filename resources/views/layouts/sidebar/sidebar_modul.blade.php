
<aside id="sc-sidebar-main">
    <div class="uk-offcanvas-bar">
	    <div data-sc-scrollbar="visible-y">
	        <ul class="sc-sidebar-menu uk-nav">
				<li class="sc-sidebar-menu-heading"><span>Menu</span></li>
				<li>
	                <a href="#">
	                   <span class="uk-nav-icon"><i class="mdi mdi-view-dashboard-variant"></i>
	                    </span><span class="uk-nav-title">Buku</span>
	                </a>
	                <ul class="sc-sidebar-menu-sub">
						<li id="link.dashboard.buku.create" @if(url()->current() == route('dashboard.buku.create')) class="sc-page-active" @endif>
							<a href="{{route('dashboard.buku.create')}}"  > Tambah Buku </a>
						</li>				
						<li id="link.dashboard.buku.index" @if(url()->current() == route('dashboard.buku.index')) class="sc-page-active" @endif>
							<a href="{{route('dashboard.buku.index')}}" > List Buku </a>
						</li>	
					</ul>
	            </li>
	            <li>
	                <a href="#">
                        <span class="uk-nav-icon"><i class="mdi mdi-view-dashboard-variant"></i>
                         </span><span class="uk-nav-title">Kategori</span>
                     </a>
                     <ul class="sc-sidebar-menu-sub">
                         <li id="link.dashboard.kategori.create" @if(url()->current() == route('dashboard.kategori.create')) class="sc-page-active" @endif>
                             <a href="{{route('dashboard.kategori.create')}}"  > Tambah Kategori </a>
                         </li>				
                         <li id="link.dashboard.kategori.index" @if(url()->current() == route('dashboard.kategori.index')) class="sc-page-active" @endif>
                             <a href="{{route('dashboard.kategori.index')}}" > List Kategori </a>
                         </li>	
                     </ul>
				</li>
				<li>
                    <a href="#">
                        <span class="uk-nav-icon"><i class="mdi mdi-view-dashboard-variant"></i>
                         </span><span class="uk-nav-title">Penulis</span>
                     </a>
                     <ul class="sc-sidebar-menu-sub">
                         <li id="link.dashboard.penulis.create" @if(url()->current() == route('dashboard.penulis.create')) class="sc-page-active" @endif>
                             <a href="{{route('dashboard.penulis.create')}}"  > Tambah Penulis </a>
                         </li>				
                         <li id="link.dashboard.penulis.index" @if(url()->current() == route('dashboard.penulis.index')) class="sc-page-active" @endif>
                             <a href="{{route('dashboard.penulis.index')}}" > List Penulis </a>
                         </li>	
                     </ul>
				</li>
				
				
	        </ul>
	    </div>
    </div>
	<div class="sc-sidebar-info">
        version: 2.1.0
	</div>
</aside>