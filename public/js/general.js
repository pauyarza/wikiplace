function cap(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function goMaps(lat,lng){
    window.open("http://maps.google.com/maps?q="+lat+","+lng);
}