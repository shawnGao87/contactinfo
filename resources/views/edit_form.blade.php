@extends('layout.layout')

{{-- {{dd($map_error)}} --}}
<script type='text/javascript'>
    var centreGot = false;
</script>
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Edit Contact</h1>
        </div>
        <div class="card-body">
            <form action="/contact/{{$contact->id}}" method="POST">
                @method('put')
                @include('layout.contact_form')
            </form>

            {{-- in case not able to retrieve location --}}
            @if (!empty($map_error))
                @php
                $contact->lat = 37.275476;
                $contact->lng = -104.658508;
                @endphp
                <div class="alert alert-danger"  role="alert">
                    {{$map_error}}
                </div>
            @endif

            <div id="map" style="height:400px">
                
            </div>
            
    </div>



<script>
// Initialize and add the map
    function initMap() {
        // The location of Uluru
        var location = {lat: {{$contact->lat}}, lng: {{$contact->lng}}};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 5, center: location});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: location, map: map, animation: google.maps.Animation.DROP});
    }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq823MjPN5Np0ASfOS5lLXtOmxif2C-t4&callback=initMap">
</script>

@endsection
