var setLocation;
var hapusJasa, editJasa, showImageJasa;
var closeModal, setRating, getJumlahUlasan, setRouteEnd, setRouteStart;

window.onload = function() {
    var btn = document.getElementById('btnSetLocation');
    if (btn !== null) {
        btn.click();
    }
}

$(document).ready(function() {
    var jumlahUlasanUser = $('#ulasan-user').attr('data-count');
    $('#badge-ulasan-user').html(jumlahUlasanUser);
    var tabel = $('#dataTable').DataTable();

    var greenIcon = new L.Icon({
        iconUrl: '/project-akhir-gis/assets/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    function popupContent(id) {
        var result = null;
        var url = window.location.search;
        url = url.replace('?page=', '');
        $.ajax({
            url: "/project-akhir-gis/app/ajax/popupContent.php",
            type: 'GET',
            data: {id: id, url: url},
            async: false,
            success: function(res) {
                result = res;
            }
        });
        return result;
    }

    if ($('#hasMap').length > 0) {
        var map = L.map('map').setView([-7.8714, 111.4611], 13)
        // ini adalah copyright, bisa dicopot tapi lebih baik kita hargai sang penciptanya ya :)
        // OSM Mapnik
        var osmLink = "<a href='http://www.openstreetmap.org'>Open StreetMap</a>";
        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + osmLink,
                maxZoom: 18
            }).addTo(map);

        var marker = {};

        var url = window.location.search;
        url = url.split("&&");

        $('#btnMyLocation').on('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var content = '<div class="p-2 text-center"><small>Kamu ada disini</small><div class="d-flex justify-content-center gap-2"><small><a href="javascript:void(0)" class="text-success" onclick="return setRouteStart('+position.coords.latitude+','+position.coords.longitude+')"><i class="fas fa-home"></i> Dari sini</a></small><small>/</small><small><a href="javascript:void(0)" class="text-primary" onclick="return setRouteEnd('+position.coords.latitude+','+position.coords.longitude+')"><i class="fas fa-map-pin"></i> Ke sini</a></small></div></div>';
                    map.removeLayer(marker);
                    marker = L.marker([position.coords.latitude, position.coords.longitude], {icon: greenIcon}).addTo(map).bindPopup(content, {closeButton: false}
                        );
                    map.setView([position.coords.latitude, position.coords.longitude], 15);
                });
            }
        });

        if (url[0] === '?page=cari-rute') {
            var geocoder = L.Control.geocoder({defaultMarkGeocode: false}).on('markgeocode', function(e) {
                var latlng = e.geocode.center;
                var content = '<div class="p-2"><div class="d-flex justify-content-center gap-2"><small><a href="javascript:void(0)" class="text-success" onclick="return setRouteStart('+latlng.lat+','+latlng.lng+')"><i class="fas fa-home"></i> Dari sini</a></small><small>/</small><small><a href="javascript:void(0)" class="text-primary" onclick="return setRouteEnd('+latlng.lat+','+latlng.lng+')"><i class="fas fa-map-pin"></i> Ke sini</a></small></div></div>';
                var marker = L.marker(latlng,{icon: greenIcon}).addTo(map).bindPopup(content, {closeButton: false});
                map.fitBounds(e.geocode.bbox);
            }).addTo(map);
            var controlRoute = L.Routing.control({
                waypoints: [
                L.latLng(null, null),
                L.latLng(null, null)
                ],
                geocoder: L.Control.Geocoder.nominatim(),
                routeWhileDragging: true,
                reverseWaypoints: true
            });

            controlRoute.addTo(map);

            setRouteEnd = function setRoute(lat, lng) {
                var latlng = L.latLng(lat, lng);
                controlRoute.spliceWaypoints(controlRoute.getWaypoints().length - 1, 1, latlng);
            }

            setRouteStart = function setRouteStart(lat, lng) {
                var latlng = L.latLng(lat, lng);
                controlRoute.spliceWaypoints(0, 1, latlng);
            }

            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;
                var content = '<div class="p-2 pt-4"><div class="d-flex justify-content-center gap-2"><small><a href="javascript:void(0)" class="text-success" onclick="return setRouteStart('+lat+','+lng+')"><i class="fas fa-home"></i> Dari sini</a></small><small>/</small><small><a href="javascript:void(0)" class="text-primary" onclick="return setRouteEnd('+lat+','+lng+')"><i class="fas fa-map-pin"></i> Ke sini</a></small></div></div>';
                L.popup().setContent(content).setLatLng(e.latlng).openOn(map);
            });
        }

        map.on('click', function(e) {

            if (url[0] === '?page=jasa') {
                map.removeLayer(marker);

                $('#lat').val(e.latlng.lat);
                $('#lng').val(e.latlng.lng);

                marker = L.marker([e.latlng.lat, e.latlng.lng], {icon: greenIcon, draggable: true}).addTo(map);

                marker.on('dragend', function(e) {
                    $('#lat').val(marker.getLatLng().lat);
                    $('#lng').val(marker.getLatLng().lng);
                });
            }
        });

        $.ajax({
            url: "/project-akhir-gis/app/ajax/getMarkLocation.php",
            dataType: "json",
            success: function(res) {
                $.each(res, function(index, item) {
                    L.marker([item.lat, item.lng]).addTo(map).bindPopup(popupContent(item.id), {closeButton: false});
                });
            }
        });

        $('#search-jasa').on('keyup', function() {
            var key = this.value;
            if (key === '')
                $('#search-result').addClass('d-none');
            else {
                $('#search-result').removeClass('d-none');
                $.get("/project-akhir-gis/app/ajax/searchData.php", {key: key}).done(function(res) {
                    $('#search-result').html(res);
                })
            }
        });

        setLocation = function setLocation(lat, lng, id) {
            $('#search-result').addClass('d-none');
            $('#search-jasa').val("");

            var content = popupContent(id);

            map.setView([lat, lng], 15);
            var popup = L.popup({className: 'content-popup', closeButton: false})
            .setLatLng([lat, lng]).setContent(content).openOn(map); 
        }



    }

    // Kode diatas khusus page yang punya map

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    function clearFormJasa() {
        $('#nama').val('');
        $('#alamat').val('');
        $('#nohp').val('');
        $('#lat').val('');
        $('#lng').val('');
        $('#file').val('');
    }

    $('#formTambahJasa').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "/project-akhir-gis/app/ajax/saveJasaBaru.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Toast.fire({
                    icon: 'success',
                    title: data
                });
                setTimeout(function() {
                    window.location.replace("http://localhost/project-akhir-gis/index.php?page=jasa-tabel");
                }, 3000);
            }
        });
    });

    $('#formEditJasa').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "/project-akhir-gis/app/ajax/updateJasaBaru.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Toast.fire({
                    icon: 'success',
                    title: data
                });
                setTimeout(function() {
                    window.location.replace("http://localhost/project-akhir-gis/index.php?page=jasa-tabel");
                }, 3000);
            }
        });
    });

    hapusJasa = function hapusJasa(id, image) {

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            width: '450px',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.get("/project-akhir-gis/app/ajax/hapusJasa.php", {id: id, image: image}).done(function(res) {
                    Toast.fire({
                      icon: 'warning',
                      title: res
                  });
                    tabel.row($('.ID-'+id)).remove().draw();
                })
            }
        });
    }

    $(document).on('click', '#editImgJasa', function() {
        var img = $(this).attr('data-img');
        var id = $(this).attr('data-id');
        $('#imgPreview').attr('src', 'http://localhost/project-akhir-gis/assets/img/upload/'+img);
        $('#idJasa').val(id);
        $('#oldImg').val(img);
        $('#modalImg').fadeIn();
        $('.modal-backdrop').show();
    });

    closeModal = function closeModal() {
        $('#modalImg').fadeOut();
        $('.modal-backdrop').hide();
    }

    $('#inputUpdateImg').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(){
            $('#imgPreview').attr('src', reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    $('#formUpdateImg').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "/project-akhir-gis/app/ajax/updateImgJasa.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                closeModal();
                Toast.fire({
                    icon: 'success',
                    title: data
                });
                setTimeout(function() {
                    window.location.replace("http://localhost/project-akhir-gis/index.php?page=jasa-tabel");
                }, 3000);
            }
        });
    });

    setRating = function setRating(num) {
        var i;
        for (i = 1; i < 6; i++) {
            if (num === i) {
                for (var j = i; j > 0; j--) {
                    $('.star-'+j).removeClass('far');
                    $('.star-'+j).addClass('fas');
                }
            } else {
                $('.star-'+i).removeClass('fas');
                $('.star-'+i).addClass('far');
            }
        }
        $('#numRating').html(num);
        $('#rating').val(num);
    }

    getJumlahUlasan = function getJumlahUlasan(idJasa) {
        $.get("/project-akhir-gis/app/ajax/getJumlahUlasan.php", {idJasa: idJasa}).done(function(res) {
            $('#labelJumlahUlasan').html(res);
        });
    }

    $('#formSaveUlasan').on('submit', function(e) {
        e.preventDefault();
        var idJasa = $('#id').val();
        $.ajax({
            url: "/project-akhir-gis/app/ajax/saveUlasan.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(data) {
                if(data.success) {
                    getJumlahUlasan(idJasa);
                    $("#tombol-collapse-ulasan").removeAttr("onclick");
                    $("#tombol-collapse-ulasan").attr("onclick", `setRating(${data.rating})`);
                    $("#tombol-collapse-ulasan small").html('edit ulasan');
                    $('#listUlasan').load(' #listUlasan');
                }
                Toast.fire({
                    icon: data.success ? 'success' : 'error',
                    title: data.message
                });
                setTimeout(function() {
                    location.reload();
                }, 3000);
            }
        });
    });

    

});