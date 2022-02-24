$(function () {
    //Initialize Select2 Elements
    $("#members_id").select2({
        theme: "bootstrap4",
        placeholder: "Enter member",
    });
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
    $("#donation_date").prop("readonly", true);
    $("#donation_date").datetimepicker({
        format: "yyyy-MM-DD HH:mm:ss",
        sideBySide: true,
        icons: {
            time: "far fa-clock",
        },
    });
    $("#pick_up_date").prop("readonly", true);
    $("#pick_up_date").datetimepicker({
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

$("#same_address:checkbox").on("change", function () {
    if ($("#same_address:checkbox").is(":checked")) {
        $("#alamat").prop("readonly", true);
        $("#provinsi").prop("readonly", true);
        $("#kota").prop("readonly", true);
        $("#kecamatan").prop("readonly", true);
        $("#kelurahan").prop("readonly", true);
        $("#rw").prop("readonly", true);
        $("#rt").prop("readonly", true);
        $("#kode_pos").prop("readonly", true);

        if ($("#members_id").val()) {
            var id = $("#members_id").val();
            var member = doRequest(
                "GET",
                `/members/get-members/${id}`,
                null,
                false
            );
            $("#alamat").val(member.data.alamat);
            $("#rw").val(member.data.rw);
            $("#rt").val(member.data.rt);
            $("#kode_pos").val(member.data.kode_pos);

            // Provinsi
            var province = `<option value="">-- Pilih Provinsi --</option>`;
            var provinces = doRequest("GET", `/regions/province`, null, false);
            provinces.data.map((provinsi) => {
                if (member.data.provinsi == provinsi.id) {
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
                `/regions/cities/${member.data.provinsi}`,
                null,
                false
            );
            cities.data.map((kota) => {
                if (member.data.kota == kota.id) {
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
                `/regions/districts/${member.data.kota}`,
                null,
                false
            );
            districts.data.map((kecamatan) => {
                if (member.data.kecamatan == kecamatan.id) {
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
                `/regions/villages/${member.data.kecamatan}`,
                null,
                false
            );
            villages.data.map((kelurahan) => {
                if (member.data.kelurahan == kelurahan.id) {
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
        }
    } else {
        $("#alamat").prop("readonly", false);
        $("#provinsi").prop("readonly", false);
        $("#kota").prop("readonly", false);
        $("#kecamatan").prop("readonly", false);
        $("#kelurahan").prop("readonly", false);
        $("#rw").prop("readonly", false);
        $("#rt").prop("readonly", false);
        $("#kode_pos").prop("readonly", false);
    }
});

$("#members_id").on("change", function () {
    $("#same_address:checkbox").prop("checked", false);
    $("#alamat").prop("readonly", false);
    $("#rw").prop("readonly", false);
    $("#rt").prop("readonly", false);
    $("#kode_pos").prop("readonly", false);
    $("#kota").prop("disabled", true);
    $("#kecamatan").prop("disabled", true);
    $("#kelurahan").prop("disabled", true);
    $("#alamat").val("");
    $("#rw").val("");
    $("#rt").val("");
    $("#kode_pos").val("");
    $("#provinsi").html("");
    $("#kota").html("");
    $("#kecamatan").html("");
    $("#kelurahan").html("");
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
