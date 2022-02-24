$(function () {
    //Initialize Select2 Elements
    $("#provinsi").select2({
        theme: "bootstrap4",
        placeholder: "Enter provinsi",
    });
    $("#kota").select2({
        theme: "bootstrap4",
        placeholder: "Enter kota",
    });
    $("#kecamatan").select2({
        theme: "bootstrap4",
        placeholder: "Enter kecamatan",
    });
    $("#kelurahan").select2({
        theme: "bootstrap4",
        placeholder: "Enter kelurahan",
    });

    //Date picker
    $("#tanggal_lahir").prop("readonly", true);
    $("#tanggal_lahir").datetimepicker({
        format: "yyyy-MM-DD",
    });
});

$(window).on("load", function () {
    var province = `<option value="">-- Pilih Provinsi --</option>`;
    var provinces = doRequest("GET", `/regions/province`, null, false);
    provinces.data.map((provinsi) => {
        province += `
          <option value="${provinsi.id}">${provinsi.name}</option>
      `;
    });
    $("#provinsi").html(province);
});

$("#provinsi").on("change", function () {
    var id = this.value;
    var city = `<option value="">-- Pilih Kota --</option>`;
    var cities = doRequest("GET", `/regions/cities/${id}`, null, false);
    cities.data.map((kota) => {
        city += `
            <option value="${kota.id}">${kota.name}</option>
        `;
    });
    $("#kota").prop("disabled", false);
    $("#kecamatan").prop("disabled", true);
    $("#kecamatan").html("");
    $("#kelurahan").prop("disabled", true);
    $("#kelurahan").html("");
    $("#kota").html(city);
});

$("#kota").on("change", function () {
    var id = this.value;
    var district = `<option value="">-- Pilih Kecamatan --</option>`;
    var districts = doRequest("GET", `/regions/districts/${id}`, null, false);
    districts.data.map((kecamatan) => {
        district += `
            <option value="${kecamatan.id}">${kecamatan.name}</option>
        `;
    });
    $("#kecamatan").prop("disabled", false);
    $("#kelurahan").prop("disabled", true);
    $("#kelurahan").html("");
    $("#kecamatan").html(district);
});

$("#kecamatan").on("change", function () {
    var id = this.value;
    var village = `<option value="">-- Pilih Kelurahan --</option>`;
    var villages = doRequest("GET", `/regions/villages/${id}`, null, false);
    villages.data.map((kelurahan) => {
        village += `
            <option value="${kelurahan.id}">${kelurahan.name}</option>
        `;
    });
    $("#kelurahan").prop("disabled", false);
    $("#kelurahan").html(village);
});
