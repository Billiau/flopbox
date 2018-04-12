function search(txt) {
    $value = txt;
    $.ajax({
        type: 'get',
        url: '/search',
        data: {'search': $value},
        success: function (data) {
            if (data.no !== "") {
                $('tbody').html(data);
            }
        }
    });
}

function sweetDelete(e, id) {
    e.preventDefault();
    swal({
        title: 'Ben je zeker?',
        text: "Je kan dit niet ongedaan maken!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Verwijder',
        cancelButtonText: 'Terug'
    }).then((result) => {
        if (result.value) {
            window.location.href = "/destroy/" + id;
        }

    });
}

window.onload = function () {

    if (window.location.pathname === '/dashboard') {



    } else {
        var input = document.getElementById('fileup');
        var label = input.nextElementSibling,
                labelVal = label.innerHTML;

        // Gekozen bestandsnaam tonen naast uploadknop
        input.addEventListener('change', function (e)
        {
            var fileName = '';
            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                label.querySelector('span').innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // C:\fakepath verwijderen uit bestandsnaam
        document.getElementById("fileup").onchange = function () {
            var path = this.value;
            var path = path.replace(/\\/g, '/').replace(/.*\//, '');
            document.getElementById("uploadFile").value = path;

        };
    }
    ;



};


