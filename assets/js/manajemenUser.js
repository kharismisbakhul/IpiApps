$('.custom-file-input').on('change', function () {
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

$('.privileges').on('change', function () {
  // alert("<?php echo $aa; ?>");
  $.ajax({
    url: 'http://localhost/SiUjian/admin/getListProdi',
    method: 'get',
    dataType: 'json',

    success: function (data) {
      var d = [];
      for (i = 0; i < data.length; i++) {
        d.push(data[i]['nama_prodi']);
      }
      if ($('.privileges').val() === "Mahasiswa") {
        clear();
        $('.a').addClass('form-group row');
        $('.a').append(`
                <label for= "prodi" class= "col-sm-4 col-form-label" >Prodi</label >
                    <div class="col-sm-8">
                        <select class="form-control listProdi" name="prodi" id="prodi" placeholder="prodi">
                        </select>
                        </div>`);
        d.forEach(myFunction);
      }
      else if ($('.privileges').val() === "Dosen") {
        clear();
        $('.a').addClass('form-group row');
        $('.a').append(`
                        <label for= "jenjang" class= "col-sm-4 col-form-label" >Jenjang</label >
                            <div class="col-sm-8">
                                <select class="form-control jenjang" name="jenjang" id="jenjang">
                                <option>S2</option>
                                <option>S3</option>
                                </select>
                                </div>`);
      }
      else {
        clear();
      }
    }
  })
});

function clear() {
  $('.a').removeClass('form-group row');
  $('.a').html(``);
}

function myFunction(item) {
  document.getElementById("prodi").innerHTML += `<option>` + item + `</option>`;
}

