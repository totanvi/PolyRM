data = []
$.each(property, function(key, value) {
	dataShow = {
		latitude: value.latitude,
		longitude: value.longitude,
		html:`
			<div class='address-map'>
				<div class='address-map-img'>
					<img src='/upload/`+value.property_image+`'>
				</div>
				<div class='address-map-date'>
					<span class='address-map-type'>Phòng cho thuê</span>
					<h4 class='address-map-title'>
						<a href='`+url+`moteldetail/`+value.property_id+`'>`+value.property_title+`</a>
					</h4>
					<div class='address-map-info'>`+value.property_location+`</div>
					<div class='address-map-price'>`+format_number(value.property_price)+` VNĐ</div>
				</div>
			</div>`,
		icon: {
			image: "/images/gmap/marker1.png",
			iconsize: [52, 75],
			iconanchor: [26, 75],
		}
	};
	data.push(dataShow)
});
$('#googleMap').gMap({
	zoom: 14,
	maptype: 'ROADMAP',
	markers: data,
});
function format_number(val)
{
var v = Number(val);
if (isNaN(v)) { return val; }
var sign = (v < 0) ? '-' : '';
var res = Math.abs(v).toString().split('').reverse().join('').replace(/(\d{3}(?!$))/g, '$1.').split('').reverse().join('');
return sign + res;
}