@extends('layouts.master')

@section('content')
<script type="text/javascript">
    // variabel global marker
    var marker;
    function taruhMarker(peta, posisiTitik) {
        if (marker) {
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta,
            });
        }
        // animasi sekali
        marker.setAnimation(google.maps.Animation.BOUNCE);
        setTimeout(function() {
            marker.setAnimation(null);
        }, 2000);
        // kirim nilai koordinat ke input
        $("input[name=longitude]").val(posisiTitik.lat());
        $("input[name=latitude]").val(posisiTitik.lng());
        console.log($("input[name=longitude]").val() + "," + $("input[name=latitude]").val());
    }
    function initialize() {
        var propertiPeta = {
            center: new google.maps.LatLng(-8.592487,116.109302),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var peta = new google.maps.Map(document.getElementById("google-maps"), propertiPeta);
        // even listner ketika peta diklik
        google.maps.event.addListener(peta, 'click', function(event) {
            taruhMarker(this, event.latLng);
        });
        // marker.setMap(peta);
    }
    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="card">
    <div class="card-content">

        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Nama Lokasi" id="first_name" type="text" class="validate">
                        <label for="first_name">Nama Lokasi</label>
                    </div>

                    <div class="input-field col s6">
                        <select>
                          <option value="" disabled selected>Pilih Jenis</option>
                          <option value="1">Tempat Wisata</option>
                          <option value="2">Persimpangan</option>
                        </select>
                        <label for="jenis">Jenis</label>
                    </div>

                    <div id="google-maps" style="height: 400px; width:100%"></div>

                    <!-- input untuk menampung koordinat -->
                    <input type="hidden" name="longitude" value="" />
                    <input type="hidden" name="latitude" value="" />

                    <br>
                    <a class="waves-effect waves-light btn"><i class="material-icons left">done</i>Simpan</a>
                </div>
            </form>

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
});
</script>

@endsection
