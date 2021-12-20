<!-- Halaman ini punya map -->
<div id="hasMap">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cari rute</h1>
<!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
class="fas fa-download fa-sm text-white-50"></i> Generate Report
</a> -->
<!-- Topbar Search -->
<div>
    <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari jasa..."
            aria-label="Search" aria-describedby="basic-addon2" id="search-jasa">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="d-none bg-light rounded-2 position-absolute end-0 mt-2 mr-4" id="search-result" style="z-index: 1080;">

    </div>

</div>
</div>

<!-- Content Row -->
<div class="row px-3">
    <div id="map" class="rounded" style="width: 100%; height:500px;">
    <button class="position-absolute btn btn-sm btn-success" id="btnMyLocation" title="Cari lokasi saya" style="z-index: 1080;top: 80px;"><i class="fas fa-location-arrow"></i></button>
    </div>
</div>
<!-- Content Row -->
</div>