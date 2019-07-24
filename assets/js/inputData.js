//Detail Input Data
$(window).on('load', function () {
    $.ajax({
        url: 'http://localhost/IpiApps/admin/getDimensi',
        method: 'get',
        dataType: 'json',

        success: function (data) {
            var d = [];
            for (i = 0; i < data.length; i++) {
                d.push(data[i]['nama_dimensi']);
            }
            document.getElementById("dimensi").innerHTML += `<option></option>`
            d.forEach(function (item) {
                document.getElementById("dimensi").innerHTML += `<option>` + item + `</option>`
            });

            $('.dimensi').on('change', function () {
                // console.log($('.dimensi').val());
                var a = $('.dimensi').val();
                var b = a.replace(" ", "+");
                console.log(b);
                // $.ajax({
                //     url: 'http://localhost/IpiApps/admin/getSubDimensi/' + a,
                //     method: 'get',
                //     dataType: 'json',
                //     success: function (data) { }
                // })
            });
        }
    });
})

// function dimensi(item) {
//     ;
// }

// $('.privileges').on('change', function () {
//     // alert("<?php echo $aa; ?>");
//     $.ajax({
//         url: 'http://localhost/SiUjian/admin/getListProdi',
//         method: 'get',
//         dataType: 'json',

//         success: function (data) {
//             var d = [];
//             for (i = 0; i < data.length; i++) {
//                 d.push(data[i]['nama_prodi']);
//             }
//             if ($('.privileges').val() === "Mahasiswa") {
//                 clear();
//                 $('.a').addClass('form-group row');
//                 $('.a').append(`
//           <label for= "jenjang" class= "col-sm-4 col-form-label" >Jenjang</label >
//           <div class="col-sm-8">
//           <select class="form-control jenjang" name="jenjang" id="jenjang">
//           <option>S2</option>
//           <option>S3</option>
//           </select>
//           </div>
//           `);
//                 $('.b').addClass('form-group row');
//                 $('.b').append(`
//                   <label for= "prodi" class= "col-sm-4 col-form-label">Prodi</label>
//                       <div class="col-sm-8">
//                           <select class="form-control listProdi" name="prodi" id="prodi" placeholder="prodi">
//                           </select>
//                           </div>`);
//                 d.forEach(myFunction);
//             }
//             else if ($('.privileges').val() === "Dosen") {
//                 clear();
//                 $('.a').addClass('form-group row');
//                 $('.a').append(`
//           <label for= "jenjang" class= "col-sm-4 col-form-label" >Jenjang</label >
//           <div class="col-sm-8">
//           <select class="form-control jenjang" name="jenjang" id="jenjang">
//           <option>S2</option>
//           <option>S3</option>
//           </select>
//           </div>
//           `);
//                 $('.b').addClass('form-group row');
//                 $('.b').append(`
//                   <label for= "prodi" class= "col-sm-4 col-form-label">Prodi</label>
//                       <div class="col-sm-8">
//                           <select class="form-control listProdi" name="prodi" id="prodi" placeholder="prodi">
//                           </select>
//                           </div>`);
//                 d.forEach(myFunction);
//             }
//             else if ($('.privileges').val() === "Pimpinan") {
//                 clear();
//                 $('.a').addClass('form-group row');
//                 $('.a').append(`
//           <label for= "jenjang" class= "col-sm-4 col-form-label" >Jenjang</label >
//           <div class="col-sm-8">
//           <select class="form-control jenjang" name="jenjang" id="jenjang">
//           <option>S2</option>
//           <option>S3</option>
//           </select>
//           </div>
//           `);
//                 $('.b').addClass('form-group row');
//                 $('.b').append(`
//                   <label for= "prodi" class= "col-sm-4 col-form-label">Prodi</label>
//                       <div class="col-sm-8">
//                           <select class="form-control listProdi" name="prodi" id="prodi" placeholder="prodi">
//                           </select>
//                           </div>`);
//                 d.forEach(myFunction);
//                 $('.c').addClass('form-group row');
//                 $('.c').append(`
//           <label for= "posisi" class= "col-sm-4 col-form-label" >Posisi</label >
//           <div class="col-sm-8">
//           <textarea class="form-control posisi" name="posisi" id="posisi"></textarea>
//           </div>
//           `);
//             }
//             else {
//                 clear();
//             }
//         }
//     })
// });

// function clear() {
//     $('.a').removeClass('form-group row');
//     $('.b').removeClass('form-group row');
//     $('.c').removeClass('form-group row');
//     $('.a').html(``);
//     $('.b').html(``);
//     $('.c').html(``);
// }

// function myFunction(item) {
//     document.getElementById("prodi").innerHTML += `<option>` + item + `</option>`;
// }

