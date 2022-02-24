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
    // Provinsi
    var province = `<option value="">-- Pilih Provinsi --</option>`;
    var provinces = doRequest("GET", `/regions/province`, null, false);
    provinces.data.map((provinsi) => {
        if (domisili.provinsi == provinsi.id) {
            province += `
                <option value="${provinsi.id}" selected>${provinsi.name}</option>
            `;
        } else {
            province += `
                <option value="${provinsi.id}">${provinsi.name}</option>
            `;
        }
    });
    $("#provinsi").html(province);

    // Kota
    var city = `<option value="">-- Pilih Kota --</option>`;
    var cities = doRequest(
        "GET",
        `/regions/cities/${domisili.provinsi}`,
        null,
        false
    );
    cities.data.map((kota) => {
        if (domisili.kota == kota.id) {
            city += `
                <option value="${kota.id}" selected>${kota.name}</option>
            `;
        } else {
            city += `
                <option value="${kota.id}">${kota.name}</option>
            `;
        }
    });
    $("#kota").prop("disabled", false);
    $("#kota").html(city);

    // Kecamatan
    var district = `<option value="">-- Pilih Kecamatan --</option>`;
    var districts = doRequest(
        "GET",
        `/regions/districts/${domisili.kota}`,
        null,
        false
    );
    districts.data.map((kecamatan) => {
        if (domisili.kecamatan == kecamatan.id) {
            district += `
                <option value="${kecamatan.id}" selected>${kecamatan.name}</option>
            `;
        } else {
            district += `
                <option value="${kecamatan.id}">${kecamatan.name}</option>
            `;
        }
    });
    $("#kecamatan").prop("disabled", false);
    $("#kecamatan").html(district);

    // Kelurahan
    var village = `<option value="">-- Pilih Kelurahan --</option>`;
    var villages = doRequest(
        "GET",
        `/regions/villages/${domisili.kecamatan}`,
        null,
        false
    );
    villages.data.map((kelurahan) => {
        if (domisili.kelurahan == kelurahan.id) {
            village += `
                <option value="${kelurahan.id}" selected>${kelurahan.name}</option>
            `;
        } else {
            village += `
                <option value="${kelurahan.id}">${kelurahan.name}</option>
            `;
        }
    });
    $("#kelurahan").prop("disabled", false);
    $("#kelurahan").html(village);
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
